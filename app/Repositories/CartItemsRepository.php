<?php

namespace App\Repositories;

use App\Models\CartItem;

class CartItemsRepository
{
    public function createItem($request, $product, $cart)
    {
        return CartItem::create([
            "cart_id" => $cart->id,
            "product_id" => $product->id,
            "quantity" => $request['quantity'],
            "price" => $product->price,
            "size_variant_id" => $request['size'],
            "color_variant_id" => $request['color'],
            "total_price" => $product->price * $request['quantity']
        ]);
    }
    public function updateQuantity($qty) {}
    public function getItem($productId, $cart, $sizeId = null, $colorId = null)
    {
        return CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->when($sizeId, fn($q) => $q->where('size_variant_id', $sizeId))
            ->when($colorId, fn($q) => $q->where('color_variant_id', $colorId))
            ->first();
    }
}
