<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductFav;
use App\Models\Review;
use App\Models\ReviewImage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReviwesRepository
{
    public function create($data)
    {
        $userId = auth('api')->user()->id;
        $review = Review::create([
            "product_id" => $data['product_id'],
            "user_id" => $userId,
            "rating" => $data['rate'],
            "comment" => $data['comment'],
        ]);
        if ($data->hasFile('image')) {
            foreach ($data->file('image') as $image) {
                $path = $image->store('reviews', 'public');
                ReviewImage::create([
                    "review_id" => $review->id,
                    "image"     => $path,
                ]);
            }
        }
    }
}
