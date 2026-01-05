{{-- 
    Worker Form Component
    
    Usage:
    <x-forms.worker-form :worker="$worker" :roles="$roles" />
    <x-forms.worker-form /> (For create)
--}}

@props([
    'worker' => null,
    'roles' => [
        ['value' => 'general', 'label' => 'General Worker'],
        ['value' => 'skilled', 'label' => 'Skilled Worker'],
        ['value' => 'supervisor', 'label' => 'Supervisor'],
        ['value' => 'foreman', 'label' => 'Foreman'],
    ],
    'action' => null,
    'method' => 'POST',
])

@php
    $isEdit = !is_null($worker);
    $formAction = $action ?? ($isEdit ? route('workers.update', $worker['id'] ?? 1) : route('workers.store'));
@endphp

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $isEdit ? 'Edit Worker' : 'Add New Worker' }}
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ $isEdit ? 'Update worker information' : 'Fill in the worker details below' }}
        </p>
    </div>

    <form action="{{ $formAction }}" method="POST" class="p-6 space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Full Name <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $worker['name'] ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                placeholder="Enter worker's full name"
                required
            >
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                Role <span class="text-red-500">*</span>
            </label>
            <select 
                id="role" 
                name="role" 
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('role') border-red-500 @enderror"
                required
            >
                <option value="">Select a role</option>
                @foreach($roles as $role)
                    <option 
                        value="{{ $role['value'] }}" 
                        {{ old('role', $worker['role'] ?? '') === $role['value'] ? 'selected' : '' }}
                    >
                        {{ $role['label'] }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Daily Fee --}}
        <div>
            <label for="daily_fee" class="block text-sm font-medium text-gray-700 mb-2">
                Daily Fee (EGP) <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input 
                    type="number" 
                    id="daily_fee" 
                    name="daily_fee" 
                    value="{{ old('daily_fee', $worker['daily_fee'] ?? '') }}"
                    step="0.01"
                    min="0"
                    class="w-full pl-4 pr-16 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('daily_fee') border-red-500 @enderror"
                    placeholder="0.00"
                    required
                >
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">EGP</span>
            </div>
            @error('daily_fee')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                Status
            </label>
            <div class="flex items-center gap-6">
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="radio" 
                        name="status" 
                        value="active" 
                        class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500"
                        {{ old('status', $worker['status'] ?? 'active') === 'active' ? 'checked' : '' }}
                    >
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="radio" 
                        name="status" 
                        value="inactive" 
                        class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500"
                        {{ old('status', $worker['status'] ?? '') === 'inactive' ? 'checked' : '' }}
                    >
                    <span class="ml-2 text-sm text-gray-700">Inactive</span>
                </label>
            </div>
        </div>

        {{-- Phone (Optional) --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                Phone Number <span class="text-gray-400 text-xs">(Optional)</span>
            </label>
            <input 
                type="tel" 
                id="phone" 
                name="phone" 
                value="{{ old('phone', $worker['phone'] ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="01xxxxxxxxx"
            >
        </div>

        {{-- Notes (Optional) --}}
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                Notes <span class="text-gray-400 text-xs">(Optional)</span>
            </label>
            <textarea 
                id="notes" 
                name="notes" 
                rows="3"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none"
                placeholder="Any additional notes about this worker..."
            >{{ old('notes', $worker['notes'] ?? '') }}</textarea>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
            <x-ui.button href="{{ route('workers.index') ?? '#' }}" variant="secondary">
                Cancel
            </x-ui.button>
            <x-ui.button type="submit">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ $isEdit ? 'Update Worker' : 'Save Worker' }}
            </x-ui.button>
        </div>
    </form>
</div>
