<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingsRepository
{
    public function list()
    {
        return Setting::all();
    }

    public function getDataHome()
    {
        return Setting::where('key', 'like', 'home_%')->get();
    }
    public function getDataHomeSec2()
    {
        return Setting::where('key', 'home_sec2_title')->first();
    }

    public function getInfo()
    {
        return Setting::where('key','site_name')
        ->orWhere('key','site_logo')
        ->orWhere('key','like','contact_%')
        ->get();
    }
    public function getBanners()
    {
        return Setting::where('key','like','%_page_image_%')
        ->get();
    }
}
