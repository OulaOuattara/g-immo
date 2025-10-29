<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // On récupère les favoris avec leurs propriétés associées
        $favorites = \App\Models\Favorite::with('property.photos')
            ->where('user_id', $user->id)
            ->get();

        return view('favorite.index', compact('favorites'));
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
    public function store(StoreFavoriteRequest $request)
    {
         $user = Auth::user();

        if (!$user || $user->role->name !== 'client') {
            return redirect()->back()->with('error', 'Seuls les clients peuvent ajouter des favoris.');
        }

        $exists = Favorite::where('user_id', $user->id)
                          ->where('property_id', $request->property_id)
                          ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Cette propriété est déjà dans vos favoris.');
        }

        Favorite::create([
            'user_id' => $user->id,
            'property_id' => $request->property_id,
        ]);

        return redirect()->back()->with('success', 'Propriété ajoutée aux favoris !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        $client = Auth::user();

        if ($favorite->user_id !== $client->id) {
            abort(403, 'Action non autorisée.');
        }

        $favorite->delete();

        return redirect()->back()->with('success', 'Propriété retirée des favoris.');
    }
}