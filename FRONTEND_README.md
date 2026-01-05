# نظام العمال اليومية - Daily Workers ERP System

## 📖 دليل واجهة المستخدم (Frontend Guide)

هذا الدليل يشرح كيفية التعامل مع واجهة المستخدم والتطوير على الـ Frontend.

---

## 🚀 البدء السريع

### المتطلبات

-   PHP 8.2+
-   Node.js 18+
-   Composer
-   npm

### تشغيل المشروع

```bash
# 1. تثبيت الحزم
composer install
npm install

# 2. إعداد البيئة
cp .env.example .env
php artisan key:generate

# 3. تشغيل السيرفرات (في نافذتين مختلفتين)

# النافذة الأولى - Vite (لتجميع CSS و JS)
npm run dev

# النافذة الثانية - Laravel Server
php artisan serve
```

### الوصول للتطبيق

-   **التطبيق:** http://localhost:8000
-   **Vite Dev Server:** http://localhost:5173

> ⚠️ **مهم:** يجب تشغيل Vite (`npm run dev`) حتى يظهر التنسيق (CSS) بشكل صحيح.

---

## 📁 هيكل الملفات

```
resources/
├── css/
│   └── app.css                 # ملف Tailwind CSS الرئيسي
├── js/
│   └── app.js                  # JavaScript الرئيسي
└── views/
    ├── components/
    │   ├── layouts/            # القوالب الرئيسية
    │   │   ├── app.blade.php   # القالب الرئيسي للتطبيق
    │   │   └── auth.blade.php  # قالب تسجيل الدخول
    │   ├── navigation/         # مكونات التنقل
    │   │   ├── sidebar.blade.php
    │   │   └── topbar.blade.php
    │   ├── ui/                 # مكونات واجهة المستخدم
    │   │   ├── button.blade.php
    │   │   ├── badge.blade.php
    │   │   ├── modal.blade.php
    │   │   ├── card.blade.php
    │   │   ├── input.blade.php
    │   │   └── select.blade.php
    │   ├── tables/             # مكونات الجداول
    │   └── forms/              # مكونات النماذج
    └── pages/                  # صفحات التطبيق
        ├── dashboard.blade.php
        ├── workers/
        ├── attendance/
        ├── deductions/
        ├── ledger/
        ├── payments/
        └── reports/
```

---

## 🎨 التقنيات المستخدمة

| التقنية             | الاستخدام                             |
| ------------------- | ------------------------------------- |
| **Laravel Blade**   | محرك القوالب                          |
| **Tailwind CSS v4** | التنسيق والتصميم                      |
| **Alpine.js**       | التفاعلات البسيطة (modals, dropdowns) |
| **Vite**            | تجميع الأصول                          |

---

## 🧩 استخدام المكونات

### 1. الأزرار (Buttons)

```blade
{{-- الزر الأساسي --}}
<x-ui.button>حفظ</x-ui.button>

{{-- زر ثانوي --}}
<x-ui.button variant="secondary">إلغاء</x-ui.button>

{{-- زر خطر --}}
<x-ui.button variant="danger">حذف</x-ui.button>

{{-- زر نجاح --}}
<x-ui.button variant="success">تأكيد</x-ui.button>

{{-- زر كرابط --}}
<x-ui.button href="/workers">عرض العمال</x-ui.button>

{{-- أحجام مختلفة: xs, sm, md, lg, xl --}}
<x-ui.button size="sm">زر صغير</x-ui.button>
```

### 2. الشارات (Badges)

```blade
<x-ui.badge variant="success">نشط</x-ui.badge>
<x-ui.badge variant="danger">غائب</x-ui.badge>
<x-ui.badge variant="warning">متأخر</x-ui.badge>
<x-ui.badge variant="primary">جديد</x-ui.badge>
<x-ui.badge variant="gray">غير نشط</x-ui.badge>
```

### 3. النوافذ المنبثقة (Modals)

```blade
<div x-data="{ showModal: false }">
    <x-ui.button @click="showModal = true">فتح النافذة</x-ui.button>

    <x-ui.modal show="showModal" title="عنوان النافذة">
        <p>محتوى النافذة هنا</p>

        <x-slot:footer>
            <x-ui.button @click="showModal = false" variant="secondary">إلغاء</x-ui.button>
            <x-ui.button>تأكيد</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
</div>
```

