{{-- Sidebar Navigation Component - Arabic RTL --}}
{{-- Mobile Overlay --}}
<div 
    x-show="sidebarOpen" 
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
    @click="sidebarOpen = false"
></div>

{{-- Sidebar --}}
<aside 
    :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full'"
    class="fixed inset-y-0 right-0 z-50 w-64 bg-white border-l border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0"
>
    {{-- Logo --}}
    <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200">
        <a href="{{ route('dashboard') ?? '#' }}" class="flex items-center gap-3">
            <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <span class="text-lg font-bold text-gray-900">نظام العمال</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded-md text-gray-500 hover:bg-gray-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') ?? '#' }}" 
           class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                  {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            لوحة التحكم
        </a>

        {{-- Workers --}}
        <a href="{{ route('workers.index') ?? '#' }}" 
           class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                  {{ request()->routeIs('workers.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            العمال
        </a>

        {{-- Attendance --}}
        <a href="{{ route('attendance.index') ?? '#' }}" 
           class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                  {{ request()->routeIs('attendance.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            الحضور
        </a>

        {{-- Deductions --}}
        <a href="{{ route('deductions.index') ?? '#' }}" 
           class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                  {{ request()->routeIs('deductions.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            الخصومات
        </a>

        {{-- Daily Ledger --}}
        <a href="{{ route('ledger.index') ?? '#' }}" 
           class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                  {{ request()->routeIs('ledger.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            السجل اليومي
        </a>

        {{-- Payments --}}
        <a href="{{ route('payments.index') ?? '#' }}" 
           class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                  {{ request()->routeIs('payments.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            المدفوعات
        </a>

        {{-- Reports Section --}}
        <div class="pt-4 mt-4 border-t border-gray-200">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">التقارير</p>
            
            <a href="{{ route('reports.monthly') ?? '#' }}" 
               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                      {{ request()->routeIs('reports.monthly') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                التقرير الشهري
            </a>

            <a href="{{ route('reports.worker') ?? '#' }}" 
               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
                      {{ request()->routeIs('reports.worker') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                تقرير العامل
            </a>
        </div>
    </nav>

    {{-- User Section --}}
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                <span class="text-sm font-semibold text-primary-700">{{ substr(Auth::user()->name ?? 'م', 0, 1) }}</span>
            </div>
            <div class="mr-3 flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name ?? 'مدير النظام' }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
            </div>
        </div>
    </div>
</aside>
