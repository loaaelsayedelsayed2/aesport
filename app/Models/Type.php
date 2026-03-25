<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        "name",
        "is_active",
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_types', 'type_id', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_types', 'type_id', 'category_id');
    }
}
