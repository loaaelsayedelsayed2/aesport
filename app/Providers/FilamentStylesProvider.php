<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class FilamentStylesProvider extends ServiceProvider
{
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn() => <<<'HTML'
<style>
    /* --- الإعدادات العامة للجسم والخلفية --- */
    body.fi-body,
    .fi-main,
    .fi-app-layout,
    .fi-main-ctn {
        background-color: #242323 !important;
        color: #FFFFFF !important;
    }

    /* --- القائمة الجانبية (Sidebar) --- */
    .fi-sidebar {
        background-color: #151515 !important;
        border-right: 1px solid #1a1a1a !important;
        box-shadow: none !important;
    }

    .fi-sidebar-item-label,
    .fi-sidebar-item-icon {
        color: #AFAFAF !important;
    }

    .fi-sidebar-item.fi-active .fi-sidebar-item-icon,
    .fi-sidebar-item.fi-active .fi-sidebar-item-label,
    .fi-sidebar-item:hover .fi-sidebar-item-icon,
    .fi-sidebar-item:hover .fi-sidebar-item-label {
        color: #B91818 !important;
        background-color: transparent !important;
    }

    /* --- الهيدر والتوب بار --- */
    .fi-topbar {
        background-color: #151515 !important;
        box-shadow: none !important;
        border-bottom: 1px solid #1a1a1a !important;
    }

    .fi-header-heading {
        color: #B91818 !important;
    }
    .fi-header-subheading {
        color: #FFFFFF !important;
    }

    /* --- كروت الإحصائيات (Stats Overview) --- */
    .fi-wi-stats-overview-stat {
        background-color: #2B2B2B !important;
        border: 1px solid #626262 !important;
        transition: transform .2s ease;
    }

    .fi-wi-stats-overview-stat:hover {
        transform: translateY(-2px);
    }

    .fi-wi-stats-overview-stat-value {
        color: #FFFFFF !important;
    }

    /* --- تخصيص الجدول (The Table) --- */

    /* 1. الحاوية الخارجية للجدول */
    .fi-ta-ctn {
        background-color: #2B2B2B !important;
        border: 2px solid #444 !important;
        border-radius: 20px !important;
        padding: 20px !important;
        overflow: hidden;
        color: #FFFFFF !important;
    }
    .fi-ta-cell,
    .fi-ta-cell span,
    .fi-ta-cell div,
    .fi-ta-cell p {
        color: #FFFFFF !important;
    }

    /* 2. هيدر الجدول (الصف الأحمر المتصل) */
    .fi-ta-table thead {
        background-color: #B91818 !important;
        border: none;
        color: #FFFFFF !important;
    }

    /* جعل زوايا الهيدر مستديرة */
    .fi-ta-table thead tr th:first-child {
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
    }


    .fi-ta-table thead tr th:last-child {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }
    /* تغيير لون hover للصفوف في الجدول */
    .fi-ta-table tbody tr:hover {
        background-color: #1f1f1f !important;
    }

    /* تغيير لون النص لو حابب */
    .fi-ta-table tbody tr:hover td {
        color: #fff !important;
    }


    /* 3. خلايا الهيدر */
    .fi-ta-header-cell {
        background-color: #B91818 !important; /* مهم جداً لظهور لون الـ thead */
        border: none !important;
        padding: 12px !important;
        color: #FFFFFF !important;
    }

    .fi-ta-header-cell-label,
    .fi-ta-header-cell span {
        color: white !important;
        font-weight: 600 !important;
    }
    .fi-ta-header-ctn {
        background-color: transparent !important;
    }

    /* أيقونات الترتيب داخل الهيدر */
    .fi-ta-header-cell .fi-icon-btn {
        color: white !important;
    }


    /* إزالة الخط الأبيض اللي فوق الهيدر الأحمر */
    .fi-ta-header-toolbar {
        border-bottom: none !important;
    }
    /* badge في الجدول */
    .fi-ta-col .fi-badge {
        background-color: #B91818 !important;
        color: #ffffff !important;
        border-color: #B91818 !important;
    }

    .fi-ta-col .fi-badge span {
        color: #ffffff !important;
    }

    /* --- تنسيق مربع البحث (Search Input) --- */

    /* الخلفية والحدود لمربع البحث */
    .fi-ta-header-toolbar input,
    .fi-ta-header-toolbar .fi-input-wrp {
        background-color: #2B2B2B !important; /* لون داكن قريب من الأسود */
        border: 1px solid #444 !important; /* حدود رمادية غامقة */
        color: #FFFFFF !important; /* لون الكتابة أبيض */
        border-radius: 8px !important;
    }
    /* لون الـ Placeholder (النص المؤقت داخل البحث) */
    .fi-ta-header-toolbar input::placeholder {
        color: #AFAFAF !important;
        opacity: 0.8;
    }

    /* تغيير لون أيقونة البحث (العدسة) */
    .fi-ta-header-toolbar .fi-input-wrp svg {
        color: #AFAFAF !important;
    }

    /* شكل المربع لما تضغطي عليه (Focus) */
    .fi-ta-header-toolbar .fi-input-wrp:focus-within {
        border-color: #B91818 !important; /* يقلب أحمر لما تضغطي عليه */
        box-shadow: 0 0 0 1px #B91818 !important;
    }

    /* أيقونة الفلتر (لو موجودة بجانب البحث) */
    .fi-ta-header-toolbar button.fi-icon-btn {
        background-color: #1a1a1a !important;
        color: #FFFFFF !important;
        border: 1px solid #444 !important;
        border-radius: 8px !important;
    }

    /* --- تنسيق قوائم الاختيار (Select Inputs) والترقيم --- */

    /* تلوين مربع الاختيار (Per page) والقوائم المنسدلة */
    .fi-select-input,
    .fi-ta-header-toolbar select {
        background-color: #1a1a1a !important; /* خلفية دارك */
        color: #FFFFFF !important; /* كلام أبيض */
        border: 1px solid #444 !important; /* حدود متناسقة */
        border-radius: 8px !important;
        cursor: pointer;
    }
    /* تلوين الخيارات داخل القائمة (Options) */
    /* ملحوظة: بعض المتصفحات بتفرض ستايل معين على الـ option */
    .fi-select-input option {
        background-color: #1a1a1a !important;
        color: #FFFFFF !important;
    }


    /* أيقونة السهم داخل الـ Select */
    .fi-select-input-wrp svg {
        color: #FFFFFF !important;
    }
    /* خلفية كارت الفلتر نفسه لما يفتح */
    .fi-dropdown-panel {
        background-color: #2B2B2B !important;
        border: 1px solid #444 !important;
    }

    /* الكلام داخل كارت الفلتر */
    .fi-dropdown-panel label,
    .fi-dropdown-panel span {
        color: #FFFFFF !important;
    }
    select.fi-select-input {
        color: #ffffff !important;
        background-color: #727272 !important;
        -webkit-text-fill-color: #ffffff !important;
    }



/* --- الترقيم (Pagination) النهائي --- */

/* خلفية المودال الأساسية */
.fi-modal-window {
    background-color: #000000 !important;
    border: 1px solid #333 !important;
    border-radius: 12px !important;
}

/* عنوان المودال */
.fi-modal-heading {
    color: white !important;
    font-weight: bold !important;
}
.fi-fo-text-input input {
    background-color: #4e4b4b !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 10px !important;
}

/* لون الـ Placeholder (النص الباهت) */
.fi-fo-text-input input::placeholder {
    color: #afafaf !important;
}

/* الليبل (Category Name) */
.fi-fo-field-wrp-label label {
    color: white !important;
    font-weight: 600 !important;
}
/* زرار الحفظ (الأساسي) */
.fi-modal-actions .fi-btn-color-primary {
    background-color: #B91818 !important; /* الأحمر الخاص بك */
    border-radius: 8px !important;
    color: white !important;
}

/* زرار الإلغاء */
.fi-modal-actions .fi-btn-color-gray {
    background-color: #ffffff !important;
    color: #000000 !important;
    border-radius: 8px !important;
}
.fi-fo-field-wrp-helper-text {
    color: #AFAFAF !important;
    margin-top: 8px !important;
}
/* توحيد لون كل العناوين داخل المودال للأبيض */
.fi-modal label,
.fi-modal .fi-fo-field-wrp-label label {
    color: white !important;
}

/* تنسيق الـ Select عشان يماشي الـ Input الرمادي */
.fi-modal select {
    background-color: #151515 !important; /* نفس درجة الخلفية اللي بتفضلها */
    color: white !important;
    border: 1px solid #444 !important;
}

/* الزرار الأحمر (Save) للتأكيد على درجة اللون #B91818 */
.fi-modal .fi-btn-color-danger {
    background-color: #B91818 !important;
    color: white !important;
}

/* إصلاح لون العناوين (Labels) لتكون بيضاء واضحة */
.fi-modal label span,
.fi-modal .fi-fo-field-wrp-label label {
    color: white !important;
}

/* تنسيق الـ Input الرمادي ليكون مطابق للصورة تماماً */
.fi-modal input, .fi-modal select {
    background-color: #727272 !important;
    color: white !important;
    border: none !important;
    border-radius: 8px !important;
}
.fi-modal .fi-fo-field-wrp-label label span {
    color: #ffffff !important; /* لون أبيض صريح */
    font-weight: 600 !important;
}
.fi-modal .fi-fo-field-wrp-label label span [title*="required"] {
    color: #B91818 !important;
}

/* تلوين النص التوضيحي (Helper Text) باللون الرمادي الفاتح */
.fi-modal .fi-fo-field-wrp-helper-text {
    color: #AFAFAF !important;
}

/* تلوين النص بجانب الـ Toggle (Status) */
.fi-modal .fi-fo-toggle-label {
    color: #ffffff !important;
}


/* --- Searchable Select Dropdown (fi-select) options panel --- */

/* الحاوية الكاملة للـ dropdown */
.fi-modal .choices__list--dropdown,
.fi-modal .choices__list[aria-expanded],
[x-ref="panel"],
.fi-select-option-list-ctn,
.choices__list--dropdown {
    background-color: #2B2B2B !important;
    border: 1px solid #444 !important;
}

/* خلفية قائمة الخيارات في الـ Select القابل للبحث */
.fi-modal [role="listbox"],
.fi-modal [role="option"],
.fi-modal .fi-select-option {
    background-color: #2B2B2B !important;
    color: #ffffff !important;
}

/* hover على الخيارات */
.fi-modal [role="option"]:hover,
.fi-modal .fi-select-option:hover {
    background-color: #B91818 !important;
    color: #ffffff !important;
}

/* إصلاح الـ search input داخل الـ dropdown */
.fi-modal [role="listbox"] input,
.fi-modal .fi-select-option-search-input {
    background-color: #727272 !important;
    color: #ffffff !important;
    border: none !important;
}

/* إخفاء أي خلفية بيضاء في أسفل المودال */
.fi-modal-footer,
.fi-modal-actions {
    background-color: #000000 !important;
    border-top: 1px solid #333 !important;
}


/* الـ Select2 / Choices.js panel لو مستخدمة */
.ts-dropdown,
.ts-dropdown .option {
    background-color: #2B2B2B !important;
    color: #ffffff !important;
}

.ts-dropdown .option:hover,
.ts-dropdown .option.active {
    background-color: #B91818 !important;
}

/* Tom Select specifically (used by Filament) */
.ts-wrapper .ts-dropdown {
    background-color: #2B2B2B !important;
    border: 1px solid #444 !important;
}

.ts-wrapper .ts-dropdown .option {
    color: #ffffff !important;
    background-color: #2B2B2B !important;
}

.ts-wrapper .ts-dropdown .option:hover,
.ts-wrapper .ts-dropdown .active {
    background-color: #B91818 !important;
    color: #ffffff !important;
}

/* إصلاح الـ input الأبيض في أسفل المودال */
.fi-modal .ts-control,
.fi-modal .ts-wrapper .ts-control {
    background-color: #727272 !important;
    color: white !important;
    border: none !important;
}
/* إصلاح لون النص داخل Tom Select input */
.ts-wrapper .ts-control,
.ts-wrapper .ts-control input,
.ts-wrapper .ts-control .item {
    color: #ffffff !important;
    background-color: transparent !important;
}


/* الـ placeholder */
.ts-wrapper .ts-control input::placeholder {
    color: #afafaf !important;
}

/* إصلاح search input داخل الـ dropdown ليكون أغمق */
.ts-dropdown .ts-dropdown-content input,
.ts-dropdown .ts-dropdown-content,
.ts-wrapper .ts-dropdown input {
    background-color: #2B2B2B !important;
    color: #ffffff !important;
    border-bottom: 1px solid #444 !important;
}

.ts-dropdown input::placeholder {
    color: #afafaf !important;
}
/* Search input أبيض جوا الـ dropdown */
.ts-dropdown .search-input,
[role="listbox"] input {
    background-color: #1a1a1a !important;
    color: #ffffff !important;
    border: 1px solid #444 !important;
    border-radius: 6px !important;
}

/* إصلاح الـ File Upload */
.fi-fo-file-upload,
.fi-fo-file-upload .fi-dropzone,
.fi-fo-file-upload .fi-dropzone-form,
.fi-fo-file-upload [x-data],
.fi-fo-file-upload [wire\:id],
.fi-fo-file-upload > div,
.fi-modal .filepond--root,
.fi-modal .filepond--drop-label {
    background-color: #727272 !important;
    color: #ffffff !important;
    border: 1px dashed #444 !important;
    border-radius: 8px !important;
}


.filepond--panel,
.filepond--panel-bottom,
.filepond--panel-top,
.filepond--panel-center {
    background-color: #2a2a2a !important;
}
.fi-fo-file-upload {
    background-color: #2a2a2a !important;
    border-radius: 8px !important;
}

/* Repeater كارد داكن */
.fi-fo-repeater-item {
    background-color: #2a2a2a !important;
    border: 1px solid #3a3a3a !important;
    border-radius: 8px !important;
}

/* زرار الحذف */
.fi-fo-repeater-item-delete-action {
    color: #B91818 !important;
}

/* زرار Add Image */
.fi-fo-repeater-add-action button {
    background-color: #2a2a2a !important;
    color: #ffffff !important;
    border: 1px solid #3a3a3a !important;
    border-radius: 8px !important;
}

.fi-fo-repeater-add-action button:hover {
    background-color: #B91818 !important;
    border-color: #B91818 !important;
}

.fi-modal .filepond--drop-label label {
    color: #ffffff !important;
}

/* زراير المودال */
.fi-modal-actions .fi-btn-color-gray {
    background-color: #ffffff !important;
    color: #000000 !important;
}

/* عنوان الـ FileUpload */
.fi-fo-file-upload .fi-fo-field-wrp-label label,
.fi-fo-file-upload label,
[class*="file-upload"] label {
    color: #ffffff !important;
}

/* كل الـ labels في الـ modal */
.fi-modal *,
.fi-modal label,
.fi-modal span,
.fi-modal p,
.fi-fo-field-wrp-label,
.fi-fo-field-wrp-label *,
[class*="fi-fo"] label,
[class*="fi-fo"] span {
    color: #ffffff !important;
}

    /* الكارد الرئيسي */
    .fi-section {
        background-color: #2a2a2a !important;
        border: 1px solid #3a3a3a !important;
        border-radius: 12px !important;
    }
        /* الـ header بتاع كل section */
    .fi-section-header {
        background-color: #1f1f1f !important;
        border-bottom: 1px solid #3a3a3a !important;
    }
    textarea {
        background-color: #4e4b4b !important;
        border-color: #3a3a3a !important;
        color: #ffffff !important;
        border-radius: 8px !important;
    }


.color-circles-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
    padding: 8px 0;
}

