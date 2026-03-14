<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishListProductResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                  => $this->product->id,
            "name"                => $this->product->name,
            'main_image'          => asset($this->product->main_image),
            'category'            => CategoriesResource::collection($this->product->category),
            'price'               => $this->product->price,
            'price_before_discount' => $this->product->price_before_discount,
            'discount'            => $this->product->discount_price,
            'brand'               => BrandsResource::collection($this->product->brand),
            'type'                => TypesResources::collection($this->product->type),
            'sport'               => SportsResource::collection($this->product->sports),
            'is_fav'              => true,
        ];
    }
}
