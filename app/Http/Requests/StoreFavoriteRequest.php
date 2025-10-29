<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavoriteRequest extends FormRequest
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
            'property_id' => 'required|exists:properties,id',
        ];
    }

    public function messages(): array
    {
        return [
            'property_id.required' => 'La propriété est requise.',
            'property_id.exists' => 'La propriété sélectionnée est invalide.',
        ];
    }
}