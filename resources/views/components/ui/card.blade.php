{{-- 
    Card Component for grouping content
    
    Usage:
    <x-ui.card title="Card Title">
        Content here
    </x-ui.card>
    
    <x-ui.card title="With Footer">
        Content
        <x-slot:footer>
            Footer content
        </x-slot:footer>
    </x-ui.card>
--}}

@props([
    'title' => null,
    'padding' => true,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-gray-200 overflow-hidden']) }}>
    @if($title)
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
    </div>
    @endif
    
    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        {{ $footer }}
    </div>
    @endif
</div>
