{{-- 
    Daily Ledger Table Component
    
    Usage:
    <x-tables.ledger-table :entries="$ledger" />
--}}

@props([
    'entries' => [],
])

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    {{-- Table Header --}}
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Daily Ledger</h3>
            <div class="flex items-center gap-3">
                {{-- Date Range Filter --}}
                <div class="flex items-center gap-2">
                    <input 
                        type="date" 
                        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="From"
                    >
                    <span class="text-gray-400">to</span>
                    <input 
                        type="date" 
                        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="To"
                    >
                </div>
                {{-- Export Button --}}
                <x-ui.button variant="secondary" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export
                </x-ui.button>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-gray-50 border-b border-gray-200">
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Total Gross</p>
            <p class="text-xl font-bold text-gray-900">{{ number_format($entries->sum('gross_earned') ?? 0, 2) }} EGP</p>
        </div>
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Total Deductions</p>
            <p class="text-xl font-bold text-red-600">{{ number_format($entries->sum('deductions') ?? 0, 2) }} EGP</p>
        </div>
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Net Earnings</p>
            <p class="text-xl font-bold text-green-600">{{ number_format($entries->sum('net_earned') ?? 0, 2) }} EGP</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Worker</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Gross Earned</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Deductions</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Net Earned</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($entries as $entry)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-semibold text-green-700">{{ substr($entry['worker_name'] ?? 'W', 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $entry['worker_name'] ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900">{{ $entry['date'] ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-medium text-gray-900">{{ number_format($entry['gross_earned'] ?? 0, 2) }} EGP</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if(($entry['deductions'] ?? 0) > 0)
                            <span class="text-sm font-medium text-red-600">-{{ number_format($entry['deductions'] ?? 0, 2) }} EGP</span>
                        @else
                            <span class="text-sm text-gray-400">0.00 EGP</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-green-600">{{ number_format($entry['net_earned'] ?? 0, 2) }} EGP</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-500">No ledger entries found</p>
                            <p class="text-xs text-gray-400 mt-1">Entries are automatically generated from attendance records</p>
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
                        <span class="text-sm font-bold text-gray-900">Total</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-gray-900">{{ number_format($entries->sum('gross_earned') ?? 0, 2) }} EGP</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-red-600">-{{ number_format($entries->sum('deductions') ?? 0, 2) }} EGP</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-green-600">{{ number_format($entries->sum('net_earned') ?? 0, 2) }} EGP</span>
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($entries, 'links'))
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $entries->links() }}
    </div>
    @endif
</div>
