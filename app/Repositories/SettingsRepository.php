<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingsRepository
{
    public function list(){
        return Setting::all();
    }

    public function getDataHome(){
        return Setting::where('key','like','home_%')->get();
    }
    public function getDataHomeSec2(){
        return Setting::where('key','home_sec2_title')->first();
    }

}
