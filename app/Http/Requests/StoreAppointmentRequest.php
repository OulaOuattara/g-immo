<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (Auth::user()->role->name === 'client' OR Auth::user()->role->name === 'manager');
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
            'agent_id' => 'nullable|exists:agents,id',
            'appointment_date' => 'required|date|after:now',
            'type' => 'required|in:visite,transaction,consultation',
            'status' => 'in:enAttente,confirme,complete,annule'
        ];
    }

    public function messages(): array
    {
        return [
            'appointment_date.after' => 'La date du rendez-vous doit être ultérieure à maintenant.',
            'type.required' => 'Le type de rendez-vous est obligatoire.',
            'type.in' => 'Type invalide. Veuillez choisir parmi visite, transaction ou consultation.'
        ];
    }
}