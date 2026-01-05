{{-- 
    Reusable Button Component
    
    Usage:
    <x-ui.button>Default Button</x-ui.button>
    <x-ui.button variant="primary">Primary</x-ui.button>
    <x-ui.button variant="danger" size="sm">Delete</x-ui.button>
    <x-ui.button href="/workers" variant="secondary">View All</x-ui.button>
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $variants = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
        'secondary' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-primary-500',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500',
        'ghost' => 'text-gray-600 hover:bg-gray-100 focus:ring-gray-500',
    ];
    
    $sizes = [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-5 py-3 text-base',
        'xl' => 'px-6 py-3.5 text-base',
    ];
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}" 
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
@endif
