{{-- 
    Attendance Table Component
    
    Usage:
    <x-tables.attendance-table :records="$attendance" />
--}}

@props([
    'records' => [],
])

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    {{-- Table Header --}}
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Attendance Records</h3>
            <div class="flex items-center gap-3">
                {{-- Date Filter --}}
                <input 
                    type="date" 
                    class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    value="{{ date('Y-m-d') }}"
                >
                {{-- Add Button --}}
                <x-ui.button href="{{ route('attendance.create') ?? '#' }}" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Record Attendance
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-in</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-out</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Worked Hours</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($records as $record)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-semibold text-primary-700">{{ substr($record['worker_name'] ?? 'W', 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $record['worker_name'] ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900">{{ $record['date'] ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center text-sm text-gray-900">
                            <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            {{ $record['check_in'] ?? '—' }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center text-sm text-gray-900">
                            <svg class="w-4 h-4 mr-1.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            {{ $record['check_out'] ?? '—' }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-gray-900">{{ $record['worked_hours'] ?? '0' }} hrs</span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $status = $record['status'] ?? 'present';
                        @endphp
                        @if($status === 'present')
                            <x-ui.badge variant="success">Present</x-ui.badge>
                        @elseif($status === 'late')
                            <x-ui.badge variant="warning">Late</x-ui.badge>
                        @elseif($status === 'absent')
                            <x-ui.badge variant="danger">Absent</x-ui.badge>
                        @else
                            <x-ui.badge variant="gray">{{ ucfirst($status) }}</x-ui.badge>
                        @endif
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
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500 mb-2">No attendance records found</p>
                            <x-ui.button href="{{ route('attendance.create') ?? '#' }}" size="sm">Record attendance</x-ui.button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($records, 'links'))
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $records->links() }}
    </div>
    @endif
</div>
