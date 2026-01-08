@if ($paginator->hasPages())
    <nav role="navigation" aria-label="التنقل بين الصفحات" class="flex gap-3 items-center justify-between mt-6">

        {{-- Previous Button (Left side) --}}
        @if ($paginator->onFirstPage())
            <span
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed leading-5 rounded-lg">
                السابق
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-primary-600 border border-primary-600 leading-5 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 active:bg-primary-800 transition-all duration-150">
                السابق
            </a>
        @endif

        {{-- Next Button (Right side) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-primary-600 border border-primary-600 leading-5 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 active:bg-primary-800 transition-all duration-150">
                التالي

            </a>
        @else
            <span
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed leading-5 rounded-lg">
                التالي
            </span>
        @endif

    </nav>
@endif
