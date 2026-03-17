<?php

namespace App\Repositories;

use App\Models\CartItem;

class CartItemsRepository
{
    public function createItem($request, $product, $cart)
    {
        $qty = $request['quantity'] ?? 1;
        return CartItem::create([
            "cart_id" => $cart->id,
            "product_id" => $product->id,
            "quantity" => $qty,
            "price" => $product->price,
            "size_variant_id" => $request['size'] ?? null,
            "color_variant_id" => $request['color'] ?? null,
            "total_price" => $product->price * $qty
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
    public function getItemById($itemId)
    {
        return CartItem::where('id', $itemId)->first();
    }
    public function removeFromCart($itemId)
    {
        $item = $this->getItemById($itemId);
        return $item->delete();
    }
}
