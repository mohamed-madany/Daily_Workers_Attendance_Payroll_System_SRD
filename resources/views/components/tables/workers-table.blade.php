{{-- 
    Workers Table Component
    
    Usage:
    <x-tables.workers-table :workers="$workers" />
--}}

@props([
    'workers' => [],
])

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    {{-- Table Header --}}
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Workers</h3>
            <div class="flex items-center gap-3">
                {{-- Search --}}
                <div class="relative">
                    <input 
                        type="text" 
                        placeholder="Search workers..." 
                        class="pl-10 pr-4 py-2 w-full sm:w-64 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                {{-- Add Button --}}
                <x-ui.button href="{{ route('workers.create') ?? '#' }}" size="sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Worker
                </x-ui.button>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Daily Fee</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($workers as $worker)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-semibold text-primary-700">{{ substr($worker['name'] ?? 'W', 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $worker['name'] ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $worker['id'] ?? '—' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900">{{ $worker['role'] ?? 'General' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-gray-900">{{ number_format($worker['daily_fee'] ?? 0, 2) }} EGP</span>
                    </td>
                    <td class="px-6 py-4">
                        @if(($worker['status'] ?? 'active') === 'active')
                            <x-ui.badge variant="success">Active</x-ui.badge>
                        @else
                            <x-ui.badge variant="gray">Inactive</x-ui.badge>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('workers.edit', $worker['id'] ?? 1) ?? '#' }}" class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button 
                                @click="$dispatch('open-modal', 'delete-worker-{{ $worker['id'] ?? 0 }}')"
                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                title="Delete"
                            >
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-gray-500 mb-2">No workers found</p>
                            <x-ui.button href="{{ route('workers.create') ?? '#' }}" size="sm">Add your first worker</x-ui.button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($workers, 'links'))
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $workers->links() }}
    </div>
    @endif
</div>
