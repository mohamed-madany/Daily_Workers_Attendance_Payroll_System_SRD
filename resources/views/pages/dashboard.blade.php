<x-layouts.app title="لوحة التحكم">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">لوحة التحكم</h1>
                <p class="text-sm text-gray-500 mt-1">مرحباً بك! إليك ملخص نشاط اليوم.</p>
            </div>
            <div class="flex items-center gap-2">
                <x-ui.button variant="secondary" size="sm">
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    تحديث
                </x-ui.button>
            </div>
        </div>
    </x-slot:header>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Total Workers --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">إجمالي العمال</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalWorkers ?? 24 }}</p>
                    <p class="text-xs text-green-600 mt-2 flex items-center">
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        +2 هذا الأسبوع
                    </p>
                </div>
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Today Attendance --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">حضور اليوم</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $todayAttendance ?? 21 }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $absentToday ?? 3 }} غائب اليوم
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Today Deductions --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">خصومات اليوم</p>
                    <p class="text-3xl font-bold text-red-600 mt-1">{{ number_format($todayDeductions ?? 450, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $deductionCount ?? 3 }} خصم
                    </p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Outstanding Balance --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">الرصيد المستحق</p>
                    <p class="text-3xl font-bold text-orange-600 mt-1">{{ number_format($outstandingBalance ?? 12500, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $workersPending ?? 8 }} عامل معلق
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('attendance.create') ?? '#' }}" class="bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-300 hover:shadow-md transition-all group">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-900">تسجيل الحضور</p>
            <p class="text-xs text-gray-500">تسجيل حضور اليوم</p>
        </a>

        <a href="{{ route('workers.create') ?? '#' }}" class="bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-300 hover:shadow-md transition-all group">
            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-900">إضافة عامل</p>
            <p class="text-xs text-gray-500">تسجيل عامل جديد</p>
        </a>

        <a href="{{ route('payments.create') ?? '#' }}" class="bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-300 hover:shadow-md transition-all group">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-900">تسجيل دفعة</p>
            <p class="text-xs text-gray-500">دفع رصيد العامل</p>
        </a>

        <a href="{{ route('reports.monthly') ?? '#' }}" class="bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-300 hover:shadow-md transition-all group">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-900">عرض التقارير</p>
            <p class="text-xs text-gray-500">الملخص الشهري</p>
        </a>
    </div>

    {{-- Recent Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Attendance --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">حضور اليوم</h3>
                <a href="{{ route('attendance.index') ?? '#' }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">عرض الكل</a>
            </div>
            <div class="divide-y divide-gray-100">
                @php
                    $recentAttendance = $recentAttendance ?? [
                        ['name' => 'أحمد حسن', 'check_in' => '08:00', 'check_out' => '17:00', 'status' => 'present'],
                        ['name' => 'محمد علي', 'check_in' => '08:15', 'check_out' => '17:00', 'status' => 'late'],
                        ['name' => 'خالد يوسف', 'check_in' => '08:00', 'check_out' => '—', 'status' => 'present'],
                        ['name' => 'عمر فاروق', 'check_in' => '—', 'check_out' => '—', 'status' => 'absent'],
                    ];
                @endphp
                @foreach($recentAttendance as $att)
                <div class="px-6 py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center ml-3">
                            <span class="text-xs font-semibold text-primary-700">{{ mb_substr($att['name'], 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $att['name'] }}</p>
                            <p class="text-xs text-gray-500">{{ $att['check_in'] }} - {{ $att['check_out'] }}</p>
                        </div>
                    </div>
                    @if($att['status'] === 'present')
                        <x-ui.badge variant="success">حاضر</x-ui.badge>
                    @elseif($att['status'] === 'late')
                        <x-ui.badge variant="warning">متأخر</x-ui.badge>
                    @else
                        <x-ui.badge variant="danger">غائب</x-ui.badge>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Payments --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">آخر المدفوعات</h3>
                <a href="{{ route('payments.index') ?? '#' }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">عرض الكل</a>
            </div>
            <div class="divide-y divide-gray-100">
                @php
                    $recentPayments = $recentPayments ?? [
                        ['name' => 'أحمد حسن', 'amount' => 1500, 'date' => 'اليوم', 'method' => 'نقدي'],
                        ['name' => 'محمد علي', 'amount' => 2000, 'date' => 'أمس', 'method' => 'تحويل بنكي'],
                        ['name' => 'خالد يوسف', 'amount' => 1200, 'date' => 'منذ يومين', 'method' => 'محفظة إلكترونية'],
                        ['name' => 'عمر فاروق', 'amount' => 800, 'date' => 'منذ 3 أيام', 'method' => 'نقدي'],
                    ];
                @endphp
                @foreach($recentPayments as $payment)
                <div class="px-6 py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center ml-3">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $payment['name'] }}</p>
                            <p class="text-xs text-gray-500">{{ $payment['date'] }}</p>
                        </div>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-bold text-green-600">{{ number_format($payment['amount'], 2) }} ج.م</p>
                        <p class="text-xs text-gray-400">{{ $payment['method'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