.color-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.2);
    cursor: pointer;
    transition: transform 0.2s;
}

.color-circle:hover {
    transform: scale(1.1);
}

.color-circle-add {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #3a3a3a;
    border: 2px dashed #888;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: white;
    font-size: 20px;
    line-height: 1;
    transition: background 0.2s;
}

.color-circle-add:hover {
    background-color: #B91818;
    border-color: #B91818;
}

/* إخفاء الـ Repeater الأصلي */
.color-picker-repeater {
    display: none !important;
}

/* الـ color picker popup */
.color-popup {
    position: fixed;
    background: #2a2a2a;
    border: 1px solid #444;
    border-radius: 12px;
    padding: 16px;
    z-index: 9999;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
    display: none;
}

.color-popup input[type="color"] {
    width: 200px;
    height: 120px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    display: block;
}

.color-popup-btn {
    margin-top: 8px;
    width: 100%;
    background: #B91818;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px;
    cursor: pointer;
    font-weight: bold;
}

/* Size boxes */
.sizes-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
    padding: 8px 0;
}

.size-box {
    min-width: 42px;
    height: 42px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #3a3a3a;
    border: 1px solid #555;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: white;
    font-size: 13px;
    font-weight: 600;
    position: relative;
    transition: background 0.2s;
    user-select: none;
}

