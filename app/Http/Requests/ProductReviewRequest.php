<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "product_id" => ["required", "exists:products,id"],
            "rate" => ["required", "numeric","max:5","min:1"],
            "comment" => ["required", "max:200"],
            "image"   => ["nullable", "array"],
            "image.*" => ["nullable", "image"],
        ];
    }
}
