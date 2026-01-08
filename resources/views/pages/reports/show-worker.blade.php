@php
    $worker = $selectedWorker ?? [
        'name' => ' ',
        'role' => ' ',
        'daily_fee' => 0,
        'status' => '',
        'joined_date' => '--',
    ];
@endphp
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center">
            <span class="text-2xl font-bold text-primary-700">{{ mb_substr($worker['name'], 0, 1) }}</span>
        </div>
        <div class="flex-1">
            <div class="flex items-center gap-2">
                <h2 class="text-xl font-bold text-gray-900">{{ $worker['name'] }}</h2>
                @if ($worker['status'] === 'active')
                    <x-ui.badge variant="success">نشط</x-ui.badge>
                @else
                    <x-ui.badge variant="gray">غير نشط</x-ui.badge>
                @endif
            </div>
            <p class="text-sm text-gray-500 mt-1">{{ $worker['role'] }} • {{ $worker['daily_fee'] }} ج.م/يوم</p>
        </div>
        <div class="text-left">
            <p class="text-xs text-gray-500 uppercase tracking-wider">الرصيد الحالي</p>
            <p class="text-2xl font-bold text-orange-600">{{ number_format($summary['current_balance'] ?? 0, 2) }} ج.م
            </p>
            <div class="mt-3">
                <a href="{{ route('workers.edit', $selectedWorker->id) }}"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-200 rounded-md text-sm text-gray-700 hover:bg-gray-50">
                    تعديل العامل
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Statistics Dashboard --}}
<div class="mb-6 space-y-6">
    {{-- Period Statistics (Filtered by Date Range) --}}
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 p-6">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">إحصائيات الفترة المحددة</h3>
            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">حسب التاريخ</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Days Worked Breakdown --}}
            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">تفصيل أيام العمل</p>
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-2">
                    {{-- Full Days --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-xs text-gray-600">كامل</span>
                        </div>
                        <span class="text-sm font-bold text-green-600">{{ $summary['full_days'] ?? 0 }}</span>
                    </div>

                    {{-- Half Days --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-xs text-gray-600">نصف يوم</span>
                        </div>
                        <span class="text-sm font-bold text-blue-600">{{ $summary['half_days'] ?? 0 }}</span>
                    </div>

                    {{-- Late Days (counted as full) --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            <span class="text-xs text-gray-600">متأخر</span>
                        </div>
                        <span class="text-sm font-bold text-yellow-600">{{ $summary['late_days'] ?? 0 }}</span>
                    </div>

                    {{-- Absent Days --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="text-xs text-gray-600">غائب</span>
                        </div>
                        <span class="text-sm font-bold text-red-600">{{ $summary['absent_days'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="mt-3 pt-3 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium text-gray-700">الإجمالي</span>
                        <span class="text-lg font-bold text-gray-900">{{ $summary['total_days_worked'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Total Hours --}}
            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">ساعات العمل</p>
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-purple-600">
                    {{ number_format($summary['total_worked_hours'] ?? 0, 1) }}</p>
                <p class="text-xs text-gray-500 mt-1">ساعة</p>
            </div>

            {{-- Net Earned Amount (Period) --}}
            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">الأجور المكتسبة</p>
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($summary['net_earned_amount'] ?? 0, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">ج.م</p>
            </div>

            {{-- Deductions --}}
            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">الخصومات</p>
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-red-600">{{ number_format($summary['total_deductions'] ?? 0, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">ج.م</p>
            </div>
        </div>

        {{-- Payments in Period --}}
        <div class="mt-4 bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">المدفوعات المستلمة في الفترة</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">
                        {{ number_format($summary['payments_between'] ?? 0, 2) }} ج.م</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Overall Statistics (All Time) --}}
    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl border border-orange-200 p-6">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">الإحصائيات الإجمالية</h3>
            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full">جميع الأوقات</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Total Net Earned --}}
            <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-700">إجمالي الأجور المكتسبة</p>
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-emerald-600">
                    {{ number_format($summary['total_net_earned_amount'] ?? 0, 2) }}</p>
                <p class="text-xs text-gray-500 mt-1">ج.م</p>
            </div>

            {{-- Total Payments --}}
            <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-700">إجمالي المدفوعات</p>
                    <div class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-sky-600">
                    {{ number_format($summary['total_payment_amount'] ?? 0, 2) }}</p>
                <p class="text-xs text-gray-500 mt-1">ج.م</p>
                @php
                    $totalEarned = $summary['total_net_earned_amount'] ?? 0;
                    $totalPaid = $summary['total_payment_amount'] ?? 0;
                    $paymentPercentage = $totalEarned > 0 ? ($totalPaid / $totalEarned) * 100 : 0;
                @endphp
                <div class="mt-3">
                    <div class="flex items-center justify-between text-xs mb-1">
                        <span class="text-gray-500">نسبة السداد</span>
                        <span class="font-semibold text-gray-700">{{ number_format($paymentPercentage, 1) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-sky-600 h-2 rounded-full transition-all duration-500"
                            style="width: {{ min($paymentPercentage, 100) }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Current Balance --}}
            <div
                class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border-2 border-orange-200">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-medium text-gray-700">الرصيد الحالي</p>
                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-orange-600">{{ number_format($summary['current_balance'] ?? 0, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">ج.م</p>
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <p class="text-xs text-gray-600">
                        = {{ number_format($summary['total_net_earned_amount'] ?? 0, 2) }}
                        - {{ number_format($summary['total_payment_amount'] ?? 0, 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Attendance History --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">سجل الحضور</h3>
        </div>
        <span
            class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ count($summary['attendance_records'] ?? []) }}
            سجل</span>
    </div>
    <div class="overflow-x-auto">
        @if (isset($summary['attendance_records']) && count($summary['attendance_records']) > 0)
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            التاريخ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            الحضور
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            الانصراف</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            الساعات</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            الحالة
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            الأجر اليومي
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($summary['attendance_records'] as $index => $attendance)
                        @php
                            $dailyFee = $attendance->worker->daily_fee ?? 0;
                            $earned = 0;

                            if ($attendance->status === 'present' || $attendance->status === 'late') {
                                $earned = $dailyFee;
                            } elseif ($attendance->status === 'half_day') {
                                $earned = $dailyFee / 2;
                            }
                        @endphp
                        <tr
                            class="hover:bg-blue-50 transition-colors {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($attendance->date)->format('Y-m-d') }}
                                <span
                                    class="text-xs text-gray-500 block">{{ \Carbon\Carbon::parse($attendance->date)->locale('ar')->translatedFormat('l') }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="font-mono">{{ $attendance->check_in_time ?? '—' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="font-mono">{{ $attendance->check_out_time ?? '—' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span
                                    class="font-semibold">{{ number_format($attendance->worked_hours ?? 0, 1) }}</span>
                                ساعة
                            </td>
                            <td class="px-6 py-4">
                                @if ($attendance->status === 'present')
                                    <x-ui.badge variant="success">حاضر</x-ui.badge>
                                @elseif($attendance->status === 'late')
                                    <x-ui.badge variant="warning">متأخر</x-ui.badge>
                                @elseif($attendance->status === 'half_day')
                                    <x-ui.badge variant="info">نصف يوم</x-ui.badge>
                                @else
                                    <x-ui.badge variant="danger">غائب</x-ui.badge>
                                @endif
                            </td>
                            <td
                                class="px-6 py-4 text-left text-sm font-bold {{ $earned > 0 ? 'text-green-600' : 'text-gray-400' }}">
                                {{ number_format($earned, 2) }} ج.م
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-16 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-500 text-sm">لا توجد سجلات حضور في الفترة المحددة</p>
            </div>
        @endif
    </div>
</div>

{{-- Transactions History --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Deductions --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div
            class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-red-50 to-pink-50">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">الخصومات</h3>
            </div>
            <span
                class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">{{ count($summary['deduction_records'] ?? []) }}
                خصم</span>
        </div>
        <div class="divide-y divide-gray-100 max-h-96 overflow-y-auto">
            @if (isset($summary['deduction_records']) && count($summary['deduction_records']) > 0)
                @foreach ($summary['deduction_records'] as $index => $deduction)
                    <div
                        class="px-6 py-4 hover:bg-red-50 transition-colors {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $deduction->reason }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($deduction->date)->format('Y-m-d') }}</p>
                                </div>
                            </div>
                            <div class="text-left">
                                <span
                                    class="text-lg font-bold text-red-600">-{{ number_format($deduction->deduction_amount, 2) }}</span>
                                <span class="text-xs text-gray-500 block">ج.م</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="px-6 py-16 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm">لا توجد خصومات في الفترة المحددة</p>
                    <p class="text-gray-400 text-xs mt-1">أداء ممتاز! 🎉</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Payments --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div
            class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-green-50 to-emerald-50">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">المدفوعات المستلمة</h3>
            </div>
            <span
                class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">{{ count($summary['payment_records'] ?? []) }}
                دفعة</span>
        </div>
        <div class="divide-y divide-gray-100 max-h-96 overflow-y-auto">
            @if (isset($summary['payment_records']) && count($summary['payment_records']) > 0)
                @foreach ($summary['payment_records'] as $index => $payment)
                    @php
                        $methodTranslations = [
                            'cash' => 'نقدي',
                            'bank_transfer' => 'تحويل بنكي',
                            'mobile_wallet' => 'محفظة إلكترونية',
                        ];
                        $methodLabel = $methodTranslations[$payment->method] ?? $payment->method;
                    @endphp
                    <div
                        class="px-6 py-4 hover:bg-green-50 transition-colors {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    @if ($payment->method === 'cash')
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @elseif($payment->method === 'bank_transfer')
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    @endif
                                    <p class="text-sm font-medium text-gray-900">{{ $methodLabel }}</p>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</p>
                                </div>
                                @if ($payment->notes)
                                    <p class="text-xs text-gray-500 mt-1 italic">{{ $payment->notes }}</p>
                                @endif
                            </div>
                            <div class="text-left">
                                <span
                                    class="text-lg font-bold text-green-600">+{{ number_format($payment->payment_amount, 2) }}</span>
                                <span class="text-xs text-gray-500 block">ج.م</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="px-6 py-16 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm">لا توجد مدفوعات في الفترة المحددة</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
