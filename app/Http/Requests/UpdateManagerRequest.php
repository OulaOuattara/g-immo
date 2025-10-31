<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateManagerRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'lastName' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'regex:/^[0-9+\-\s()]+$/', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
        ];
    }

     public function messages(): array
    {
        return [
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser :max caractères.',
            
            'lastName.string' => 'Le prénom doit être une chaîne de caractères.',
            'lastName.max' => 'Le prénom ne doit pas dépasser :max caractères.',

            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.max' => 'L\'adresse e-mail ne doit pas dépasser :max caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée par un autre utilisateur.',

            'phone.regex' => 'Le numéro de téléphone n\'est pas valide.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser :max caractères.',

            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'address.max' => 'L\'adresse ne doit pas dépasser :max caractères.',
        ];
    }
}