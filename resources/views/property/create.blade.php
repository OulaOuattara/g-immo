<x-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl text-white font-semibold mb-6 bg-orange-400 pb-2 text-center">
            🏠 Ajouter une nouvelle propriété
        </h2>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Type --}}
            <div>
                <label for="type" class="block text-gray-700 font-medium mb-2">Type</label>
                <select id="type" name="type" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="">-- Sélectionner un type --</option>
                    <option value="apartement">Appartement</option>
                    <option value="villa">Villa</option>
                    <option value="terrain">Terrain</option>
                    <option value="immeuble">Immeuble</option>
                </select>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Usage --}}
            <div>
                <label for="usage" class="block text-gray-700 font-medium mb-2">Usage</label>
                <select id="usage" name="usage" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="">-- Choisir l’usage --</option>
                    <option value="residence">Résidence</option>
                    <option value="commercial">Commercial</option>
                    <option value="bureau">Bureau</option>
                    <option value="agriculture">Agriculture</option>
                    <option value="industriel">Industriel</option>
                </select>
                @error('usage') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Option --}}
            <div>
                <label for="option" class="block text-gray-700 font-medium mb-2">Option</label>
                <select id="option" name="option" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="">-- Choisir l’option --</option>
                    <option value="vente">Vente</option>
                    <option value="location">Location</option>
                </select>
                @error('option') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Prix --}}
            <div>
                <label for="prix" class="block text-gray-700 font-medium mb-2">Prix (FCFA)</label>
                <input type="number" name="prix" id="prix" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2" placeholder="Ex : 25000000" value="{{ old('prix') }}">
                @error('prix') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Surface --}}
            <div>
                <label for="surface" class="block text-gray-700 font-medium mb-2">Surface (m²)</label>
                <input type="number" name="surface" id="surface" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2" placeholder="Ex : 200" value="{{ old('surface') }}">
                @error('surface') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Pays --}}
            <div>
                <label for="pays" class="block text-gray-700 font-medium mb-2">Pays</label>
                <input type="text" name="pays" id="pays" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2" placeholder="Ex : Burkina Faso" value="{{ old('pays') }}">
                @error('pays') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Ville --}}
            <div>
                <label for="ville" class="block text-gray-700 font-medium mb-2">Ville</label>
                <input type="text" name="ville" id="ville" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2" placeholder="Ex : Ouagadougou" value="{{ old('ville') }}">
                @error('ville') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Statut --}}
            <div>
                <label for="status" class="block text-gray-700 font-medium mb-2">Statut</label>
                <select id="status" name="status" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                    <option value="disponible">Disponible</option>
                    <option value="indisponible">Indisponible</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Image principale --}}
            <div>
                <label for="image_principale" class="block text-gray-700 font-medium mb-2">Image principale</label>
                <input type="file" name="image_principale" id="image_principale" accept="image/*" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                @error('image_principale') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Galerie d’images --}}
            <div>
                <label for="images" class="block text-gray-700 font-medium mb-2">Galerie (plusieurs images)</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*" class="w-full focus:border-none rounded-lg border-gray-300 border-2 focus:ring-orange-400 focus:ring-2 outline-none p-2">
                @error('images.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            {{-- Boutons --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('properties.index') }}" class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">Annuler</a>
                <button type="submit" class="px-5 py-2 rounded-lg bg-orange-500 hover:bg-orange-700 text-white font-medium">Enregistrer</button>
            </div>
        </form>
    </div>
</x-layout>
