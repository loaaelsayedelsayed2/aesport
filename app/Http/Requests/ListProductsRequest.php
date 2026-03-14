<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListProductsRequest extends FormRequest
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
            'filter.price_from' => ['required_with:filter.price_to', 'numeric', 'min:0'],
            'filter.price_to'   => ['required_with:filter.price_from', 'numeric', 'gt:filter.price_from'],
        ];
    }
}
