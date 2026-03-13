<?php

namespace App\Repositories;

use App\Models\Product;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository
{
    public function list1(){
        return Product::where('is_active',1)->get();
    }
    public function list()
    {
        return QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('brand', 'brand.id'),
                AllowedFilter::exact('category', 'category.id'),
                AllowedFilter::exact('type', 'type.id'),
                AllowedFilter::exact('sport', 'sports.id'),
            ])
            ->with(['brand', 'category', 'type', 'sports'])
            ->get();
    }


}
