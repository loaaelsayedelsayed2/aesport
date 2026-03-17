<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        "code",
        "discount_amount",
        "discount_type",
        "expiry_date",
        "is_active",
        "usage_limit",
        "type",
        'start_date'
    ];
}
