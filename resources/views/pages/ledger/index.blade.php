<x-layouts.app title="السجل اليومي">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">السجل اليومي</h1>
                <p class="text-sm text-gray-500 mt-1">عرض ملخص الأرباح اليومية لجميع العمال.</p>
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

    @php
        $entries = $entries ?? collect([
            ['id' => 1, 'worker_name' => 'أحمد حسن', 'date' => date('Y-m-d'), 'gross_earned' => 250, 'deductions' => 0, 'net_earned' => 250],
            ['id' => 2, 'worker_name' => 'محمد علي', 'date' => date('Y-m-d'), 'gross_earned' => 200, 'deductions' => 50, 'net_earned' => 150],
            ['id' => 3, 'worker_name' => 'خالد يوسف', 'date' => date('Y-m-d'), 'gross_earned' => 150, 'deductions' => 100, 'net_earned' => 50],
            ['id' => 4, 'worker_name' => 'عمر فاروق', 'date' => date('Y-m-d'), 'gross_earned' => 0, 'deductions' => 0, 'net_earned' => 0],
            ['id' => 5, 'worker_name' => 'محمود سمير', 'date' => date('Y-m-d'), 'gross_earned' => 75, 'deductions' => 0, 'net_earned' => 75],
        ]);
        
        $totalGross = $entries->sum('gross_earned');
        $totalDeductions = $entries->sum('deductions');
        $totalNet = $entries->sum('net_earned');
    @endphp

    {{-- Ledger Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-900">السجل اليومي</h3>
                <div class="flex items-center gap-3">
                    {{-- Date Range Filter --}}
                    <div class="flex items-center gap-2">
                        <input 
                            type="date" 
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="من"
                        >
                        <span class="text-gray-400">إلى</span>
                        <input 
                            type="date" 
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="إلى"
                        >
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-gray-50 border-b border-gray-200">
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">إجمالي الأجور</p>
                <p class="text-xl font-bold text-gray-900">{{ number_format($totalGross, 2) }} ج.م</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">إجمالي الخصومات</p>
                <p class="text-xl font-bold text-red-600">{{ number_format($totalDeductions, 2) }} ج.م</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">صافي الأرباح</p>
                <p class="text-xl font-bold text-green-600">{{ number_format($totalNet, 2) }} ج.م</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">العامل</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">التاريخ</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">إجمالي الأجر</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">الخصومات</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">صافي الأجر</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($entries as $entry)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center ml-3">
                                    <span class="text-xs font-semibold text-green-700">{{ mb_substr($entry['worker_name'], 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $entry['worker_name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ $entry['date'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-medium text-gray-900">{{ number_format($entry['gross_earned'], 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            @if($entry['deductions'] > 0)
                                <span class="text-sm font-medium text-red-600">-{{ number_format($entry['deductions'], 2) }} ج.م</span>
                            @else
                                <span class="text-sm text-gray-400">0.00 ج.م</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-green-600">{{ number_format($entry['net_earned'], 2) }} ج.م</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500">لا توجد سجلات</p>
                                <p class="text-xs text-gray-400 mt-1">يتم إنشاء السجلات تلقائياً من سجلات الحضور</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                {{-- Table Footer with Totals --}}
                @if(count($entries) > 0)
                <tfoot class="bg-gray-50 border-t-2 border-gray-300">
                    <tr>
                        <td colspan="2" class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900">الإجمالي</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-gray-900">{{ number_format($totalGross, 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-red-600">-{{ number_format($totalDeductions, 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <span class="text-sm font-bold text-green-600">{{ number_format($totalNet, 2) }} ج.م</span>
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{-- Info Note --}}
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 ml-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-sm text-blue-800 font-medium">حول السجل اليومي</p>
                <p class="text-sm text-blue-700 mt-1">
                    يتم حساب السجل اليومي تلقائياً بناءً على سجلات الحضور وأجور العمال اليومية.
                    يتم خصم الخصومات من إجمالي الأجور لحساب صافي الأرباح.
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
