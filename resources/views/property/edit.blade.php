<x-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl text-white font-semibold mb-6 bg-orange-400 pb-2 text-center">
            ✏️ Modifier la propriété
        </h2>

        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Type --}}
            <div>
                <label for="type" class="block text-gray-700 font-medium mb-2">Type</label>
                <select id="type" name="type" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="">-- Sélectionner un type --</option>
                    <option value="apartement" {{ $property->type == 'apartement' ? 'selected' : '' }}>Appartement</option>
                    <option value="villa" {{ $property->type == 'villa' ? 'selected' : '' }}>Villa</option>
                    <option value="terrain" {{ $property->type == 'terrain' ? 'selected' : '' }}>Terrain</option>
                    <option value="immeuble" {{ $property->type == 'immeuble' ? 'selected' : '' }}>Immeuble</option>
                </select>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Usage --}}
            <div>
                <label for="usage" class="block text-gray-700 font-medium mb-2">Usage</label>
                <select id="usage" name="usage" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="">-- Choisir l’usage --</option>
                    <option value="residence" {{ $property->usage == 'residence' ? 'selected' : '' }}>Résidence</option>
                    <option value="commercial" {{ $property->usage == 'commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="bureau" {{ $property->usage == 'bureau' ? 'selected' : '' }}>Bureau</option>
                    <option value="agriculture" {{ $property->usage == 'agriculture' ? 'selected' : '' }}>Agriculture</option>
                    <option value="industriel" {{ $property->usage == 'industriel' ? 'selected' : '' }}>Industriel</option>
                </select>
                @error('usage') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Option --}}
            <div>
                <label for="option" class="block text-gray-700 font-medium mb-2">Option</label>
                <select id="option" name="option" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="">-- Choisir l’option --</option>
                    <option value="vente" {{ $property->option == 'vente' ? 'selected' : '' }}>Vente</option>
                    <option value="location" {{ $property->option == 'location' ? 'selected' : '' }}>Location</option>
                </select>
                @error('option') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Prix --}}
            <div>
                <label for="prix" class="block text-gray-700 font-medium mb-2">Prix (FCFA)</label>
                <input type="number" name="prix" id="prix"
                    class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2"
                    placeholder="Ex : 25000000" value="{{ old('prix', $property->prix) }}">
                @error('prix') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Surface --}}
            <div>
                <label for="surface" class="block text-gray-700 font-medium mb-2">Surface (m²)</label>
                <input type="number" name="surface" id="surface"
                    class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2"
                    placeholder="Ex : 200" value="{{ old('surface', $property->surface) }}">
                @error('surface') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Pays --}}
            <div>
                <label for="pays" class="block text-gray-700 font-medium mb-2">Pays</label>
                <input type="text" name="pays" id="pays"
                    class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2"
                    placeholder="Ex : Burkina Faso" value="{{ old('pays', $property->pays) }}">
                @error('pays') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Ville --}}
            <div>
                <label for="ville" class="block text-gray-700 font-medium mb-2">Ville</label>
                <input type="text" name="ville" id="ville"
                    class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2"
                    placeholder="Ex : Ouagadougou" value="{{ old('ville', $property->ville) }}">
                @error('ville') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Statut --}}
            <div>
                <label for="status" class="block text-gray-700 font-medium mb-2">Statut</label>
                <select id="status" name="status" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="disponible" {{ $property->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="indisponible" {{ $property->status == 'indisponible' ? 'selected' : '' }}>Indisponible</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Image principale actuelle --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Image principale actuelle</label>
                @php
                    $mainPhoto = $property->photos->firstWhere('photo_path', 'like', 'properties/main/%');
                @endphp
                @if($mainPhoto)
                    <img src="{{ asset('storage/' . $mainPhoto->photo_path) }}" class="w-40 h-32 object-cover rounded-lg shadow mb-3">
                @else
                    <p class="text-gray-500 italic">Aucune image principale enregistrée</p>
                @endif
            </div>

            {{-- Nouvelle image principale --}}
            <div>
                <label for="image_principale" class="block text-gray-700 font-medium mb-2">Nouvelle image principale (facultatif)</label>
                <input type="file" name="image_principale" id="image_principale" accept="image/*"
                    class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                @error('image_principale') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Galerie actuelle --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Galerie actuelle</label>
                <div class="flex flex-wrap gap-3">
                    @foreach ($property->photos->where('photo_path', 'like', 'properties/gallery/%') as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" class="w-28 h-24 object-cover rounded-lg shadow">
                    @endforeach
                    @if ($property->photos->where('photo_path', 'like', 'properties/gallery/%')->isEmpty())
                        <p class="text-gray-500 italic">Aucune image dans la galerie</p>
                    @endif
                </div>
            </div>

            {{-- Nouvelle galerie --}}
            <div>
                <label for="images" class="block text-gray-700 font-medium mb-2">Ajouter de nouvelles images (facultatif)</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*"
                    class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                @error('images.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('properties.index') }}" class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">Annuler</a>
                <button type="submit" class="px-5 py-2 rounded-lg bg-orange-500 hover:bg-orange-700 text-white font-medium">Mettre à jour</button>
            </div>
        </form>
    </div>
</x-layout>
