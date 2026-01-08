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
        <form class="flex flex-col sm:flex-row sm:items-end gap-4" method="POST" action="{{ route('reports.worker.filter') }}">
            @csrf
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">اختر العامل</label>
                <select
                    name="worker_id"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    required

                >
                    <option value="">اختر عامل</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }} - {{ $worker->role }}</option>
                    @endforeach
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
                    value="{{ date('Y-m-d', strtotime('+1 day')) }}"
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

    @if(isset($selectedWorker))
        @include('pages.reports.show-worker', [
            'selectedWorker' => $selectedWorker,
            'summary' => $summary ?? [],
        ])
    @endif

</x-layouts.app>
