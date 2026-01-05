{{-- 
    Deduction Form Component
    
    Usage:
    <x-forms.deduction-form :workers="$workers" />
--}}

@props([
    'workers' => [],
    'deduction' => null,
    'action' => null,
])

@php
    $isEdit = !is_null($deduction);
    $formAction = $action ?? ($isEdit ? route('deductions.update', $deduction['id'] ?? 1) : route('deductions.store'));
@endphp

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $isEdit ? 'Edit Deduction' : 'Add Deduction' }}
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ $isEdit ? 'Update deduction details' : 'Record a deduction for a worker' }}
        </p>
    </div>

    <form action="{{ $formAction }}" method="POST" class="p-6 space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- Worker Selection --}}
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
                        {{ old('worker_id', $deduction['worker_id'] ?? '') == $worker['id'] ? 'selected' : '' }}
                    >
                        {{ $worker['name'] }}
                    </option>
                @endforeach
            </select>
            @error('worker_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Date --}}
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                Date <span class="text-red-500">*</span>
            </label>
            <input 
                type="date" 
                id="date" 
                name="date" 
                value="{{ old('date', $deduction['date'] ?? date('Y-m-d')) }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('date') border-red-500 @enderror"
                required
            >
            @error('date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Amount --}}
        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                Deduction Amount (EGP) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-red-500 font-medium">-</span>
                <input 
                    type="number" 
                    id="amount" 
                    name="amount" 
                    value="{{ old('amount', $deduction['amount'] ?? '') }}"
                    step="0.01"
                    min="0"
                    class="w-full pl-8 pr-16 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('amount') border-red-500 @enderror"
                    placeholder="0.00"
                    required
                >
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">EGP</span>
            </div>
            @error('amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Reason --}}
        <div>
            <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                Reason <span class="text-red-500">*</span>
            </label>
            <div class="mb-2">
                {{-- Quick reason buttons --}}
                <div class="flex flex-wrap gap-2 mb-3">
                    @php
                        $quickReasons = [
                            'Late arrival',
                            'Early leave',
                            'Damage',
                            'Advance',
                            'Penalty',
                            'Other'
                        ];
                    @endphp
                    @foreach($quickReasons as $reason)
                        <button 
                            type="button" 
                            onclick="document.getElementById('reason').value = '{{ $reason }}'"
                            class="px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors"
                        >
                            {{ $reason }}
                        </button>
                    @endforeach
                </div>
            </div>
            <textarea 
                id="reason" 
                name="reason" 
                rows="3"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none @error('reason') border-red-500 @enderror"
                placeholder="Describe the reason for this deduction..."
                required
            >{{ old('reason', $deduction['reason'] ?? '') }}</textarea>
            @error('reason')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
            <x-ui.button href="{{ route('deductions.index') ?? '#' }}" variant="secondary">
                Cancel
            </x-ui.button>
            <x-ui.button type="submit" variant="danger">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ $isEdit ? 'Update Deduction' : 'Add Deduction' }}
            </x-ui.button>
        </div>
    </form>
</div>
