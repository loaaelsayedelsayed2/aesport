<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        "user_id",
        "coupon_id",
        "cart_number",
        "sub_total",
        "quantity",
        "delivery_fee",
        "coupon_discount",
        "final_total"
    ];

    public function items(){
        return $this->hasMany(CartItem::class);
    }
}
