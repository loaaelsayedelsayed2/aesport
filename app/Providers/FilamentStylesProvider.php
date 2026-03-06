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
        border-top: none !important;
        border-bottom: none !important;
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

    /* أيقونات الترتيب داخل الهيدر */
    .fi-ta-header-cell .fi-icon-btn {
        color: white !important;
    }

    /* 4. محتوى الجدول (الصفوف) */
    .fi-ta-cell {
        color: #FFFFFF !important;
        border-bottom: 1px solid #333 !important;
    }

    /* إزالة الخط الأبيض اللي فوق الهيدر الأحمر */
    .fi-ta-header-toolbar {
        border-bottom: none !important;
    }


        /* --- الترقيم (Pagination) --- */
    .fi-ta-pagination {
        background-color: transparent !important;
        border-top: none !important;
        margin-top: 15px;
    }

    .fi-ta-pagination button,
    .fi-ta-pagination select {
        background-color: #151515 !important;
        color: white !important;
        border: 1px solid #444 !important;
    }

    .fi-ta-pagination button.fi-active {
        background-color: #B91818 !important;
        border-color: #B91818 !important;
    }

    /* نصوص الترقيم */
    .fi-ta-pagination-record-count-label,
    .fi-ta-pagination-overview {
        color: white !important;
    }

</style>
HTML
        );
    }
}
