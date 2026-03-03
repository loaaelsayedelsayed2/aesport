<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentStylesProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            echo <<<'HTML'
            <style>
                /* --- تعديلات القائمة الجانبية (Sidebar) --- */

                .fi-sidebar {
                    background-color: #151515;
                    border: 2px solid #C9C9C9;
                    color: #AFAFAF
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
                .fi-sidebar-item:hover .fi-sidebar-item-label  {
                    color: #B91818 !important;
                    box-shadow: none !important;
                }
                /* 1. تلوين الهيدر (الجزء العلوي) */
                .fi-header,
                .fi-topbar {
                    background-color: #151515 !important;
                    color: #B91818 !important;

                }

                /* 2. تلوين جسم الصفحة بالكامل (الخلفية) */
                .fi-main,
                .fi-app-layout,
                body.fi-body {
                    background-color: #242323 !important;
                    color : #FFFFFF !important;
                }

                /* 3. تلوين القسم الذي يحتوي على المحتوى الفعلي */
                .fi-main-ctn {
                    background-color: #242323 !important;
                }

                /* 4. إزالة أي ظلال أو حدود بيضاء قد تظهر بين الأقسام */
                .fi-topbar, .fi-sidebar {
                    box-shadow: none !important;
                    border-color: #1a1a1a !important;
                }
                /* ===== عناوين الصفحات (Page Titles) ===== */
                .fi-header {
                    background-color: #242323 !important;
                }
                /* تلوين النص الفرعي (Subheading) في الويدجت والصفحات */
                .fi-wi-stats-overview-stat-description,
                .fi-section-header-description,
                .fi-header-subheading,
                .fi-ta-empty-state-description{
                    color: #ffffff !important;
                    opacity: 0.9; /* اختيارياً: لجعل النص أخف قليلاً من العنوان الرئيسي */
                }
                .fi-wi-stats-overview-stat {
                    background-color: #2B2B2B !important;
                    border: 2px solid #626262 !important;
                }
                .fi-wi-stats-overview-stat-value,
                .fi-wi-stats-overview-stat div span,
                .fi-wi-stats-overview-stat .text-3xl {
                    color: #FFFFFF !important;
                }
                .filament-header-heading,
                h1.filament-header-heading,
                .fi-header-heading,
                h1.fi-header-heading {
                    color: #920404 !important;              /* أبيض */
                    border-radius: 12px !important;
                    display: inline-block !important;
                }
                /* كل خلايا thead */

                table thead th,
                .filament-tables-table thead th {
                    background-color: #B91818 !important;
                    color: #ffffff !important;
                }

                /* hover effect للرؤوس */
                .filament-tables-header-cell:hover,
                .fi-ta-header-cell:hover,
                .filament-tables-header-cell button:hover,
                .fi-ta-header-cell button:hover {
                    background-color: #B91818 !important;
                    border: none !important;
                }

                /* عناوين الجداول (إذا موجودة فوق الجدول) */
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
                    text-transform: none !important; /* إلغاء الـ uppercase */
                    font-size: 0.9rem !important;
                }


            /* جعل الزوايا العلوية للجدول دائرية لتناسب اللون الأحمر */
                .fi-ta-ctn {
                    border-radius: 12px !important;
                    overflow: hidden !important;
                    border: 1px solid #eee !important;
                    background-color: #2B2B2B !important;
                    color: #ffffff !important;

                }

                /* تغيير لون أيقونات الترتيب للأبيض */
                .fi-ta-header-cell .fi-icon-btn {
                    color: #ffffff !important;
                }
                .fi-ta-cell,
                .fi-ta-cell *,
                .fi-ta-empty-state-heading,
                .fi-ta-empty-state-description,
                .fi-ta-header-cell-label {
                    color: #FFFFFF !important;
                    border-bottom: 1px solid #333 !important; /* خط أفقي نحيف جداً */
                    border-right: none !important;
                }


                /* --- تعديل شريط الترقيم (Pagination) --- */

                /* 1. تلوين حاوية الترقيم بالكامل بالأسود */
                .fi-ta-pagination {
                    background-color: #2B2B2B !important;
                    border-top: 1px solid #444 !important;
                }

                /* 2. تلوين نص "Showing 1 to 2 of 2 results" بالأبيض */
                .fi-ta-pagination div,
                .fi-ta-pagination p,
                .fi-ta-pagination span {
                    color: #FFFFFF !important;
                    font-weight: 300 !important; /* خط أخف كما طلبتِ */
                }

                /* 3. تلوين صندوق رقم الصفحة وأزرار التنقل (Previous / Next) */
                .fi-ta-pagination button,
                .fi-ta-pagination nav,
                .fi-ta-pagination select {
                    background-color: #000000 !important;
                    color: #FFFFFF !important;
                    border: 1px solid #444444 !important;
                }

                /* 4. تلوين السهم الصغير داخل الأزرار */
                .fi-ta-pagination svg {
                    color: #FFFFFF !important;
                }

                /* 5. تلوين الزر النشط (رقم الصفحة الحالية) باللون الأحمر */
                .fi-ta-pagination button.fi-active,
                .fi-ta-pagination button[aria-current="page"] {
                    background-color: #B91818 !important;
                    border-color: #B91818 !important;
                    color: #FFFFFF !important;
                }

                /* 6. تعديل شكل الـ Select (عدد النتائج لكل صفحة) */
                .fi-ta-pagination select {
                    background-color: #000000 !important;
                    color: #FFFFFF !important;
                    border-radius: 5px !important;
                }

                .fi-ta-header-toolbar input {
                    background-color: #1a1a1a !important; /* لون داكن */
                    border: 1px solid #444 !important;
                    border-radius: 50px !important; /* لجعل الحواف دائرية تماماً كالتصميم */
                    color: white !important;
                }




            </style>
            HTML;
        });
    }
}
