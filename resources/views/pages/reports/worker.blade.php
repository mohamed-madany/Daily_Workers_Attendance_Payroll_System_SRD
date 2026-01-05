<x-layouts.app title="تقرير العامل">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">تقرير العامل</h1>
                <p class="text-sm text-gray-500 mt-1">تقرير تفصيلي لعامل معين.</p>
            </div>
            <div class="flex items-center gap-2">
                <x-ui.button variant="secondary" size="sm">
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    طباعة
                </x-ui.button>
                <x-ui.button variant="secondary" size="sm">
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    تصدير
                </x-ui.button>
            </div>
        </div>
    </x-slot:header>

    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form class="flex flex-col sm:flex-row sm:items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">اختر العامل</label>
                <select 
                    name="worker_id"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    required
                >
                    <option value="">اختر عامل</option>
                    <option value="1" selected>أحمد حسن</option>
                    <option value="2">محمد علي</option>
                    <option value="3">خالد يوسف</option>
                    <option value="4">عمر فاروق</option>
                    <option value="5">محمود سمير</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">من تاريخ</label>
                <input 
                    type="date" 
                    name="from_date" 
                    value="{{ date('Y-m-01') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                >
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">إلى تاريخ</label>
                <input 
                    type="date" 
                    name="to_date" 
                    value="{{ date('Y-m-d') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                >
            </div>
            <x-ui.button type="submit">
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                عرض التقرير
            </x-ui.button>
        </form>
    </div>

    {{-- Worker Profile Card --}}
    @php
        $worker = $workerDetails ?? [
            'id' => 1,
            'name' => 'أحمد حسن',
            'role' => 'مشرف',
            'daily_fee' => 250,
            'status' => 'active',
            'phone' => '01012345678',
            'joined_date' => '2024-01-15',
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
                    @if($worker['status'] === 'active')
                        <x-ui.badge variant="success">نشط</x-ui.badge>
                    @else
                        <x-ui.badge variant="gray">غير نشط</x-ui.badge>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mt-1">{{ $worker['role'] }} • {{ $worker['daily_fee'] }} ج.م/يوم</p>
                <p class="text-xs text-gray-400 mt-1">تاريخ الانضمام: {{ $worker['joined_date'] }}</p>
            </div>
            <div class="text-left">
                <p class="text-xs text-gray-500 uppercase tracking-wider">الرصيد الحالي</p>
                <p class="text-2xl font-bold text-orange-600">{{ number_format($workerBalance ?? 2500, 2) }} ج.م</p>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">أيام العمل</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ $summary['days_worked'] ?? 20 }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">إجمالي الأجور</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($summary['gross'] ?? 5000, 2) }} ج.م</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">إجمالي الخصومات</p>
            <p class="text-2xl font-bold text-red-600 mt-1">{{ number_format($summary['deductions'] ?? 150, 2) }} ج.م</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">إجمالي المدفوعات</p>
            <p class="text-2xl font-bold text-primary-600 mt-1">{{ number_format($summary['payments'] ?? 4000, 2) }} ج.م</p>
        </div>
    </div>

    {{-- Attendance History --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">سجل الحضور</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">التاريخ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الحضور</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الانصراف</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الساعات</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الحالة</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">المكسب</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $attendanceHistory = $attendanceHistory ?? [
                            ['date' => '2026-01-05', 'check_in' => '08:00', 'check_out' => '17:00', 'hours' => 9, 'status' => 'present', 'earned' => 250],
                            ['date' => '2026-01-04', 'check_in' => '08:15', 'check_out' => '17:00', 'hours' => 8.75, 'status' => 'late', 'earned' => 250],
                            ['date' => '2026-01-03', 'check_in' => '08:00', 'check_out' => '17:00', 'hours' => 9, 'status' => 'present', 'earned' => 250],
                            ['date' => '2026-01-02', 'check_in' => '—', 'check_out' => '—', 'hours' => 0, 'status' => 'absent', 'earned' => 0],
                            ['date' => '2026-01-01', 'check_in' => '08:00', 'check_out' => '17:00', 'hours' => 9, 'status' => 'present', 'earned' => 250],
                        ];
                    @endphp
                    @foreach($attendanceHistory as $att)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $att['date'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $att['check_in'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $att['check_out'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $att['hours'] }} ساعة</td>
                        <td class="px-6 py-4">
                            @if($att['status'] === 'present')
                                <x-ui.badge variant="success">حاضر</x-ui.badge>
                            @elseif($att['status'] === 'late')
                                <x-ui.badge variant="warning">متأخر</x-ui.badge>
                            @else
                                <x-ui.badge variant="danger">غائب</x-ui.badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-left text-sm font-medium text-gray-900">{{ number_format($att['earned'], 2) }} ج.م</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Transactions History --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Deductions --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">الخصومات</h3>
            </div>
            <div class="divide-y divide-gray-100">
                @php
                    $deductionHistory = $deductionHistory ?? [
                        ['date' => '2026-01-04', 'amount' => 50, 'reason' => 'تأخير 15 دقيقة'],
                        ['date' => '2026-01-02', 'amount' => 100, 'reason' => 'غياب بدون إذن'],
                    ];
                @endphp
                @forelse($deductionHistory as $ded)
                <div class="px-6 py-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-900">{{ $ded['reason'] }}</p>
                            <p class="text-xs text-gray-500">{{ $ded['date'] }}</p>
                        </div>
                        <span class="text-sm font-bold text-red-600">-{{ number_format($ded['amount'], 2) }} ج.م</span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <p class="text-gray-500">لا توجد خصومات</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Payments --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">المدفوعات المستلمة</h3>
            </div>
            <div class="divide-y divide-gray-100">
                @php
                    $paymentHistory = $paymentHistory ?? [
                        ['date' => '2026-01-05', 'amount' => 1500, 'method' => 'نقدي'],
                        ['date' => '2026-01-01', 'amount' => 2500, 'method' => 'تحويل بنكي'],
                    ];
                @endphp
                @forelse($paymentHistory as $pay)
                <div class="px-6 py-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-900">{{ $pay['method'] }}</p>
                            <p class="text-xs text-gray-500">{{ $pay['date'] }}</p>
                        </div>
                        <span class="text-sm font-bold text-green-600">+{{ number_format($pay['amount'], 2) }} ج.م</span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <p class="text-gray-500">لا توجد مدفوعات</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
