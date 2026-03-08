<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandsRepository
{
    public function list(){
        return Brand::where('is_active',1)->get();
    }

}
