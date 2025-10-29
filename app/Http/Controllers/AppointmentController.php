<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Agent;
use App\Models\Client;
use App\Models\Manager;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour prendre un rendez-vous.');
        }

        if (!in_array($user->role->name, ['client', 'manager'])) {
            return back()->with('error', 'Seuls les clients et les managers peuvent prendre un rendez-vous.');
        }

        // Récupérer la propriété
        $property = Property::findOrFail($request->property_id);

        // On peut lier un agent si la propriété a un agent associé
        if ($user->role->name === 'client') {
            $client = $user->client;
            $clientId = $client->id;
            $agentId = $client->agent_id; // peut être null
        }

        if ($user->role->name === 'manager') {
            $manager = $user->manager;
            $agentId = $manager->id;
        }

        // dd($clientId);
        // Création du rendez-vous
        Appointment::create([
            'client_id' => $clientId,
            'property_id' => $request->property_id,
            'agent_id' => $agentId,
            'appointment_date' => $request->appointment_date,
            'type' => $request->type,
        ]);
        return redirect()
            ->route('properties.show', $property->id)
            ->with('success', 'Votre rendez-vous a été enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour continuer.');
        }

        if ($appointment->client->user_id !== $user->id && $user->role->name !== 'manager') {
            return back()->with('error', 'Vous n’êtes pas autorisé à annuler ce rendez-vous.');
        }

        $appointment->delete();

        return back()->with('success', 'Rendez-vous annulé avec succès.');
    }
}