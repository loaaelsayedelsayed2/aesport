<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Type;

class CartRepository
{
    public function showCart(){
        return Cart::where('user_id',auth('api')->user()->id)->first();
    }
    public function create($data){
        return Cart::firstOrCreate([
            "user_id" => auth('api')->user()->id,
        ],$data);
    }

}
