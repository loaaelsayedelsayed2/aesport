<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            "total" => $this->total_amount,
            "delivery" => $this->delivery_fee,
            "discount" => $this->coupon_discount,
            "date" => $this->created_at,
            "payment_method" => 'credit card',
            "billing_address" => [
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "email" => $this->email,
                "address" => $this->address,
                "country" => $this->country,
                "phone" => $this->phone,
            ],
            "items" => OrderDetailsItemsResources::collection($this->items)
        ];
    }
}
