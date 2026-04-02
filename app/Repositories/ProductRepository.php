<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductFav;
use App\Models\Review;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
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
                AllowedFilter::callback('price_from', fn($q, $v) => $q->where('price', '>=', $v)),
                AllowedFilter::callback('price_to',   fn($q, $v) => $q->where('price', '<=', $v)),
                AllowedFilter::partial('search', 'name'),
            ])
            ->allowedSorts([
                'price',
                '-price',
                AllowedSort::callback('rating', function ($q, $descending) {
                    $q->orderBy(
                        Review::selectRaw('COALESCE(AVG(rating), 0)')
                            ->whereColumn('product_id', 'products.id'),
                        $descending ? 'desc' : 'asc'
                    );
                }),
                AllowedSort::callback('top_seller', function ($q, $descending) {
                    $q->orderBy('orders_count', 'desc');
                }),
                'created_at',
            ])
            ->withAvg('reviews', 'rating')
            ->withCount([
                'favs as fav' => fn($q) => $q->where('user_id', $userId),
                'cartItems as in_cart' => function ($q) use ($userId) {
                    $q->whereHas('cart', function ($q2) use ($userId) {
                        $q2->where('user_id', $userId);
                    });
                }
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

    public function getById($id)
    {
        return Product::find($id);
    }

    public function getProductsBySale($discount)
    {
        return Product::where('discount_price', '>=', $discount[0])
            ->where('discount_type', $discount[1])
            ->limit(6)
            ->get();
    }
}
