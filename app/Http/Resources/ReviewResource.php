<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'user_name'  => $this->user->name ?? null,
            'user_email' => $this->user->email ?? null,
            'user_image' => $this->user->image ? asset($this->user->image) : null,
            'rating'     => $this->rating,
            'comment'    => $this->comment,
            'images'     => $this->images->map(fn($img) => asset($img->image)),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
