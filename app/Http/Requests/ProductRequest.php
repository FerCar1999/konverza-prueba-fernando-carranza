<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'quantity' => ['nullable', 'integer'],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:2'],
            'img_url' => ['required', 'image']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del producto',
            'quantity' => 'cantidad del producto',
            'description' => 'descripcion del producto',
            'price' => 'precio del producto',
            'img_url' => 'imagen del producto'
        ];
    }
}
