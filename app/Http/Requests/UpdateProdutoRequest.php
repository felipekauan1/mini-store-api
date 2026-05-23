<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'    => 'sometimes|required|min:3|max:100',
            'preco'   => 'sometimes|required|numeric|min:0.01',
            'estoque' => 'sometimes|required|integer|min:0',
            'categoria_id' => 'sometimes|required|exists:categorias,id',
        ];
    }
}
