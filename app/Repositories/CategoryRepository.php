<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Type;

class CategoryRepository
{
    public function list(){
        return Category::where('is_active',1)->get();
    }

}
