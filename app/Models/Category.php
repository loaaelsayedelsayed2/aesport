<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
        "parent_id",
        "is_active"
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'category_types', 'category_id', 'type_id');
    }

        public function products()
    {
        return $this->belongsToMany(Product::class, 'product_types', 'type_id', 'product_id');
    }
}
