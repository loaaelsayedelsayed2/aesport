<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResources extends JsonResource
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
            "description" => $this->description,
            "additional_info" => $this->additional_info,
            'main_image' => asset($this->main_image),
            'images' => ImagesResource::collection($this->images),
            'category' => CategoriesResource::collection($this->category),
            'price' => $this->price,
            'price_before_discount' => $this->price_before_discount,
            'discount' => $this->discount_price,
            'brand' => BrandsResource::collection($this->brand),
            'type' => TypesResources::collection($this->type),
            'sport' => SportsResource::collection($this->sports),
            'colores' => VariantsResource::collection($this->variants->where('key', 'color')),
            'sizes' => VariantsResource::collection($this->variants->where('key', 'size')),
            'is_fav' => (bool) $this->fav,
            "review_count" => $this->reviews->count(),
            "average_rate" => round($this->reviews->avg('rating'), 1),
            'rating_breakdown'    => collect([5, 4, 3, 2, 1])->mapWithKeys(fn($star) => [
                $star => $this->reviews->where('rating', $star)->count()
            ]),
            'reviews' => ReviewResource::collection($this->reviews),
            'related_products' => ProductResources::collection(
                app(ProductRepository::class)->relatedProducts($this->resource)
            ),
        ];
    }
}
