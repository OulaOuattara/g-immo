<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\PropertyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Si l’utilisateur clique sur “Réinitialiser”, on efface la session
        if ($request->has('reset')) {
            session()->forget('property_filters');
            return redirect()->route('properties.index');
        }

        //Récupération des filtres envoyés ou depuis la session
        $filters = $request->all() ?: session('property_filters', []);

        //Sauvegarde en session (pour persister les filtres entre pages)
        if (!empty($filters)) {
            session(['property_filters' => $filters]);
        }

        //Construction de la requête avec les filtres actifs
        $query = Property::with('photos')->where('status', 'disponible');

        if (!empty($filters['search'] ?? null)) {
            $query->where(function ($q) use ($filters) {
                $search = $filters['search'];
                $q->where('ville', 'ILIKE', "%{$search}%")
                ->orWhere('pays', 'ILIKE', "%{$search}%")
                ->orWhere('type', 'ILIKE', "%{$search}%")
                ->orWhere('usage', 'ILIKE', "%{$search}%")
                ->orWhere('option', 'ILIKE', "%{$search}%");
            });
        }

        // Filtres avancés : type, usage, option
        if (!empty($filters['type'] ?? null)) {
            $types = is_array($filters['type']) ? $filters['type'] : [$filters['type']];
            $query->whereIn('type', $types);
        }

        if (!empty($filters['usage'] ?? null)) {
            $usages = is_array($filters['usage']) ? $filters['usage'] : [$filters['usage']];
            $query->whereIn('usage', $usages);
        }

        if (!empty($filters['option'] ?? null)) {
            $options = is_array($filters['option']) ? $filters['option'] : [$filters['option']];
            $query->whereIn('option', $options);
        }

        if (!empty($filters['ville'] ?? null)) {
            $query->where('ville', 'ILIKE', "%{$filters['ville']}%");
        }

        if (!empty($filters['prix_max'] ?? null)) {
            $query->where('prix', '<=', $filters['prix_max']);
        }

        //Exécution de la requête avec pagination
        $allowedFilters = ['search', 'type', 'usage', 'option', 'ville', 'prix_max'];

        foreach (['type', 'usage', 'option'] as $key) {
            if (!empty($filters[$key]) && !is_array($filters[$key])) {
                $filters[$key] = [$filters[$key]];
            }
        }
        $filtered = array_intersect_key($filters, array_flip($allowedFilters));
        $properties = $query->orderBy('created_at', 'desc')->paginate(9)->appends($filtered);



        //Retourne la vue avec les filtres actifs
        return view('property.index', [
            'properties' => $properties,
            'filters' => $filters,
        ]);
    }

    public function myProperties(Request $request)
    {
        $user = Auth::user();
        
        if($user->role->name == 'manager' OR $user->role->name == 'agent'){ 
            $query = Property::with('photos');
        }elseif($user->role->name == 'bailleur'){
              // Récupère uniquement les propriétés de ce bailleur
            $query = Property::with('photos')
                ->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ville', 'ILIKE', "%{$search}%")
                ->orWhere('type', 'ILIKE', "%{$search}%")
                ->orWhere('option', 'ILIKE', "%{$search}%")
                ->orWhere('usage', 'ILIKE', "%{$search}%");
            });
        }

        // 🔹 Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('option')) {
            $query->where('option', $request->option);
        }

        $properties = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('property.mine', compact('properties'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('create', Property::class)) {
            return view('property.create');
        } else {
            abort(403, 'Unauthorized action');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $property = Property::create([
            'type'     => $request->type,
            'usage'    => $request->usage,
            'option'   => $request->option,
            'prix'     => $request->prix,
            'surface'  => $request->surface,
            'pays'     => $request->pays,
            'ville'    => $request->ville,
            'status'   => $request->status,
            'user_id'  => $request->user_id, 
        ]);

        
        if ($request->hasFile('image_principale')) {
            $mainPath = $request->file('image_principale')->store('properties/main', 'public');

            PropertyPhoto::create([
                'property_id' => $property->id,
                'photo_path'  => $mainPath,
            ]);
        }

        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties/gallery', 'public');

                PropertyPhoto::create([
                    'property_id' => $property->id,
                    'photo_path'  => $path,
                ]);
            }
        }

        return redirect()->route('properties.index')
            ->with('success', 'Propriété enregistrée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $property = Property::with(['photos', 'bailleur'])->findOrFail($id);
        return view('property.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $property = Property::with('photos')->findOrFail($id);
        if(Gate::allows('update', $property)) {
            return view('property.edit', compact('property')); 
        }else {
            abort(403, 'Unauthorized action');
        }
        
    }


    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update([
            'type'     => $request->type ?? $property->type,
            'usage'    => $request->usage ?? $property->usage,
            'option'   => $request->option ?? $property->option,
            'prix'     => $request->prix ?? $property->prix,
            'surface'  => $request->surface ?? $property->surface,
            'pays'     => $request->pays ?? $property->pays,
            'ville'    => $request->ville ?? $property->ville,
            'status'   => $request->status ?? $property->status,
        ]);

        if ($request->hasFile('image_principale')) {
        // 🔹 Supprimer les anciennes images principales seulement s’il y a une nouvelle
            foreach ($property->photos as $photo) {
                // On considère comme "principale" toute image venant de /main/
                if (str_starts_with($photo->photo_path, 'properties/main/')) {
                    if (Storage::disk('public')->exists($photo->photo_path)) {
                        Storage::disk('public')->delete($photo->photo_path);
                    }
                    $photo->delete();
                }
            }

            // 🔹 Enregistrer la nouvelle image principale dans /properties/main
            $mainPath = $request->file('image_principale')->store('properties/main', 'public');

            PropertyPhoto::create([
                'property_id' => $property->id,
                'photo_path'  => $mainPath,
            ]);

        
        }

        if ($request->hasFile('images')) {
            // 🔹 Supprimer les anciennes images secondaires seulement s’il y en a de nouvelles
            foreach ($property->photos as $photo) {
                // On considère comme "secondaire" toute image venant de /gallery/
                if (str_starts_with($photo->photo_path, 'properties/gallery/')) {
                    if (Storage::disk('public')->exists($photo->photo_path)) {
                        Storage::disk('public')->delete($photo->photo_path);
                    }
                    $photo->delete();
                }
            }

            // 🔹 Ajouter les nouvelles images dans /properties/gallery
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties/gallery', 'public');

                PropertyPhoto::create([
                    'property_id' => $property->id,
                    'photo_path'  => $path,
                ]);
            }
        }

        return redirect()->route('properties.index')
            ->with('success', 'Propriété mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Supprimer les photos associées
        foreach ($property->photos as $photo) {
            if (Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
            }
            $photo->delete();
        }

        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Propriété supprimée avec succès !');
    }
}