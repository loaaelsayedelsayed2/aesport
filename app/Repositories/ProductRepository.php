<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductFav;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository
{
    public function list()
    {
        $userId = auth('api')->user()->id;
        return QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('brand', 'brand.id'),
                AllowedFilter::exact('category', 'category.id'),
                AllowedFilter::exact('type', 'type.id'),
                AllowedFilter::exact('sport', 'sports.id'),
            ])
            ->withCount([
                'favs as fav' => fn($q) => $q->where('user_id', $userId)
            ])
            ->with(['brand', 'category', 'type', 'sports', 'variants', 'images', 'reviews.user', 'reviews.images'])
            ->get();
    }
    public function details($id)
    {
        return Product::where('id', $id)->with(['brand', 'category', 'type', 'sports', 'variants'])->first();
    }

    public function relatedProducts(Product $product)
    {
        return Product::where('is_active', 1)
            ->whereHas('category', fn($q) => $q->whereIn('categories.id', $product->category->pluck('id')))
            ->where('id', '!=', $product->id)
            ->limit(10)
            ->with(['brand', 'category', 'type', 'sports'])
            ->get();
    }
}
