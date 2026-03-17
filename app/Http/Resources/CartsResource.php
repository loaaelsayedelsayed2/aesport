<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Uuid\Type\Decimal;

class CartsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "cart_number" => $this->cart_number,
            "sub_total" => (float) $this->sub_total,
            "count_item" => $this->quantity,
            "delivery_fees" => (float) $this->delivery_fee,
            "coupon_discount" => (float) $this->coupon_discount,
            "final_total" => (float) $this->final_total,
            "date" => $this->created_at,
            "items" => CartItemsResource::collection($this->items)

        ];
    }
}
