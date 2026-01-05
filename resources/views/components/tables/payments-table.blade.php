{{-- 
    Payments Table Component
    
    Usage:
    <x-tables.payments-table :payments="$payments" />
--}}

@props([
    'payments' => [],
])

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    {{-- Table Header --}}
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Payments</h3>
            <div class="flex items-center gap-3">
                {{-- Filter by Method --}}
                <select class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">All Methods</option>
                    <option value="cash">Cash</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="mobile_wallet">Mobile Wallet</option>
                </select>
                {{-- Add Button --}}
                <x-ui.button href="{{ route('payments.create') ?? '#' }}" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Record Payment
                </x-ui.button>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Worker</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Payment Date</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Notes</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-semibold text-purple-700">{{ substr($payment['worker_name'] ?? 'W', 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $payment['worker_name'] ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900">{{ $payment['payment_date'] ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-green-600">{{ number_format($payment['amount'] ?? 0, 2) }} EGP</span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $method = $payment['method'] ?? 'cash';
                            $methodLabels = [
                                'cash' => ['label' => 'Cash', 'variant' => 'success'],
                                'bank_transfer' => ['label' => 'Bank Transfer', 'variant' => 'info'],
                                'mobile_wallet' => ['label' => 'Mobile Wallet', 'variant' => 'primary'],
                            ];
                            $methodInfo = $methodLabels[$method] ?? ['label' => ucfirst($method), 'variant' => 'gray'];
                        @endphp
                        <x-ui.badge :variant="$methodInfo['variant']">{{ $methodInfo['label'] }}</x-ui.badge>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-500 truncate max-w-xs block">{{ $payment['notes'] ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="View Receipt">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
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
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 mb-2">No payments found</p>
                            <x-ui.button href="{{ route('payments.create') ?? '#' }}" size="sm">Record payment</x-ui.button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($payments, 'links'))
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $payments->links() }}
    </div>
    @endif
</div>
