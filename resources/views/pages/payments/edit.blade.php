<x-layouts.app title="تعديل الدفعة">
    {{-- Page Header --}}
    <x-slot:header>
        <div class="flex items-center gap-4">
            <a href="{{ route('payments.index') }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">تعديل الدفعة</h1>
                <p class="text-sm text-gray-500 mt-1">تعديل بيانات الدفعة.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">بيانات الدفعة</h3>
            </div>
            <form action="{{ route('payments.update', $payment) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="worker_id" class="block text-sm font-medium text-gray-700 mb-2">
                        العامل <span class="text-red-500">*</span>
                    </label>
                    <select id="worker_id" name="worker_id"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('worker_id') border-red-500 @enderror"
                        required>
                        <option value="">اختر العامل</option>
                        @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}"
                                {{ old('worker_id', $payment->worker_id) == $worker->id ? 'selected' : '' }}>
                                {{ $worker->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('worker_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="payment_amount" class="block text-sm font-medium text-gray-700 mb-2">
                        المبلغ (ج.م) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="payment_amount" name="payment_amount"
                        value="{{ old('payment_amount', $payment->payment_amount) }}" step="0.01" min="0.01"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('payment_amount') border-red-500 @enderror"
                        placeholder="0.00" required>
                    @error('payment_amount')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">
                        تاريخ الدفع <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="payment_date" name="payment_date"
                        value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('payment_date') border-red-500 @enderror"
                        required>
                    @error('payment_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">طريقة الدفع</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="cash" class="peer hidden"
                                {{ old('method', $payment->method) == 'cash' ? 'checked' : '' }}>
                            <div
                                class="p-4 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-green-500 peer-checked:bg-green-50">
                                <svg class="w-8 h-8 mx-auto text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-2">نقدي</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="bank_transfer" class="peer hidden"
                                {{ old('method', $payment->method) == 'bank_transfer' ? 'checked' : '' }}>
                            <div
                                class="p-4 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50">
                                <svg class="w-8 h-8 mx-auto text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-2">تحويل بنكي</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="method" value="mobile_wallet" class="peer hidden"
                                {{ old('method', $payment->method) == 'mobile_wallet' ? 'checked' : '' }}>
                            <div
                                class="p-4 border-2 border-gray-200 rounded-lg text-center transition-all peer-checked:border-purple-500 peer-checked:bg-purple-50">
                                <svg class="w-8 h-8 mx-auto text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 mt-2">محفظة إلكترونية</p>
                            </div>
                        </label>
                    </div>
                    @error('method')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        ملاحظات <span class="text-gray-400 text-xs">(اختياري)</span>
                    </label>
                    <textarea id="notes" name="notes" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 resize-none"
                        placeholder="أي ملاحظات إضافية...">{{ old('notes', $payment->notes) }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <x-ui.button href="{{ route('payments.index') }}" variant="secondary">
                        إلغاء
                    </x-ui.button>
                    <x-ui.button type="submit" variant="primary">
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        حفظ التعديلات
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
