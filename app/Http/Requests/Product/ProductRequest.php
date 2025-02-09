<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'photo' => ['nullable', 'image', 'max:5120'], // 5MB max
            'product_type_id' => ['required', 'exists:product_types,id']
        ];

        // If it's an update request (PUT/PATCH), make fields optional
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['sometimes', 'string', 'max:255'];
            $rules['price'] = ['sometimes', 'numeric', 'min:0'];
            $rules['product_type_id'] = ['sometimes', 'exists:product_types,id'];
        }

        return $rules;
    }
}
