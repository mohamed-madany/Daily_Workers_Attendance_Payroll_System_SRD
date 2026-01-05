{{-- 
    Modal Component with Alpine.js
    
    Usage:
    <x-ui.modal id="confirm-delete" title="Delete Worker">
        <p>Are you sure you want to delete this worker?</p>
        <x-slot:footer>
            <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'confirm-delete')">Cancel</x-ui.button>
            <x-ui.button variant="danger">Delete</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    
    Trigger:
    <button @click="$dispatch('open-modal', 'confirm-delete')">Open Modal</button>
--}}

@props([
    'id' => 'modal',
    'title' => '',
    'maxWidth' => 'md',
])

@php
    $maxWidthClasses = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ];
    
    $width = $maxWidthClasses[$maxWidth] ?? $maxWidthClasses['md'];
@endphp

<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail === '{{ $id }}') open = true"
    x-on:close-modal.window="if ($event.detail === '{{ $id }}') open = false"
    x-on:keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title-{{ $id }}"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"
        @click="open = false"
    ></div>

    {{-- Modal Container --}}
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            {{-- Modal Panel --}}
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full {{ $width }} bg-white rounded-2xl shadow-xl"
                @click.stop
            >
                {{-- Header --}}
                @if($title)
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 id="modal-title-{{ $id }}" class="text-lg font-semibold text-gray-900">
                        {{ $title }}
                    </h3>
                    <button 
                        @click="open = false"
                        class="p-1 text-gray-400 hover:text-gray-500 rounded-lg hover:bg-gray-100 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @endif

                {{-- Body --}}
                <div class="px-6 py-4">
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                @if(isset($footer))
                <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                    {{ $footer }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
