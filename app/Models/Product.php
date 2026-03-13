<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "model_number",
        "description",
        "main_image",
        "price_before_discount",
        "discount_price",
        "discount_type",
        "price",
        "quantity",
        "in_stock",
        "is_active",
        "additional_info",
    ];

    protected $casts = [
        'additional_info' => 'array',
    ];

    public function brand()
    {
        return $this->belongsToMany(Brand::class, 'product_brands');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function type()
    {
        return $this->belongsToMany(Type::class, 'product_types');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'product_sports');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function colorVariants()
    {
        return $this->hasMany(ProductVariant::class)->where('key', 'color');
    }

    public function sizeVariants()
    {
        return $this->hasMany(ProductVariant::class)->where('key', 'size');
    }

    public function favs()
    {
        return $this->hasMany(ProductFav::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->model_number = 'PRD-' . strtoupper(uniqid());
        });
        static::saving(function ($product) {
            if ($product->price && $product->discount_price) {
                $product->price_before_discount = $product->price + $product->discount_price;
            } else {
                $product->price_before_discount = $product->price; // ✅ لو مفيش discount
            }
        });
    }
}
