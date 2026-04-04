<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class pagesResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $value = $this->value ?? null;

         if ($value && $this->isImage($value)) {
             $value = asset('storage/' . $value);
         }

        return [
            "id" => $this->id,
            "page" => $this->key,
            "banner" => $value,
        ];
    }


    private function isImage($value): bool
    {
        $extensions = ['jpg','jpeg','png','gif','webp','svg'];
        $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
        return in_array($ext, $extensions);
    }
}
