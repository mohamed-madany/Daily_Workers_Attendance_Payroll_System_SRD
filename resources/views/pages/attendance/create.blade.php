<x-layouts.app title="تسجيل الحضور">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex items-center gap-4">
            <a href="{{ route('attendance.index') ?? '#' }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">تسجيل الحضور</h1>
                <p class="text-sm text-gray-500 mt-1">سجل حضور العامل.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">بيانات الحضور</h3>
            </div>
            <form action="{{ route('attendance.store') ?? '#' }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <div>
                    <label for="worker_id" class="block text-sm font-medium text-gray-700 mb-2">
                        العامل <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="worker_id" 
                        name="worker_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        required
                    >
                        <option value="">اختر العامل</option>
                        <option value="1">أحمد حسن - مشرف</option>
                        <option value="2">محمد علي - عامل ماهر</option>
                        <option value="3">خالد يوسف - عامل عادي</option>
                        <option value="4">عمر فاروق - رئيس عمال</option>
                        <option value="5">محمود سمير - عامل عادي</option>
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                        التاريخ <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="date" 
                        name="date" 
                        value="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        required
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="check_in" class="block text-sm font-medium text-gray-700 mb-2">
                            وقت الحضور
                        </label>
                        <input 
                            type="time" 
                            id="check_in" 
                            name="check_in" 
                            value="08:00"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        >
                    </div>
                    <div>
                        <label for="check_out" class="block text-sm font-medium text-gray-700 mb-2">
                            وقت الانصراف
                        </label>
                        <input 
                            type="time" 
                            id="check_out" 
                            name="check_out" 
                            value="17:00"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="present" class="peer hidden" checked>
                            <div class="p-3 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-green-500 peer-checked:bg-green-50">
                                <svg class="w-6 h-6 mx-auto text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-1">حاضر</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="late" class="peer hidden">
                            <div class="p-3 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-yellow-500 peer-checked:bg-yellow-50">
                                <svg class="w-6 h-6 mx-auto text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-1">متأخر</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="half_day" class="peer hidden">
                            <div class="p-3 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                <svg class="w-6 h-6 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-1">نصف يوم</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="absent" class="peer hidden">
                            <div class="p-3 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-red-500 peer-checked:bg-red-50">
                                <svg class="w-6 h-6 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-1">غائب</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <x-ui.button href="{{ route('attendance.index') ?? '#' }}" variant="secondary">
                        إلغاء
                    </x-ui.button>
                    <x-ui.button type="submit">
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        حفظ الحضور
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
