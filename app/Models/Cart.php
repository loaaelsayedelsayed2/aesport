<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "user_id",
        "coupon_id",
        "cart_number",
        "sub_total",
        "quantity",
        "delivery_fee",
        "coupon_discount",
        "final_total",
        'deleted_at'
    ];

    public function items(){
        return $this->hasMany(CartItem::class);
    }
}
