<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Sport;
use App\Models\Type;

class SportsRepository
{
    public function list(){
        return Sport::where('is_active',1)->get();
    }

}
