<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "item_id" => $this->id,
            "product_id" => $this->product_id,
            "product_name" => $this->product->name,
            "product_image" => asset($this->product->main_image),
            "quantity" => $this->quantity,
            "price" => $this->total_price,
            "size" => new VariantsResource($this->size),
            "color" => new VariantsResource($this->color)
        ];
    }
}
