<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'type' => 'required|in:apartement,villa,terrain,immeuble',
            'usage' => 'required|in:residence,commercial,bureau,agriculture,industriel',
            'option' => 'required|in:vente,location',
            'prix' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:1',
            'pays' => 'required|string|max:100',
            'ville' => 'required|string|max:100',
            'status' => 'required|in:disponible,indisponible',
            'user_id' => 'required|exists:users,id',
            'image_principale' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Le type de propriété est obligatoire.',
            'type.in' => 'Le type sélectionné est invalide. Choisissez entre appartement, villa, terrain ou immeuble.',

            // --- USAGE ---
            'usage.required' => "L'usage de la propriété est obligatoire.",
            'usage.in' => "L'usage sélectionné est invalide. Valeurs autorisées : résidence, commercial, bureau, agriculture ou industriel.",

            // --- OPTION ---
            'option.required' => "Veuillez indiquer si la propriété est à vendre ou à louer.',
            'option.in' => 'L'option choisie doit être 'vente' ou 'location'.",

            // --- PRIX ---
            'prix.required' => 'Le prix de la propriété est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre valide.',
            'prix.min' => 'Le prix ne peut pas être négatif.',

            // --- SURFACE ---
            'surface.required' => 'La surface de la propriété est obligatoire.',
            'surface.numeric' => 'La surface doit être un nombre valide.',
            'surface.min' => 'La surface doit être supérieure à 0.',

            // --- PAYS ---
            'pays.required' => 'Le pays où se situe la propriété est obligatoire.',
            'pays.string' => 'Le nom du pays doit être une chaîne de caractères.',
            'pays.max' => 'Le nom du pays ne peut pas dépasser 100 caractères.',

            // --- VILLE ---
            'ville.required' => 'La ville est obligatoire.',
            'ville.string' => 'Le nom de la ville doit être une chaîne de caractères.',
            'ville.max' => 'Le nom de la ville ne peut pas dépasser 100 caractères.',

            // --- STATUS ---
            'status.required' => 'Le statut de la propriété est obligatoire.',
            'status.in' => 'Le statut doit être "disponible" ou "indisponible".',

            // --- USER ID ---
            'user_id.required' => "L'identifiant de l'utilisateur est obligatoire.",
            'user_id.exists' => "L'utilisateur spécifié est introuvable dans le système.",

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