.size-box.selected {
    background-color: #3a3a3a;
    border-color: #555;
}

.size-box .delete-size {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 16px;
    height: 16px;
    background: #111;
    color: white;
    border-radius: 50%;
    font-size: 10px;
    line-height: 16px;
    text-align: center;
    display: none;
    cursor: pointer;
    z-index: 10;
}

.size-box:hover .delete-size {
    display: block;
}

.size-box-add {
    min-width: 42px;
    height: 42px;
    padding: 0 10px;
    border-radius: 8px;
    background-color: #3a3a3a;
    border: 2px dashed #888;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: white;
    font-size: 20px;
    transition: background 0.2s;
}

.size-box-add:hover {
    background-color: #B91818;
    border-color: #B91818;
}

/* popup */
.size-popup {
    position: fixed;
    background: #2a2a2a;
    border: 1px solid #444;
    border-radius: 12px;
    padding: 16px;
    z-index: 9999;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
    display: none;
    min-width: 200px;
}

.size-popup input[type="text"] {
    width: 100%;
    background: #1a1a1a;
    border: 1px solid #444;
    border-radius: 8px;
    color: white;
    padding: 8px;
    font-size: 14px;
    box-sizing: border-box;
}

.size-popup-btn {
    margin-top: 8px;
    width: 100%;
    background: #B91818;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px;
    cursor: pointer;
    font-weight: bold;
}
/* إخفاء الـ size repeater */
.size-picker-repeater {
    display: none !important;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // =================== STATE ===================
        const defaultColors = ['#cc0000', '#151515', '#1a56db', '#34A853', '#FFFFFF', '#832D2D', '#E44646'];
        const defaultSizes  = ['XS', 'S', 'M', 'L', 'XL', 'XXL', '14', '16'];

        let selectedColors = [...defaultColors];
        let selectedSizes  = [...defaultSizes];

        // =================== REPEATER HELPERS ===================
        function getRepeaterAddBtn(repeaterClass) {
            const repeater = document.querySelector(repeaterClass);
            if (!repeater) return null;
            // Filament add button
            return repeater.querySelector('button[wire\\:click*="addItem"]')
                || repeater.querySelector('button[x-on\\:click*="addItem"]')
                || repeater.querySelector('[wire\\:click*="addItem"]');
        }

        function addColorToRepeater(color, callback) {
            const addBtn = getRepeaterAddBtn('.color-picker-repeater');
            if (!addBtn) return;

            addBtn.click();

            // انتظر Livewire يضيف الـ item ويعمل re-render
            setTimeout(() => {
                const repeater = document.querySelector('.color-picker-repeater');
                if (!repeater) return;

                const inputs = repeater.querySelectorAll('input.color-value-input');
                const lastInput = inputs[inputs.length - 1];

                if (lastInput) {
                    // استخدم nativeInputValueSetter عشان Alpine يمسك القيمة
                    const nativeInputValueSetter = Object.getOwnPropertyDescriptor(
                        window.HTMLInputElement.prototype, 'value'
                    ).set;
                    nativeInputValueSetter.call(lastInput, color);
                    lastInput.dispatchEvent(new Event('input', { bubbles: true }));
                    lastInput.dispatchEvent(new Event('change', { bubbles: true }));
                }

                if (callback) callback();
            }, 600);
        }

        function addSizeToRepeater(size, callback) {
            const addBtn = getRepeaterAddBtn('.size-picker-repeater');
            if (!addBtn) return;

            addBtn.click();

            setTimeout(() => {
                const repeater = document.querySelector('.size-picker-repeater');
                if (!repeater) return;

                const inputs = repeater.querySelectorAll('input.size-value-input');
                const lastInput = inputs[inputs.length - 1];

                if (lastInput) {
                    const nativeInputValueSetter = Object.getOwnPropertyDescriptor(
                        window.HTMLInputElement.prototype, 'value'
                    ).set;
                    nativeInputValueSetter.call(lastInput, size);
                    lastInput.dispatchEvent(new Event('input', { bubbles: true }));
                    lastInput.dispatchEvent(new Event('change', { bubbles: true }));
                }

                if (callback) callback();
            }, 600);
        }

        // أضف الألوان الافتراضية واحد واحد بـ queue
        function populateDefaults() {
            let colorQueue = [...defaultColors];
            let sizeQueue  = [...defaultSizes];

            function nextColor() {
                if (colorQueue.length === 0) return;
                const color = colorQueue.shift();
                addColorToRepeater(color, nextColor);
            }

            function nextSize() {
                if (sizeQueue.length === 0) return;
                const size = sizeQueue.shift();
                addSizeToRepeater(size, nextSize);
            }

            nextColor();
            nextSize();
        }

        // =================== COLOR PICKER UI ===================
        function initColorPicker() {
            const repeater = document.querySelector('.color-picker-repeater');
            if (!repeater || document.querySelector('.color-circles-wrapper')) return;

            const wrapper = document.createElement('div');
            wrapper.className = 'color-circles-wrapper';

            const popup = document.createElement('div');
            popup.className = 'color-popup';
            popup.innerHTML = `
                <input type="color" id="colorPickerInput" value="#ff0000">
                <button class="color-popup-btn">Add Color</button>
            `;
            document.body.appendChild(popup);

            defaultColors.forEach(color => addCircle(color, wrapper));

            const addBtn = document.createElement('div');
            addBtn.className = 'color-circle-add';
            addBtn.innerHTML = '+';
            addBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const rect = addBtn.getBoundingClientRect();
                popup.style.display = 'block';
                popup.style.top  = (rect.bottom + 8) + 'px';
                popup.style.left = rect.left + 'px';
            });

            wrapper.appendChild(addBtn);
            repeater.parentNode.insertBefore(wrapper, repeater);

            popup.querySelector('.color-popup-btn').addEventListener('click', function () {
                const color = popup.querySelector('#colorPickerInput').value;
                if (!selectedColors.includes(color)) {
                    selectedColors.push(color);
                    addCircle(color, wrapper, addBtn);
                    addColorToRepeater(color);
                }
                popup.style.display = 'none';
            });

            document.addEventListener('click', () => popup.style.display = 'none');
            popup.addEventListener('click', e => e.stopPropagation());
        }

        function addCircle(color, wrapper, before = null) {
            const circle = document.createElement('div');
            circle.className = 'color-circle';
            circle.style.backgroundColor = color;
            circle.title = color;
            circle.style.position = 'relative';

            const deleteBtn = document.createElement('span');
            deleteBtn.innerHTML = '×';
            deleteBtn.style.cssText = `
                position: absolute; top: -4px; right: -4px;
                width: 16px; height: 16px; background: #B91818;
                color: white; border-radius: 50%; font-size: 11px;
                line-height: 16px; text-align: center;
                display: none; cursor: pointer; z-index: 10;
            `;

            deleteBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                // احذف من الـ Repeater
                const repeater = document.querySelector('.color-picker-repeater');
                if (repeater) {
                    const inputs = repeater.querySelectorAll('input.color-value-input');
                    inputs.forEach(input => {
                        if (input.value === color) {
                            const item = input.closest('[wire\\:key]')
                                || input.closest('.fi-fo-repeater-item');
                            if (item) {
                                const delBtn = item.querySelector('button[wire\\:click*="deleteItem"]')
                                    || item.querySelector('button[x-on\\:click*="deleteItem"]');
                                if (delBtn) delBtn.click();
                            }
                        }
                    });
                }
                selectedColors = selectedColors.filter(c => c !== color);
                circle.remove();
            });

            circle.appendChild(deleteBtn);
            circle.addEventListener('mouseenter', () => deleteBtn.style.display = 'block');
            circle.addEventListener('mouseleave', () => deleteBtn.style.display = 'none');

            if (before) wrapper.insertBefore(circle, before);
            else wrapper.appendChild(circle);
        }

        // =================== SIZE PICKER UI ===================
        function initSizePicker() {
            const repeater = document.querySelector('.size-picker-repeater');
            if (!repeater || document.querySelector('.sizes-wrapper')) return;

            const wrapper = document.createElement('div');
            wrapper.className = 'sizes-wrapper';

            const popup = document.createElement('div');
            popup.className = 'size-popup';
            popup.innerHTML = `
                <input type="text" id="sizeInput" placeholder="e.g. 42, 3XL ...">
                <button class="size-popup-btn">Add Size</button>
            `;
            document.body.appendChild(popup);

            defaultSizes.forEach(size => addSizeBox(size, wrapper));

            const addBtn = document.createElement('div');
            addBtn.className = 'size-box-add';
            addBtn.innerHTML = '+';
            addBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const rect = addBtn.getBoundingClientRect();
                popup.style.display = 'block';
                popup.style.top  = (rect.bottom + 8) + 'px';
                popup.style.left = rect.left + 'px';
                setTimeout(() => popup.querySelector('#sizeInput').focus(), 100);
            });

            wrapper.appendChild(addBtn);
            repeater.parentNode.insertBefore(wrapper, repeater);

            popup.querySelector('.size-popup-btn').addEventListener('click', function () {
                const val = popup.querySelector('#sizeInput').value.trim().toUpperCase();
                if (val && !selectedSizes.includes(val)) {
                    selectedSizes.push(val);
                    addSizeBox(val, wrapper, addBtn);
                    addSizeToRepeater(val);
                    popup.querySelector('#sizeInput').value = '';
                    popup.style.display = 'none';
                }
            });

            popup.querySelector('#sizeInput').addEventListener('keydown', function (e) {
                if (e.key === 'Enter') popup.querySelector('.size-popup-btn').click();
            });

            document.addEventListener('click', () => popup.style.display = 'none');
            popup.addEventListener('click', e => e.stopPropagation());
        }

        function addSizeBox(size, wrapper, before = null) {
            const box = document.createElement('div');
            box.className = 'size-box selected';
            box.dataset.size = size;
            box.innerHTML = `${size}<span class="delete-size">×</span>`;

            box.querySelector('.delete-size').addEventListener('click', function (e) {
                e.stopPropagation();
                const repeater = document.querySelector('.size-picker-repeater');
                if (repeater) {
                    const inputs = repeater.querySelectorAll('input.size-value-input');
                    inputs.forEach(input => {
                        if (input.value === size) {
                            const item = input.closest('[wire\\:key]')
                                || input.closest('.fi-fo-repeater-item');
                            if (item) {
                                const delBtn = item.querySelector('button[wire\\:click*="deleteItem"]')
                                    || item.querySelector('button[x-on\\:click*="deleteItem"]');
                                if (delBtn) delBtn.click();
                            }
                        }
                    });
                }
                selectedSizes = selectedSizes.filter(s => s !== size);
                box.remove();
            });

            if (before) wrapper.insertBefore(box, before);
            else wrapper.appendChild(box);
        }

        // =================== INIT ===================
        let initTimeout = null;
        let initialized = false;

        function initAll() {
            const oldColors = document.querySelector('.color-circles-wrapper');
            if (oldColors) oldColors.remove();

            const oldSizes = document.querySelector('.sizes-wrapper');
            if (oldSizes) oldSizes.remove();

            selectedColors = [...defaultColors];
            selectedSizes  = [...defaultSizes];

            initColorPicker();
            initSizePicker();

            // اضيف الافتراضيات مرة واحدة بس
            if (!initialized) {
                initialized = true;
                setTimeout(populateDefaults, 500);
            }
        }

        function safeInit() {
            if (initTimeout) clearTimeout(initTimeout);
            initTimeout = setTimeout(initAll, 400);
        }

        setTimeout(initAll, 1200);

        document.addEventListener('livewire:update',  safeInit);
        document.addEventListener('livewire:updated', safeInit);
        document.addEventListener('livewire:morph',   safeInit);
        document.addEventListener('livewire:morphed', safeInit);

        let observing = true;
        const observer = new MutationObserver(() => {
            if (!observing) return;
            if (!document.querySelector('.color-circles-wrapper') || !document.querySelector('.sizes-wrapper')) {
                observing = false;
                safeInit();
                setTimeout(() => observing = true, 1000);
            }
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });
</script>

HTML
        );
    }
}
