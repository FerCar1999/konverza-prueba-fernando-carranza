<?php

namespace App\Http\Requests;

use App\Enums\MovementEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InventoryRequest extends FormRequest
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
            'product_id' => ['required', 'uuid'],
            'quantity' => ['required', 'integer'],
            'movement' => ['required', Rule::enum(MovementEnum::class)],
            'description' => ['nullable', 'string'],
            'movement_date' => ['required', 'date']
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => 'identificador del producto',
            'quantity' => 'cantidad del producto',
            'movement' => 'tipo de movimiento del producto',
            'description' => 'descripción del movimiento',
            'movement_date' => 'fecha del movimiento'
        ];
    }
}
