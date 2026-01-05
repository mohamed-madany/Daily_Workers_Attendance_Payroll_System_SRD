<x-layouts.app title="التقرير الشهري">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">التقرير الشهري</h1>
                <p class="text-sm text-gray-500 mt-1">نظرة عامة على نشاط العمال والمالية الشهرية.</p>
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
                    تصدير Excel
                </x-ui.button>
            </div>
        </div>
    </x-slot:header>

    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <form class="flex flex-col sm:flex-row sm:items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">الشهر</label>
                <input 
                    type="month" 
                    name="month" 
                    value="{{ date('Y-m') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                >
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">العامل (اختياري)</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">جميع العمال</option>
                    <option value="1">أحمد حسن</option>
                    <option value="2">محمد علي</option>
                    <option value="3">خالد يوسف</option>
                </select>
            </div>
            <x-ui.button type="submit">
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                تطبيق
            </x-ui.button>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">أيام العمل</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $summary['working_days'] ?? 22 }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">إجمالي الأجور</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($summary['gross'] ?? 132000, 2) }} ج.م</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">إجمالي الخصومات</p>
            <p class="text-2xl font-bold text-red-600 mt-1">{{ number_format($summary['deductions'] ?? 4500, 2) }} ج.م</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-xs text-gray-500 uppercase tracking-wider">صافي المستحق</p>
            <p class="text-2xl font-bold text-green-600 mt-1">{{ number_format($summary['net'] ?? 127500, 2) }} ج.م</p>
        </div>
    </div>

    {{-- Report Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">ملخص العمال - {{ date('F Y') }}</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">العامل</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">أيام العمل</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">أيام الغياب</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">إجمالي الأجر</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">الخصومات</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">المدفوعات</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">الرصيد</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $reportData = $reportData ?? [
                            ['name' => 'أحمد حسن', 'days_worked' => 20, 'days_absent' => 2, 'gross' => 5000, 'deductions' => 150, 'payments' => 4000, 'balance' => 850],
                            ['name' => 'محمد علي', 'days_worked' => 22, 'days_absent' => 0, 'gross' => 4400, 'deductions' => 200, 'payments' => 3500, 'balance' => 700],
                            ['name' => 'خالد يوسف', 'days_worked' => 18, 'days_absent' => 4, 'gross' => 2700, 'deductions' => 100, 'payments' => 2000, 'balance' => 600],
                            ['name' => 'عمر فاروق', 'days_worked' => 21, 'days_absent' => 1, 'gross' => 6300, 'deductions' => 0, 'payments' => 5000, 'balance' => 1300],
                            ['name' => 'محمود سمير', 'days_worked' => 19, 'days_absent' => 3, 'gross' => 2850, 'deductions' => 50, 'payments' => 2500, 'balance' => 300],
                        ];
                    @endphp
                    @foreach($reportData as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center ml-3">
                                    <span class="text-xs font-semibold text-primary-700">{{ mb_substr($row['name'], 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $row['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-medium text-green-600">{{ $row['days_worked'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-medium {{ $row['days_absent'] > 0 ? 'text-red-600' : 'text-gray-500' }}">{{ $row['days_absent'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm text-gray-900">{{ number_format($row['gross'], 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm {{ $row['deductions'] > 0 ? 'text-red-600' : 'text-gray-400' }}">
                                {{ $row['deductions'] > 0 ? '-' . number_format($row['deductions'], 2) : '0.00' }} ج.م
                            </span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm text-gray-900">{{ number_format($row['payments'], 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold {{ $row['balance'] > 0 ? 'text-orange-600' : 'text-green-600' }}">
                                {{ number_format($row['balance'], 2) }} ج.م
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 border-t-2 border-gray-300">
                    <tr>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900">الإجمالي</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-bold text-gray-900">{{ array_sum(array_column($reportData, 'days_worked')) }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-bold text-gray-900">{{ array_sum(array_column($reportData, 'days_absent')) }}</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-gray-900">{{ number_format(array_sum(array_column($reportData, 'gross')), 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-red-600">-{{ number_format(array_sum(array_column($reportData, 'deductions')), 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-gray-900">{{ number_format(array_sum(array_column($reportData, 'payments')), 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-orange-600">{{ number_format(array_sum(array_column($reportData, 'balance')), 2) }} ج.م</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layouts.app>
