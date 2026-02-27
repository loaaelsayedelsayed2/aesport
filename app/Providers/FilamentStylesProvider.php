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
                /* ===== عناوين الصفحات (Page Titles) ===== */
                .filament-header-heading,
                h1.filament-header-heading,
                .fi-header-heading,
                h1.fi-header-heading {
                    color: #B91818 !important;              /* أبيض */
                    padding: 0.75rem 1.5rem !important;     /* padding حلو */
                    border-radius: 0.5rem !important;       /* زوايا دائرية */
                    display: inline-block !important;       /* لتحديد مساحة الخلفية */
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
                    background-color: #B91818 !important;  /* أحمر غامق عند المرور */
                }

                /* عناوين الجداول (إذا موجودة فوق الجدول) */
                .filament-tables-header,
                .fi-ta-header {
                    background-color: #B91818 !important;
                    color: #ffffff !important;
                    padding: 0.75rem !important;
                    border-radius: 10px 10px 0 0 !important;
                }

                .fi-ta-header-ctn {
                    border-bottom: none !important;
                }

                .fi-ta-header-cell {
                    background-color: #B91818 !important;
                }

                .fi-ta-header-cell-label {
                    color: white !important;
                    font-weight: bold !important;
                    text-transform: uppercase;
                    font-size: 0.8rem;
                }


            /* جعل الزوايا العلوية للجدول دائرية لتناسب اللون الأحمر */
                .fi-ta-ctn {
                    border-radius: 12px !important;
                    overflow: hidden !important;
                    border: 1px solid #eee !important;
                }

                /* تغيير لون أيقونات الترتيب للأبيض */
                .fi-ta-header-cell .fi-icon-btn {
                    color: white !important;
                }
                .fi-sidebar {
                    background-color: #FFFFFF;
                    border: 1px solid #C9C9C9;
                }

            </style>
            HTML;
        });
    }
}
