<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('isManager');

        $query = Client::with(['user', 'agent.user']);

        // 🔸 Filtre : clients sans agent
        if ($request->has('sans_agent') && $request->sans_agent === '1') {
            $query->whereNull('agent_id');
        }

        // 🔸 Filtre : recherche par email
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'ILIKE', '%' . $request->email . '%');
            });
        }

        // 🔸 Filtre : recherche par téléphone
        if ($request->filled('phone')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('phone', 'ILIKE', '%' . $request->phone . '%');
            });
        }

        // Pagination
        $clients = $query->paginate(10)->appends($request->query());
        $agents = Agent::with('user')->get();

        return view('manager.clients.index', compact('clients', 'agents'));
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
    public function store(StoreClientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }


    /**
     * Attribuer un agent à un client
     */
    public function assignAgent(Request $request, Client $client)
    {
        Gate::authorize('isManager');

        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
        ]);

        $client->update(['agent_id' => $validated['agent_id']]);

        return redirect()->route('clients.index')->with('success', 'Agent attribué avec succès au client.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Gate::authorize('isManager');

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}