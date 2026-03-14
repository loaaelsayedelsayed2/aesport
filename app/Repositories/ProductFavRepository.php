<?php

namespace App\Repositories;

use App\Models\ProductFav;


class ProductFavRepository
{
    public function list()
    {
        $userId = auth('api')->user()->id;
        return ProductFav::where('user_id',$userId)
        ->with(['product.brand', 'product.category', 'product.type', 'product.sports'])
        ->get();
    }
    public function addFavorites($data)
    {
        return ProductFav::create($data);
    }
    public function getFavoriteProduct($id)
    {
        return ProductFav::where('product_id',$id)->first();
    }
    public function removeFavorites($product)
    {
        return $product->delete();
    }
}
