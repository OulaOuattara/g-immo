<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginUserRequest;
use App\Http\Requests\StoreManagerRequest;
use App\Models\Agent;
use App\Models\Bailleur;
use App\Models\Client;
use App\Models\Manager;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(loginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role) {
                if ($user->role->name === 'manager') {
                    return redirect()->route('managers.index');
                } elseif ($user->role->name === 'agent') {
                    return redirect()->route('agents.index');
                } elseif ($user->role->name === 'bailleur') {
                    return redirect()->route('properties.index');
                } elseif ($user->role->name === 'client') {
                    return redirect()->route('properties.index');
                }
            }
        }

        return redirect()->route('login')->with('error', 'Identifiants invalides.');
    }

    public function registration()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role && $user->role->name === 'manager') {
                $roles = Role::whereIn('name', ['manager', 'agent'])->get();
                return view('Manager.create', compact('roles'));
            }
        }else {
            $roles = Role::whereIn('name', ['bailleur', 'client'])->get();
            return view('Manager.create', compact('roles'));
        }       
    }


    public function postRegistration(StoreManagerRequest $request)
    {  
        $user = User::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        if($request->role_id == Role::where('name', 'manager')->first()->id){
            $manager = Manager::create([
                'user_id' => $user->id,
            ]);

            Auth::login($user);
            return redirect()->route('dashboard');
        } elseif ($request->role_id == Role::where('name', 'agent')->first()->id) {
            $agent = Agent::create([
                'user_id' => $user->id,
            ]);

            Auth::login($user);
            return redirect()->route('dashboard');
        } elseif ($request->role_id == Role::where('name', 'bailleur')->first()->id) {
            // Create Bailleur
            $bailleur = Bailleur::create([
                'user_id' => $user->id,
            ]);

            Auth::login($user);
            return redirect()->route('dashboard');
        } elseif ($request->role_id == Role::where('name', 'client')->first()->id) {
            // Create Client
            $client = Client::create([
                'user_id' => $user->id,
            ]);

            Auth::login($user);
            return redirect()->route('dashboard');
        }

    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }


}