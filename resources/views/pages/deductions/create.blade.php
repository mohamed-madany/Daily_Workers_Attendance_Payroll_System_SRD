<x-layouts.app title="إضافة خصم">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex items-center gap-4">
            <a href="{{ route('deductions.index') ?? '#' }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إضافة خصم</h1>
                <p class="text-sm text-gray-500 mt-1">سجل خصم جديد على عامل.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">بيانات الخصم</h3>
            </div>
            <form action="{{ route('deductions.store') ?? '#' }}" method="POST" class="p-6 space-y-6">
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
                        <option value="1">أحمد حسن</option>
                        <option value="2">محمد علي</option>
                        <option value="3">خالد يوسف</option>
                        <option value="4">عمر فاروق</option>
                        <option value="5">محمود سمير</option>
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

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                        المبلغ (ج.م) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-red-500 font-bold">-</span>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount" 
                            step="0.01"
                            min="0"
                            class="w-full pr-8 pl-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="0.00"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">سبب سريع</label>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" onclick="document.getElementById('reason').value = 'تأخير في الحضور'" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                            تأخير في الحضور
                        </button>
                        <button type="button" onclick="document.getElementById('reason').value = 'انصراف مبكر'" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                            انصراف مبكر
                        </button>
                        <button type="button" onclick="document.getElementById('reason').value = 'غياب بدون إذن'" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                            غياب بدون إذن
                        </button>
                        <button type="button" onclick="document.getElementById('reason').value = 'سلفة مقدمة'" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                            سلفة مقدمة
                        </button>
                    </div>
                </div>

                <div>
                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                        السبب <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="reason" 
                        name="reason" 
                        rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none"
                        placeholder="أدخل سبب الخصم..."
                        required
                    ></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <x-ui.button href="{{ route('deductions.index') ?? '#' }}" variant="secondary">
                        إلغاء
                    </x-ui.button>
                    <x-ui.button type="submit" variant="danger">
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        إضافة الخصم
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
