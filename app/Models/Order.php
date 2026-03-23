<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "user_id",
        "cart_id",
        "order_number",
        "status",
        "item_count",
        "delivery_fee",
        "coupon_discount",
        "total_amount",
        "first_name",
        "last_name",
        "email",
        "country",
        "address",
        "phone",
        'is_payment'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
