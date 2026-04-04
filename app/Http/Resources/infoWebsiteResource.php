<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class infoWebsiteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            "website_name" => null,
            "website_logo" => null,
            "contact_bar_active" => 0,
            "contact_phone" => null,
            "contact_email" => null,
            "contact_address" => null,
        ];

        foreach ($this->resource as $item) {
            $value = $item->value ?? null;

            if ($value && $this->isImage($value)) {
                $value = asset($value);
            }

            switch ($item->key) {
                case 'site_name':
                    $data['website_name'] = $value;
                    break;
                case 'site_logo':
                    $data['website_logo'] = asset($value);
                    break;
                case 'contact_active':
                    $data['contact_bar_active'] = (int)$value;
                    break;
                case 'contact_phone':
                    $data['contact_phone'] = $value;
                    break;
                case 'contact_email':
                    $data['contact_email'] = $value;
                    break;
                case 'contact_address':
                    $data['contact_address'] = $value;
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
