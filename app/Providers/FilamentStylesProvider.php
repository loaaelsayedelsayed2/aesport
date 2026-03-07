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
    background-color: #727272 !important; /* اللون الرمادي اللي في الصورة */
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




</style>
HTML
        );
    }
}
