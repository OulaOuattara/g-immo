<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManagerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => ['nullable', 'string', 'regex:/^[0-9+\-\s()]+$/', 'max:20'],
            'address' => 'nullable|string|max:500',
            'role_id' => 'required|exists:roles,id',
            'password' => ['required', 'string', 'min:8'],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser :max caractères.',
            'lastName.required' => 'Le prénom est obligatoire.',
            'lasname.string' => 'Le prénom doit être une chaîne de caractères.',
            'lastName.max' => 'Le prénom ne doit pas dépasser :max caractères.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'phone.regex' => 'Le numéro de téléphone n\'est pas valide.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser :max caractères.',
            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'address.max' => 'L\'adresse ne doit pas dépasser :max caractères.',
        ];
    }

    
}