{{-- 
    Select Component
    
    Usage:
    <x-ui.select name="role" label="Role" :options="$roles" />
--}}

@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'placeholder' => 'Select an option',
    'required' => false,
    'disabled' => false,
])

<div>
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    
    <select 
        id="{{ $name }}" 
        name="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 disabled:bg-gray-100 disabled:cursor-not-allowed' . ($errors->has($name) ? ' border-red-500' : '')
        ]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $option)
            @php
                $optionValue = is_array($option) ? ($option['value'] ?? $option['id'] ?? '') : $option;
                $optionLabel = is_array($option) ? ($option['label'] ?? $option['name'] ?? $optionValue) : $option;
            @endphp
            <option 
                value="{{ $optionValue }}" 
                {{ old($name, $value) == $optionValue ? 'selected' : '' }}
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
