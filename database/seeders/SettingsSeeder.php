<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            //  General
            ['key' => 'site_name', 'value' => 'AESport'],
            ['key' => 'site_logo', 'value' => 'logo.png'],

            //  Notifications
            ['key' => 'notification_order_updates', 'value' => '1'],
            ['key' => 'notification_low_stock_alerts', 'value' => '1'],
            ['key' => 'notification_order_create', 'value' => '1'],
            ['key' => 'notification_customer_reviews', 'value' => '1'],
            ['key' => 'notification_system_updates', 'value' => '1'],

            //  Home Hero Section
            ['key' => 'home_hero_image', 'value' => 'defult.jpg'],
            ['key' => 'home_hero_title', 'value' => 'Welcome to AESport'],
            ['key' => 'home_hero_desc', 'value' => 'Best sports gear online'],

            //  Home Notes
            ['key' => 'home_note_1', 'value' => 'Free delivery over 250 AED'],
            ['key' => 'home_note_2', 'value' => 'Shop now & pay later'],

            // Filter Page Images
            ['key' => 'filter_page_image_1', 'value' => 'defult.jpg'],
            ['key' => 'filter_page_image_2', 'value' => 'defult.jpg'],
            ['key' => 'filter_page_image_3', 'value' => 'defult.jpg'],
            ['key' => 'filter_page_image_4', 'value' => 'defult.jpg'],

            //  Wishlist Page
            ['key' => 'wishlist_page_image', 'value' => 'defult.jpg'],

            //  Cart Page
            ['key' => 'cart_page_image', 'value' => 'defult.jpg'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
