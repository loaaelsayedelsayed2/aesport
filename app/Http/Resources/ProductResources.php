<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
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
            "name" => $this->name,
            'main_image' => asset('storage/' . $this->main_image),
            'category' => CategoriesResource::collection($this->category),
            'price' => $this->price,
            'price_before_discount' => $this->price_before_discount,
            'discount' => $this->discount_price,
            'brand' => BrandsResource::collection($this->brand),
            'type' => TypesResources::collection($this->type),
            'sport' => SportsResource::collection($this->sports),
            'is_fav' => (bool) $this->fav,
            'in_cart' => $this->in_cart
        ];
    }
}
