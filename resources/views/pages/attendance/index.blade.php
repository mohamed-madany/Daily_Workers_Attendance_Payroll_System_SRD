<x-layouts.app title="الحضور">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">الحضور</h1>
                <p class="text-sm text-gray-500 mt-1">تتبع وإدارة حضور العمال اليومي.</p>
            </div>
            <x-ui.button href="{{ route('attendance.create') ?? '#' }}">
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                تسجيل الحضور
            </x-ui.button>
        </div>
    </x-slot:header>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">حاضرون اليوم</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ $stats['present'] ?? 21 }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">متأخرون اليوم</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $stats['late'] ?? 2 }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">غائبون اليوم</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">{{ $stats['absent'] ?? 1 }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">إجمالي الساعات</p>
                    <p class="text-2xl font-bold text-primary-600 mt-1">{{ $stats['total_hours'] ?? 189 }}</p>
                </div>
                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Attendance Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-900">سجل الحضور</h3>
                <div class="flex items-center gap-3">
                    <input 
                        type="date" 
                        value="{{ date('Y-m-d') }}"
                        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">العامل</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">التاريخ</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الحضور</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الانصراف</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">ساعات العمل</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الحالة</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $records = $records ?? collect([
                            ['id' => 1, 'worker_name' => 'أحمد حسن', 'date' => date('Y-m-d'), 'check_in' => '08:00', 'check_out' => '17:00', 'worked_hours' => 9, 'status' => 'present'],
                            ['id' => 2, 'worker_name' => 'محمد علي', 'date' => date('Y-m-d'), 'check_in' => '08:30', 'check_out' => '17:00', 'worked_hours' => 8.5, 'status' => 'late'],
                            ['id' => 3, 'worker_name' => 'خالد يوسف', 'date' => date('Y-m-d'), 'check_in' => '08:00', 'check_out' => '17:00', 'worked_hours' => 9, 'status' => 'present'],
                            ['id' => 4, 'worker_name' => 'عمر فاروق', 'date' => date('Y-m-d'), 'check_in' => '—', 'check_out' => '—', 'worked_hours' => 0, 'status' => 'absent'],
                            ['id' => 5, 'worker_name' => 'محمود سمير', 'date' => date('Y-m-d'), 'check_in' => '08:00', 'check_out' => '13:00', 'worked_hours' => 5, 'status' => 'half_day'],
                        ]);
                    @endphp
                    @forelse($records as $record)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center ml-3">
                                    <span class="text-xs font-semibold text-primary-700">{{ mb_substr($record['worker_name'], 0, 1) }}</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $record['worker_name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ $record['date'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ $record['check_in'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ $record['check_out'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ $record['worked_hours'] }} ساعة</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($record['status'] === 'present')
                                <x-ui.badge variant="success">حاضر</x-ui.badge>
                            @elseif($record['status'] === 'late')
                                <x-ui.badge variant="warning">متأخر</x-ui.badge>
                            @elseif($record['status'] === 'half_day')
                                <x-ui.badge variant="info">نصف يوم</x-ui.badge>
                            @else
                                <x-ui.badge variant="danger">غائب</x-ui.badge>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <button class="p-1.5 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <p class="text-gray-500">لا توجد سجلات حضور</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
