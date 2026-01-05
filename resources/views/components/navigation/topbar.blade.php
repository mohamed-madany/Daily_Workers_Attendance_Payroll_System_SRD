{{-- Topbar Navigation Component - Arabic RTL --}}
<header class="sticky top-0 z-30 bg-white border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-4 lg:px-6">
        {{-- Right: Mobile menu button + Breadcrumb (RTL) --}}
        <div class="flex items-center gap-4">
            {{-- Mobile Menu Button --}}
            <button 
                @click="sidebarOpen = true" 
                class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            <nav class="hidden sm:flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') ?? '#' }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
                @if(isset($breadcrumbs))
                    @foreach($breadcrumbs as $breadcrumb)
                        <svg class="w-4 h-4 text-gray-400 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        @if($loop->last)
                            <span class="text-gray-900 font-medium">{{ $breadcrumb['label'] }}</span>
                        @else
                            <a href="{{ $breadcrumb['url'] }}" class="text-gray-500 hover:text-gray-700">{{ $breadcrumb['label'] }}</a>
                        @endif
                    @endforeach
                @endif
            </nav>
        </div>

        {{-- Left: Actions (RTL) --}}
        <div class="flex items-center gap-3">
            {{-- Today's Date --}}
            <div class="hidden md:flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ now()->locale('ar')->translatedFormat('l، j F Y') }}
            </div>

            {{-- Notifications --}}
            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    {{-- Notification badge --}}
                    <span class="absolute top-1 left-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- Dropdown --}}
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute left-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 py-2"
                >
                    <div class="px-4 py-2 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">الإشعارات</h3>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm text-gray-900">يوجد 3 عمال لديهم مدفوعات معلقة</p>
                            <p class="text-xs text-gray-500 mt-1">منذ ساعتين</p>
                        </a>
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm text-gray-900">تم تسجيل الحضور اليومي</p>
                            <p class="text-xs text-gray-500 mt-1">منذ 5 ساعات</p>
                        </a>
                    </div>
                    <div class="px-4 py-2 border-t border-gray-100">
                        <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">عرض جميع الإشعارات</a>
                    </div>
                </div>
            </div>

            {{-- User Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                >
                    <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                        <span class="text-sm font-semibold text-primary-700">{{ substr(Auth::user()->name ?? 'م', 0, 1) }}</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2"
                >
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'مدير النظام' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->role ?? 'مسؤول' }}</p>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        الملف الشخصي
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        الإعدادات
                    </a>
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <form method="POST" action="{{ route('logout') ?? '#' }}">
                            @csrf
                            <button type="submit" class="w-full text-right px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
