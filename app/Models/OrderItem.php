<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
       "order_id",
        "product_id",
        "quantity",
        "price",
        "size_variant_id",
        "color_variant_id",
        "total_price",
    ];
}
