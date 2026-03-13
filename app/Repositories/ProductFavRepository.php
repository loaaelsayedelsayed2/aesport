<?php

namespace App\Repositories;

use App\Models\ProductFav;


class ProductFavRepository
{
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
