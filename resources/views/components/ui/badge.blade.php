{{-- 
    Badge Component
    
    Usage:
    <x-ui.badge>Default</x-ui.badge>
    <x-ui.badge variant="success">Active</x-ui.badge>
    <x-ui.badge variant="warning" size="lg">Pending</x-ui.badge>
--}}

@props([
    'variant' => 'gray',
    'size' => 'md',
])

@php
    $baseClasses = 'inline-flex items-center font-medium rounded-full';
    
    $variants = [
        'gray' => 'bg-gray-100 text-gray-700',
        'primary' => 'bg-primary-100 text-primary-700',
        'success' => 'bg-green-100 text-green-700',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'danger' => 'bg-red-100 text-red-700',
        'info' => 'bg-blue-100 text-blue-700',
    ];
    
    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-1 text-xs',
        'lg' => 'px-3 py-1 text-sm',
    ];
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['gray']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
