<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyPhotoRequest extends FormRequest
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
            // Les champs deviennent "sometimes|required" car tous ne sont pas modifiés à chaque fois
            'type' => 'sometimes|required|in:apartement,villa,terrain,immeuble',
            'usage' => 'sometimes|required|in:residence,commercial,bureau,agriculture,industriel',
            'option' => 'sometimes|required|in:vente,location',
            'prix' => 'sometimes|required|numeric|min:0',
            'surface' => 'sometimes|required|numeric|min:1',
            'pays' => 'sometimes|required|string|max:100',
            'ville' => 'sometimes|required|string|max:100',
            'status' => 'sometimes|required|in:disponible,indisponible',

            // Images
            'image_principale' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            // --- TYPE ---
            'type.required' => 'Le type de propriété est requis lors de la mise à jour.',
            'type.in' => 'Le type sélectionné est invalide. Choisissez entre appartement, villa, terrain ou immeuble.',

            // --- USAGE ---
            'usage.required' => "L'usage de la propriété est requis.",
            'usage.in' => "L'usage sélectionné est invalide. Valeurs autorisées : résidence, commercial, bureau, agriculture ou industriel.",

            // --- OPTION ---
            'option.required' => "Veuillez indiquer si la propriété est à vendre ou à louer.",
            'option.in' => "L'option choisie doit être 'vente' ou 'location'.",

            // --- PRIX ---
            'prix.required' => 'Le prix est requis pour la mise à jour.',
            'prix.numeric' => 'Le prix doit être un nombre valide.',
            'prix.min' => 'Le prix doit être supérieur ou égal à 0.',

            // --- SURFACE ---
            'surface.required' => 'La surface doit être renseignée.',
            'surface.numeric' => 'La surface doit être un nombre valide.',
            'surface.min' => 'La surface doit être supérieure à 0.',

            // --- PAYS ---
            'pays.required' => 'Le pays doit être précisé.',
            'pays.string' => 'Le pays doit être une chaîne de caractères.',
            'pays.max' => 'Le nom du pays ne peut pas dépasser 100 caractères.',

            // --- VILLE ---
            'ville.required' => 'La ville doit être précisée.',
            'ville.string' => 'La ville doit être une chaîne de caractères.',
            'ville.max' => 'Le nom de la ville ne peut pas dépasser 100 caractères.',

            // --- STATUS ---
            'status.required' => 'Le statut doit être précisé.',
            'status.in' => 'Le statut doit être "disponible" ou "indisponible".',

            // --- IMAGE PRINCIPALE ---
            'image_principale.image' => 'Le fichier principal doit être une image.',
            'image_principale.mimes' => 'Le fichier principal doit être au format JPG, JPEG, PNG ou WEBP.',
            'image_principale.max' => "L'image principale ne doit pas dépasser 2 Mo.",

            // --- IMAGES SUPPLÉMENTAIRES ---
            'images.*.image' => 'Chaque fichier ajouté doit être une image.',
            'images.*.mimes' => 'Chaque image doit être au format JPG, JPEG, PNG ou WEBP.',
            'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
        ];
    }
}