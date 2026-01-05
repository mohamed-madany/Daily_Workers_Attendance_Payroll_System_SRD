<x-layouts.app title="تسجيل دفعة">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex items-center gap-4">
            <a href="{{ route('payments.index') ?? '#' }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">تسجيل دفعة</h1>
                <p class="text-sm text-gray-500 mt-1">سجل دفعة للعامل.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">بيانات الدفعة</h3>
            </div>
            <form action="{{ route('payments.store') ?? '#' }}" method="POST" class="p-6 space-y-6">
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
                        <option value="1">أحمد حسن (رصيد: 2,500.00 ج.م)</option>
                        <option value="2">محمد علي (رصيد: 1,800.00 ج.م)</option>
                        <option value="3">خالد يوسف (رصيد: 950.00 ج.م)</option>
                        <option value="4">عمر فاروق (رصيد: 3,200.00 ج.م)</option>
                        <option value="5">محمود سمير (رصيد: 750.00 ج.م)</option>
                    </select>
                </div>

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                        المبلغ (ج.م) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="amount" 
                        name="amount" 
                        step="0.01"
                        min="0"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="0.00"
                        required
                    >
                </div>

                <div>
                    <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">
                        تاريخ الدفع <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="payment_date" 
                        name="payment_date" 
                        value="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">طريقة الدفع</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="cash" class="peer hidden" checked>
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-green-500 peer-checked:bg-green-50">
                                <svg class="w-8 h-8 mx-auto text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-2">نقدي</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="bank_transfer" class="peer hidden">
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50">
                                <svg class="w-8 h-8 mx-auto text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-2">تحويل بنكي</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="mobile_wallet" class="peer hidden">
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-purple-500 peer-checked:bg-purple-50">
                                <svg class="w-8 h-8 mx-auto text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-2">محفظة إلكترونية</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        ملاحظات <span class="text-gray-400 text-xs">(اختياري)</span>
                    </label>
                    <textarea 
                        id="notes" 
                        name="notes" 
                        rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none"
                        placeholder="أي ملاحظات إضافية..."
                    ></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <x-ui.button href="{{ route('payments.index') ?? '#' }}" variant="secondary">
                        إلغاء
                    </x-ui.button>
                    <x-ui.button type="submit" variant="success">
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        تسجيل الدفعة
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
