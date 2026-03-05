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
            fn () => <<<'HTML'
<style>

/* --- تعديلات القائمة الجانبية (Sidebar) --- */

.fi-sidebar {
    background-color: #151515;
    border: 2px solid #C9C9C9;
    color: #AFAFAF;
}

.fi-sidebar-item-label {
    color: #AFAFAF !important;
}

/* الأيقونات غير النشطة */
.fi-sidebar-item-icon {
    color: #AFAFAF !important;
}

.fi-sidebar-item.fi-active .fi-sidebar-item-icon,
.fi-sidebar-item.fi-sidebar-item-active .fi-sidebar-item-icon,
.fi-sidebar-item.fi-active .fi-sidebar-item-label,
.fi-sidebar-item.fi-sidebar-item-active .fi-sidebar-item-label,
.fi-sidebar-item:hover .fi-sidebar-item-icon,
.fi-sidebar-item:hover .fi-sidebar-item-label {
    color: #B91818 !important;
    box-shadow: none !important;
}

/* الهيدر */
.fi-header,
.fi-topbar {
    background-color: #151515 !important;
    color: #B91818 !important;
}

/* خلفية الصفحة */
.fi-main,
.fi-app-layout,
body.fi-body {
    background-color: #242323 !important;
    color: #FFFFFF !important;
}

/* محتوى الصفحة */
.fi-main-ctn {
    background-color: #242323 !important;
}

/* إزالة الظلال */
.fi-topbar,
.fi-sidebar {
    box-shadow: none !important;
    border-color: #1a1a1a !important;
}

/* عناوين الصفحات */
.fi-header {
    background-color: #242323 !important;
}

.fi-wi-stats-overview-stat-description,
.fi-section-header-description,
.fi-header-subheading,
.fi-ta-empty-state-description {
    color: #ffffff !important;
    opacity: 0.9;
}

/* كروت الإحصائيات */
.fi-wi-stats-overview-stat {
    background-color: #2B2B2B !important;
    border: 2px solid #626262 !important;
}

.fi-wi-stats-overview-stat-value,
.fi-wi-stats-overview-stat div span,
.fi-wi-stats-overview-stat .text-3xl {
    color: #FFFFFF !important;
}

/* عنوان الصفحة */
.filament-header-heading,
h1.filament-header-heading,
.fi-header-heading,
h1.fi-header-heading {
    color: #920404 !important;
    border-radius: 12px !important;
    display: inline-block !important;
}

/* رؤوس الجداول */

table thead th,
.filament-tables-table thead th {
    background-color: #B91818 !important;
    color: #ffffff !important;
}

.filament-tables-header-cell:hover,
.fi-ta-header-cell:hover,
.filament-tables-header-cell button:hover,
.fi-ta-header-cell button:hover {
    background-color: #B91818 !important;
    border: none !important;
}

/* عنوان الجدول */

.filament-tables-header,
.fi-ta-header {
    background-color: #B91818 !important;
    color: #ffffff !important;
    padding: 0.75rem !important;
    border-radius: 12px !important;
}

.fi-ta-header-ctn {
    border-bottom: none !important;
}

/* الجدول */

.fi-ta-table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

.fi-ta-header-cell {
    background-color: #B91818 !important;
}

.fi-ta-header-cell-label {
    color: white !important;
    font-weight: 500 !important;
    text-transform: none !important;
    font-size: 0.9rem !important;
}

/* Container */

.fi-ta-ctn {
    border-radius: 12px !important;
    overflow: hidden !important;
    border: 1px solid #eee !important;
    background-color: #2B2B2B !important;
    color: #ffffff !important;
}

/* أيقونات الترتيب */

.fi-ta-header-cell .fi-icon-btn {
    color: #ffffff !important;
}

.fi-ta-cell,
.fi-ta-cell *,
.fi-ta-empty-state-heading,
.fi-ta-empty-state-description,
.fi-ta-header-cell-label {
    color: #FFFFFF !important;
    border-bottom: 1px solid #333 !important;
    border-right: none !important;
}

/* Pagination */

.fi-ta-pagination {
    background-color: #2B2B2B !important;
    border-top: 1px solid #444 !important;
}

.fi-ta-pagination div,
.fi-ta-pagination p,
.fi-ta-pagination span {
    color: #FFFFFF !important;
    font-weight: 300 !important;
}

.fi-ta-pagination button,
.fi-ta-pagination nav,
.fi-ta-pagination select {
    background-color: #000000 !important;
    color: #FFFFFF !important;
    border: 1px solid #444444 !important;
}

.fi-ta-pagination svg {
    color: #FFFFFF !important;
}

.fi-ta-pagination button.fi-active,
.fi-ta-pagination button[aria-current="page"] {
    background-color: #B91818 !important;
    border-color: #B91818 !important;
    color: #FFFFFF !important;
}

.fi-ta-pagination select {
    background-color: #000000 !important;
    color: #FFFFFF !important;
    border-radius: 5px !important;
}

/* Search input */

.fi-ta-header-toolbar input {
    background-color: #1a1a1a !important;
    border: 1px solid #444 !important;
    border-radius: 50px !important;
    color: white !important;
}

</style>
HTML
        );
    }
}
