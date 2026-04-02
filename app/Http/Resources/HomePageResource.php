<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // تعريف الداتا الافتراضية
        $data = [
            "title" => null,
            "desc" => null,
            "image" => null,
            "promot_bar_active" => 0,
            "promot_1" => null,
            "promot_2" => null,
        ];

        // هنا نفترض أن $this->resource هو collection من ال settings
        foreach ($this->resource as $item) {
            $value = $item->value ?? null;

            if ($value && $this->isImage($value)) {
                $value = asset($value);
            }

            switch ($item->key) {
                case 'home_hero_title':
                    $data['title'] = $value;
                    break;
                case 'home_hero_desc':
                    $data['desc'] = $value;
                    break;
                case 'home_hero_image':
                    $data['image'] = $value;
                    break;
                case 'home_promo_active':
                    $data['promot_bar_active'] = (int)$value;
                    break;
                case 'home_note_1':
                    $data['promot_1'] = $value;
                    break;
                case 'home_note_2':
                    $data['promot_2'] = $value;
                    break;
            }
        }

        return $data;
    }

    private function isImage($value): bool
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
        return in_array($ext, $extensions);
    }
}