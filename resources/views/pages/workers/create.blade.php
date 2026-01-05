<x-layouts.app title="إضافة عامل">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex items-center gap-4">
            <a href="{{ route('workers.index') ?? '#' }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إضافة عامل جديد</h1>
                <p class="text-sm text-gray-500 mt-1">أدخل بيانات العامل الجديد.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">بيانات العامل</h3>
            </div>
            <form action="{{ route('workers.store') ?? '#' }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        الاسم الكامل <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="أدخل اسم العامل"
                        required
                    >
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        الوظيفة <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="role" 
                        name="role" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        required
                    >
                        <option value="">اختر الوظيفة</option>
                        <option value="general">عامل عادي</option>
                        <option value="skilled">عامل ماهر</option>
                        <option value="supervisor">مشرف</option>
                        <option value="foreman">رئيس عمال</option>
                    </select>
                </div>

                <div>
                    <label for="daily_fee" class="block text-sm font-medium text-gray-700 mb-2">
                        الأجر اليومي (ج.م) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="daily_fee" 
                        name="daily_fee" 
                        step="0.01"
                        min="0"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="0.00"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="active" class="w-4 h-4 text-primary-600" checked>
                            <span class="mr-2 text-sm text-gray-700">نشط</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="inactive" class="w-4 h-4 text-primary-600">
                            <span class="mr-2 text-sm text-gray-700">غير نشط</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        رقم الهاتف <span class="text-gray-400 text-xs">(اختياري)</span>
                    </label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="01xxxxxxxxx"
                    >
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <x-ui.button href="{{ route('workers.index') ?? '#' }}" variant="secondary">
                        إلغاء
                    </x-ui.button>
                    <x-ui.button type="submit">
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        حفظ العامل
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
