<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateManagerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Affiche le profil utilisateur (vue lecture seule)
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Met à jour les informations du profil utilisateur
     */
    public function update(UpdateManagerRequest $request)
    {
        $updateUser = User::findOrFail(Auth::user()->id);

        // Mise à jour conditionnelle des champs
        $updateUser->update([
            'name' => $request->name ?? $updateUser->name,
            'lastName' => $request->lastName ?? $updateUser->lastName,
            'email' => $request->email ?? $updateUser->email,
            'phone' => $request->phone ?? $updateUser->phone,
            'address' => $request->address ?? $updateUser->address,
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Met à jour le mot de passe utilisateur
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8',
        ]);

        $updateUser = User::findOrFail(Auth::user()->id);
        // Vérification du mot de passe actuel
        if (!Hash::check($request->current_password, $updateUser->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $updateUser->update([
            'password'=>Hash::make($request->password),
        ]);
        return back()->with('success', 'Mot de passe mis à jour avec succès.');
    }
}