{{-- 
    Payment Form Component
    
    Usage:
    <x-forms.payment-form :workers="$workers" />
--}}

@props([
    'workers' => [],
    'payment' => null,
    'action' => null,
])

@php
    $isEdit = !is_null($payment);
    $formAction = $action ?? ($isEdit ? route('payments.update', $payment['id'] ?? 1) : route('payments.store'));
@endphp

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $isEdit ? 'Edit Payment' : 'Record Payment' }}
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ $isEdit ? 'Update payment details' : 'Record a payment to a worker' }}
        </p>
    </div>

    <form action="{{ $formAction }}" method="POST" class="p-6 space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- Worker Selection with Balance Info --}}
        <div>
            <label for="worker_id" class="block text-sm font-medium text-gray-700 mb-2">
                Worker <span class="text-red-500">*</span>
            </label>
            <select 
                id="worker_id" 
                name="worker_id" 
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('worker_id') border-red-500 @enderror"
                required
            >
                <option value="">Select a worker</option>
                @foreach($workers as $worker)
                    <option 
                        value="{{ $worker['id'] }}" 
                        data-balance="{{ $worker['balance'] ?? 0 }}"
                        {{ old('worker_id', $payment['worker_id'] ?? '') == $worker['id'] ? 'selected' : '' }}
                    >
                        {{ $worker['name'] }} — Balance: {{ number_format($worker['balance'] ?? 0, 2) }} EGP
                    </option>
                @endforeach
            </select>
            @error('worker_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            {{-- Balance info card --}}
            <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg hidden" id="balance-info">
                <p class="text-sm text-blue-800">
                    <span class="font-medium">Outstanding Balance:</span>
                    <span id="balance-amount" class="font-bold">0.00 EGP</span>
                </p>
            </div>
        </div>

        {{-- Amount --}}
        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                Payment Amount (EGP) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input 
                    type="number" 
                    id="amount" 
                    name="amount" 
                    value="{{ old('amount', $payment['amount'] ?? '') }}"
                    step="0.01"
                    min="0"
                    class="w-full pl-4 pr-16 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('amount') border-red-500 @enderror"
                    placeholder="0.00"
                    required
                >
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">EGP</span>
            </div>
            @error('amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Payment Date --}}
        <div>
            <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">
                Payment Date <span class="text-red-500">*</span>
            </label>
            <input 
                type="date" 
                id="payment_date" 
                name="payment_date" 
                value="{{ old('payment_date', $payment['payment_date'] ?? date('Y-m-d')) }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('payment_date') border-red-500 @enderror"
                required
            >
            @error('payment_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Payment Method --}}
        <div>
            <label for="method" class="block text-sm font-medium text-gray-700 mb-2">
                Payment Method <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                @php
                    $methods = [
                        ['value' => 'cash', 'label' => 'Cash', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>'],
                        ['value' => 'bank_transfer', 'label' => 'Bank Transfer', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>'],
                        ['value' => 'mobile_wallet', 'label' => 'Mobile Wallet', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>'],
                    ];
                @endphp
                @foreach($methods as $method)
                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="method" 
                            value="{{ $method['value'] }}" 
                            class="peer sr-only"
                            {{ old('method', $payment['method'] ?? 'cash') === $method['value'] ? 'checked' : '' }}
                            required
                        >
                        <div class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-lg transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:border-gray-300">
                            <svg class="w-5 h-5 text-gray-500 peer-checked:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $method['icon'] !!}
                            </svg>
                            <span class="text-sm font-medium text-gray-700">{{ $method['label'] }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
            @error('method')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Notes (Optional) --}}
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                Notes <span class="text-gray-400 text-xs">(Optional)</span>
            </label>
            <textarea 
                id="notes" 
                name="notes" 
                rows="2"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none"
                placeholder="Any notes about this payment..."
            >{{ old('notes', $payment['notes'] ?? '') }}</textarea>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
            <x-ui.button href="{{ route('payments.index') ?? '#' }}" variant="secondary">
                Cancel
            </x-ui.button>
            <x-ui.button type="submit" variant="success">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ $isEdit ? 'Update Payment' : 'Record Payment' }}
            </x-ui.button>
        </div>
    </form>
</div>
