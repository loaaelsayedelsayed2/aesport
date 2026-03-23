<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderRepository
{
    public function create($request, $cart)
    {
        return Order::firstOrCreate([
            "user_id" => auth('api')->user()->id,
            "cart_id" => $cart->id
        ], [
            'order_number' => 'ORD-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            "status" => 'pending',
            "item_count" => $cart->quantity,
            "delivery_fee" => $cart->delivery_fee,
            "coupon_discount" => $cart->coupon_discount,
            "total_amount" => $cart->final_total,
            "first_name" => $request['first_name'],
            "last_name" => $request['last_name'],
            "email" => $request['email'],
            "country" => $request['country'],
            "address" => $request['address'],
            "phone" => $request['phone']
        ]);
    }
    public function createItem($order, $item)
    {
        return OrderItem::firstOrCreate([
            "order_id" => $order->id,
            "product_id" => $item->product_id,
        ], [
            "quantity"  => $item->quantity,
            "price"  => $item->price,
            "size_variant_id"  => $item->size_variant_id,
            "color_variant_id"  => $item->color_variant_id,
            "total_price"  => $item->total_price,
        ]);
    }
    public function getById($id)
    {
        return Order::find($id);
    }
    public function updateCancel($id)
    {
        $order = $this->getById($id);
        $order->update([
            'status' => 'cancelled'
        ]);
        return $order;
    }
}
