<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsItemsResources extends JsonResource
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
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'product_image' => asset($this->product->main_image),
            'price' => $this->price,
            'quantity' => $this->quantity,
            "size" => new VariantsResource($this->size),
            "color" => new VariantsResource($this->color),
            'total_price' => $this->total_price,
        ];
    }
}
