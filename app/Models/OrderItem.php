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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(ProductVariant::class, 'size_variant_id');
    }
    public function color()
    {
        return $this->belongsTo(ProductVariant::class, 'color_variant_id');
    }
}
