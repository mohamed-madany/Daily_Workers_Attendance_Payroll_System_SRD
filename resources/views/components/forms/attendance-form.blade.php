{{-- 
    Attendance Form Component
    
    Usage:
    <x-forms.attendance-form :workers="$workers" />
--}}

@props([
    'workers' => [],
    'attendance' => null,
    'action' => null,
])

@php
    $isEdit = !is_null($attendance);
    $formAction = $action ?? ($isEdit ? route('attendance.update', $attendance['id'] ?? 1) : route('attendance.store'));
@endphp

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $isEdit ? 'Edit Attendance' : 'Record Attendance' }}
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            {{ $isEdit ? 'Update attendance record' : 'Record daily attendance for a worker' }}
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
                        {{ old('worker_id', $attendance['worker_id'] ?? '') == $worker['id'] ? 'selected' : '' }}
                    >
                        {{ $worker['name'] }} ({{ $worker['role'] ?? 'General' }})
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
                value="{{ old('date', $attendance['date'] ?? date('Y-m-d')) }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('date') border-red-500 @enderror"
                required
            >
            @error('date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Check-in / Check-out Times --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            {{-- Check-in --}}
            <div>
                <label for="check_in" class="block text-sm font-medium text-gray-700 mb-2">
                    Check-in Time <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="time" 
                        id="check_in" 
                        name="check_in" 
                        value="{{ old('check_in', $attendance['check_in'] ?? '08:00') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('check_in') border-red-500 @enderror"
                        required
                    >
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-green-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                @error('check_in')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Check-out --}}
            <div>
                <label for="check_out" class="block text-sm font-medium text-gray-700 mb-2">
                    Check-out Time <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="time" 
                        id="check_out" 
                        name="check_out" 
                        value="{{ old('check_out', $attendance['check_out'] ?? '17:00') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('check_out') border-red-500 @enderror"
                        required
                    >
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-red-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                @error('check_out')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                Attendance Status
            </label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @php
                    $statuses = [
                        ['value' => 'present', 'label' => 'Present', 'color' => 'green'],
                        ['value' => 'late', 'label' => 'Late', 'color' => 'yellow'],
                        ['value' => 'half_day', 'label' => 'Half Day', 'color' => 'blue'],
                        ['value' => 'absent', 'label' => 'Absent', 'color' => 'red'],
                    ];
                @endphp
                @foreach($statuses as $status)
                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="status" 
                            value="{{ $status['value'] }}" 
                            class="peer sr-only"
                            {{ old('status', $attendance['status'] ?? 'present') === $status['value'] ? 'checked' : '' }}
                        >
                        <div class="p-3 text-center border-2 border-gray-200 rounded-lg transition-all peer-checked:border-{{ $status['color'] }}-500 peer-checked:bg-{{ $status['color'] }}-50 hover:border-gray-300">
                            <span class="text-sm font-medium text-gray-700 peer-checked:text-{{ $status['color'] }}-700">{{ $status['label'] }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
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
                placeholder="Any notes about this attendance..."
            >{{ old('notes', $attendance['notes'] ?? '') }}</textarea>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
            <x-ui.button href="{{ route('attendance.index') ?? '#' }}" variant="secondary">
                Cancel
            </x-ui.button>
            <x-ui.button type="submit">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ $isEdit ? 'Update Attendance' : 'Record Attendance' }}
            </x-ui.button>
        </div>
    </form>
</div>
