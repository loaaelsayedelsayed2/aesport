<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductFav;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository
{
    public function list1()
    {
        return Product::where('is_active', 1)->get();
    }
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
            ->with(['brand', 'category', 'type', 'sports'])
            ->get();
    }
}
