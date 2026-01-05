<x-layouts.app title="المدفوعات">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">المدفوعات</h1>
                <p class="text-sm text-gray-500 mt-1">تتبع جميع مدفوعات وتسويات العمال.</p>
            </div>
            <x-ui.button href="{{ route('payments.create') ?? '#' }}">
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                تسجيل دفعة
            </x-ui.button>
        </div>
    </x-slot:header>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">مدفوعات اليوم</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ number_format($stats['today'] ?? 3500, 2) }} ج.م</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">هذا الأسبوع</p>
                    <p class="text-2xl font-bold text-primary-600 mt-1">{{ number_format($stats['week'] ?? 18500, 2) }} ج.م</p>
                </div>
                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">هذا الشهر</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($stats['month'] ?? 72500, 2) }} ج.م</p>
                </div>
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">الرصيد المستحق</p>
                    <p class="text-2xl font-bold text-orange-600 mt-1">{{ number_format($stats['outstanding'] ?? 12500, 2) }} ج.م</p>
                </div>
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Payments Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-900">سجل المدفوعات</h3>
                <div class="flex items-center gap-3">
                    <select class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">جميع الطرق</option>
                        <option value="cash">نقدي</option>
                        <option value="bank_transfer">تحويل بنكي</option>
                        <option value="mobile_wallet">محفظة إلكترونية</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">العامل</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">التاريخ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">المبلغ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الطريقة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">ملاحظات</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $payments = $payments ?? collect([
                            ['id' => 1, 'worker_name' => 'أحمد حسن', 'payment_date' => date('Y-m-d'), 'amount' => 1500, 'method' => 'cash', 'notes' => 'دفعة أسبوعية'],
                            ['id' => 2, 'worker_name' => 'محمد علي', 'payment_date' => date('Y-m-d'), 'amount' => 2000, 'method' => 'bank_transfer', 'notes' => 'تحويل بنكي'],
                            ['id' => 3, 'worker_name' => 'خالد يوسف', 'payment_date' => date('Y-m-d', strtotime('-1 day')), 'amount' => 1200, 'method' => 'mobile_wallet', 'notes' => 'فودافون كاش'],
                            ['id' => 4, 'worker_name' => 'عمر فاروق', 'payment_date' => date('Y-m-d', strtotime('-2 days')), 'amount' => 800, 'method' => 'cash', 'notes' => ''],
                        ]);
                    @endphp
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center ml-3">
                                    <span class="text-xs font-semibold text-green-700">{{ mb_substr($payment['worker_name'], 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $payment['worker_name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ $payment['payment_date'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-green-600">{{ number_format($payment['amount'], 2) }} ج.م</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($payment['method'] === 'cash')
                                <x-ui.badge variant="success">نقدي</x-ui.badge>
                            @elseif($payment['method'] === 'bank_transfer')
                                <x-ui.badge variant="primary">تحويل بنكي</x-ui.badge>
                            @else
                                <x-ui.badge variant="info">محفظة إلكترونية</x-ui.badge>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">{{ $payment['notes'] ?: '—' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <button class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <p class="text-gray-500">لا توجد مدفوعات مسجلة</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
