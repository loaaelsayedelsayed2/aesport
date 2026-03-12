<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryType extends Model
{
    protected $fillable = [
        "product_id",
        "category_id",
        "type_id",
    ];
}
