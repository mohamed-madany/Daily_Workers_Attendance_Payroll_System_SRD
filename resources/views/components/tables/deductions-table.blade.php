{{-- 
    Deductions Table Component
    
    Usage:
    <x-tables.deductions-table :deductions="$deductions" />
--}}

@props([
    'deductions' => [],
])

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    {{-- Table Header --}}
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Deductions</h3>
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <div class="relative">
                    <input 
                        type="text" 
                        placeholder="Search deductions..." 
                        class="pl-10 pr-4 py-2 w-full sm:w-56 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                {{-- Add Button --}}
                <x-ui.button href="{{ route('deductions.create') ?? '#' }}" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Deduction
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Reason</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($deductions as $deduction)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-semibold text-orange-700">{{ substr($deduction['worker_name'] ?? 'W', 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $deduction['worker_name'] ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900">{{ $deduction['date'] ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-semibold text-red-600">-{{ number_format($deduction['amount'] ?? 0, 2) }} EGP</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-700">{{ $deduction['reason'] ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
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
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 mb-2">No deductions found</p>
                            <x-ui.button href="{{ route('deductions.create') ?? '#' }}" size="sm">Add deduction</x-ui.button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($deductions, 'links'))
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $deductions->links() }}
    </div>
    @endif
</div>
