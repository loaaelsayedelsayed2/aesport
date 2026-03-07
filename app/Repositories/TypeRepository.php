<?php

namespace App\Repositories;

use App\Models\Type;

class TypeRepository
{
    public function list(){
        return Type::where('is_active',1)->get();
    }

}
