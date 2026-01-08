@if ($paginator->hasPages())
    <nav role="navigation" aria-label="التنقل بين الصفحات" class="mt-6">

        {{-- Mobile View --}}
        <div class="flex gap-3 items-center justify-between sm:hidden">
            {{-- Previous (Left side) --}}
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed leading-5 rounded-lg">
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    السابق
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-gray-700 border border-gray-700 leading-5 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 active:bg-gray-900 transition-all duration-150">
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    السابق
                </a>
            @endif

            {{-- Next (Right side) --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-gray-700 border border-gray-700 leading-5 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 active:bg-gray-900 transition-all duration-150">
                    التالي
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed leading-5 rounded-lg">
                    التالي
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">

            {{-- Results Info --}}
            <div>
                <p class="text-sm text-gray-600 leading-5">
                    عرض
                    @if ($paginator->firstItem())
                        <span class="font-semibold text-gray-900">{{ $paginator->firstItem() }}</span>
                        إلى
                        <span class="font-semibold text-gray-900">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-semibold text-gray-900">{{ $paginator->count() }}</span>
                    @endif
                    من
                    <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span>
                    نتيجة
                </p>
            </div>

            {{-- Pagination Buttons --}}
            <div>
                <span class="inline-flex gap-1 shadow-sm rounded-lg">

                    {{-- Previous Page Link (Left side) --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="الصفحة السابقة">
                            <span
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-l-lg leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 border border-gray-700 rounded-l-lg leading-5 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 active:bg-gray-900 transition-all duration-150"
                            aria-label="الصفحة السابقة">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-r-0 border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary-600 border border-primary-600 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-r-0 border-gray-300 leading-5 hover:bg-gray-50 hover:text-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 active:bg-gray-100 transition-all duration-150"
                                        aria-label="الذهاب إلى الصفحة {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link (Right side) --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-700 border border-gray-700 rounded-r-lg leading-5 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 active:bg-gray-900 transition-all duration-150"
                            aria-label="الصفحة التالية">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="الصفحة التالية">
                            <span
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-r-lg leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
