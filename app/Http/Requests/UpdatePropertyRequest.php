<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'type' => 'nullable|in:apartement,villa,terrain,immeuble',
            'usage' => 'nullable|in:residence,commercial,bureau,agriculture,industriel',
            'option' => 'nullable|in:vente,location',
            'prix' => 'nullable|numeric|min:0',
            'surface' => 'nullable|numeric|min:1',
            'pays' => 'nullable|string|max:100',
            'ville' => 'nullable|string|max:100',
            'status' => 'nullable|in:disponible,indisponible',
            'image_principale' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            // Type
            'type.in' => 'Le type sélectionné est invalide. Choisissez entre appartement, villa, terrain ou immeuble.',

            // Usage
            'usage.in' => 'L’usage choisi est invalide. Choisissez une option parmi résidence, commercial, bureau, agriculture ou industriel.',

            // Option
            'option.in' => 'L’option doit être soit "vente" soit "location".',

            // Prix
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être supérieur ou égal à 0.',

            // Surface
            'surface.numeric' => 'La surface doit être un nombre.',
            'surface.min' => 'La surface doit être d’au moins 1 m².',

            // Pays
            'pays.string' => 'Le pays doit être une chaîne de caractères.',
            'pays.max' => 'Le pays ne doit pas dépasser 100 caractères.',

            // Ville
            'ville.string' => 'La ville doit être une chaîne de caractères.',
            'ville.max' => 'La ville ne doit pas dépasser 100 caractères.',

            // Statut
            'status.in' => 'Le statut doit être "disponible" ou "indisponible".',

            // Images
            'image_principale.image' => 'Le fichier de l’image principale doit être une image.',
            'image_principale.mimes' => 'L’image principale doit être au format JPG, JPEG, PNG ou WEBP.',
            'image_principale.max' => 'L’image principale ne doit pas dépasser 2 Mo.',

            'images.*.image' => 'Chaque image de la galerie doit être une image.',
            'images.*.mimes' => 'Les images de la galerie doivent être au format JPG, JPEG, PNG ou WEBP.',
            'images.*.max' => 'Chaque image de la galerie ne doit pas dépasser 2 Mo.',
        ];
    }
}