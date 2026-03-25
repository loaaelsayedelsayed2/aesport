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
/* badge في الجدول - بس مش الـ status */
    /* .fi-ta-col .fi-badge:not([class*="fi-color-success"]):not([class*="fi-color-danger"]:not([class*="fi-color-wa"]) {
        background-color: #B91818 !important;
        color: #ffffff !important;
        border-color: #B91818 !important;
    } */

    /* success-*/
    .fi-badge.fi-color-success {
        background-color: #16a34a !important;
        color: #ffffff !important;
        border-color: #16a34a !important;
    }
    .fi-badge.fi-color-warning {
        background-color: #f09b1d !important;
        color: #ffffff !important;
        border-color: #f09b1d !important;
    }
    .fi-badge.fi-color-info {
        background-color: #2185ffcb !important;
        color: #ffffff !important;
        border-color: #2185ffcb !important;
    }
    .fi-badge.fi-color-gray {
        background-color: #7c7f81cb !important;
        color: #ffffff !important;
        border-color: #7c7f81cb !important;
    }

    /* danger  */
    .fi-badge.fi-color-danger {
        background-color: #dc2626 !important;
        color: #ffffff !important;
        border-color: #dc2626 !important;
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
.fi-modal .fi-select-option:hover,
.fi-select-option:hover,
.fi-select-option:focus,
.fi-select-option[aria-selected="true"] {
    background-color: #B91818 !important;
    color: #ffffff !important;
}

[role="option"]:hover,
[role="option"]:focus,
[role="option"][aria-selected="true"] {
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
.ts-dropdown .option,
.ts-dropdown [data-selectable]{
    background-color: #2B2B2B !important;
    color: #ffffff !important;
}

.ts-dropdown .option:hover,
.ts-dropdown .option.active,
.ts-wrapper .ts-dropdown .option:hover,
.ts-dropdown [data-selectable].active,
.ts-dropdown [data-selectable]:hover
.ts-wrapper .ts-dropdown .active {
    background-color: #B91818 !important;
    color: #ffffff !important;
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

.ts-dropdown .option[data-selectable]:hover,
.ts-dropdown .option[data-selectable].active {
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
.ts-wrapper .ts-control .item {
    color: #ffffff !important;
    background-color: #3a3a3a !important;
}
.ts-wrapper.has-items .ts-control {
    background-color: #4e4b4b !important;
}
.ts-wrapper .ts-control .item .ts-remove {
    color: #ffffff !important;
}
/* الـ placeholder */
.ts-wrapper .ts-control input {
    background-color: transparent !important;
    color: #ffffff !important;
}
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
.fi-select-input-wrp .ts-control .item,
.ts-control .item {
    background-color: #3a3a3a !important;
    color: #ffffff !important;
    border: 1px solid #555 !important;
    border-radius: 4px !important;
}

.ts-control .item a,
.ts-control .item .remove,
.ts-control .item span {
    color: #ffffff !important;
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
.choices__item--selectable {
    color: #f3f4f6 !important;
}

.choices__list--dropdown .choices__item--selectable.is-highlighted {
    background-color: #374151 !important;
    color: #f3f4f6 !important;
}
/* Section heading/title */
.fi-section-header-heading {
    color: #ffffff !important;
}

/* Placeholder label */
.fi-fo-placeholder .fi-fo-field-wrp-label label,
.fi-fo-placeholder label {
    color: #ffffff !important;
}

/* Placeholder content */
.fi-fo-placeholder .fi-fo-field-wrp-hint,
.fi-fo-placeholder > div {
    color: #ffffff !important;
}
/* Placeholder content text */
.fi-fo-placeholder-content,
.fi-fo-placeholder-content *,
.fi-fo-placeholder p,
.fi-fo-placeholder span,
.fi-fo-placeholder div {
    color: #ffffff !important;
}
</style>



HTML
        );
    }
}