### 4. البطاقات (Cards)

```blade
<x-ui.card title="عنوان البطاقة">
    <p>محتوى البطاقة</p>

    <x-slot:footer>
        <x-ui.button>إجراء</x-ui.button>
    </x-slot:footer>
</x-ui.card>
```

---

## 📄 إنشاء صفحة جديدة

### 1. إنشاء ملف الـ View

```blade
{{-- resources/views/pages/example/index.blade.php --}}

<x-layouts.app title="عنوان الصفحة">
    {{-- رأس الصفحة --}}
    <x-slot:header>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">عنوان الصفحة</h1>
                <p class="text-sm text-gray-500 mt-1">وصف مختصر للصفحة.</p>
            </div>
            <x-ui.button href="#">
                إضافة جديد
            </x-ui.button>
        </div>
    </x-slot:header>

    {{-- محتوى الصفحة --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <p>محتوى الصفحة هنا</p>
    </div>
</x-layouts.app>
```

### 2. إضافة Route

```php
// routes/web.php

Route::get('/example', function () {
    return view('pages.example.index');
})->name('example.index');
```

### 3. إضافة رابط في الـ Sidebar (اختياري)

```blade
{{-- resources/views/components/navigation/sidebar.blade.php --}}

<a href="{{ route('example.index') }}"
   class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors
          {{ request()->routeIs('example.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {{-- أيقونة SVG --}}
    </svg>
    اسم الصفحة
</a>
```

---

## 🎯 أنماط Tailwind الشائعة

### البطاقات والحاويات

```html
<div class="bg-white rounded-xl border border-gray-200 p-6"></div>
```

### الجداول

```html
<table class="w-full">
    <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
            <th
                class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase"
            >
                العمود
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 text-sm text-gray-900">القيمة</td>
        </tr>
    </tbody>
</table>
```

### حقول الإدخال

```html
<input
    type="text"
    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg 
              focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
/>
```

### الشبكة (Grid)

```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div>عنصر 1</div>
    <div>عنصر 2</div>
</div>
```

---

## 🔧 تخصيص الألوان

الألوان معرفة في `resources/css/app.css`:

```css
@theme {
    /* اللون الأساسي - أزرق */
    --color-primary-500: #3b82f6;
    --color-primary-600: #2563eb;

    /* لون النجاح - أخضر */
    --color-success-500: #22c55e;

    /* لون التحذير - برتقالي */
    --color-warning-500: #f59e0b;

    /* لون الخطر - أحمر */
    --color-danger-500: #ef4444;
}
```

---

## 📱 الاستجابة (Responsive)

التصميم يستخدم نظام Tailwind للاستجابة:

| البادئة | الحد الأدنى للعرض |
| ------- | ----------------- |
| `sm:`   | 640px             |
| `md:`   | 768px             |
| `lg:`   | 1024px            |
| `xl:`   | 1280px            |

مثال:

```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4"></div>
```

---

## 🔄 تحديث المحتوى

### تغيير اللغة

الواجهة حالياً بالعربية. النصوص موجودة مباشرة في ملفات Blade.

### إضافة أيقونات

نستخدم Heroicons SVG. يمكنك الحصول على أيقونات من:

-   [Heroicons](https://heroicons.com/)

---

## 🐛 حل المشاكل الشائعة

### CSS لا يظهر

1. تأكد من تشغيل Vite: `npm run dev`
2. أعد تحميل الصفحة: `Ctrl+Shift+R`
3. امسح الكاش: `php artisan view:clear`

### الصفحة فارغة

1. تحقق من Laravel: `php artisan serve`
2. تحقق من الأخطاء في المتصفح: `F12` → Console

### تغييرات لا تظهر

```bash
php artisan view:clear
php artisan cache:clear
```

---

## 📚 مصادر مفيدة

-   [Tailwind CSS Docs](https://tailwindcss.com/docs)
-   [Laravel Blade Docs](https://laravel.com/docs/blade)
-   [Alpine.js Docs](https://alpinejs.dev/)
-   [Heroicons](https://heroicons.com/)

---

## 📞 الدعم

للأسئلة أو المشاكل، تواصل مع فريق التطوير.

---

**تم إنشاء هذا الدليل في:** يناير 2026
