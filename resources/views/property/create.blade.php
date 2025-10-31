<x-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl text-white font-semibold mb-6 bg-orange-400 pb-2 text-center rounded-md">
            Ajouter une nouvelle propriété
        </h2>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Informations générales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Type --}}
                <div>
                    <label for="type" class="block text-gray-700 font-medium mb-2">Type</label>
                    <select id="type" name="type"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none">
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
                    <select id="usage" name="usage"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none">
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
                    <select id="option" name="option"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none">
                        <option value="">-- Choisir l’option --</option>
                        <option value="vente">Vente</option>
                        <option value="location">Location</option>
                    </select>
                    @error('option') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Statut --}}
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Statut</label>
                    <select id="status" name="status"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none">
                        <option value="disponible">Disponible</option>
                        <option value="indisponible">Indisponible</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Prix --}}
                <div>
                    <label for="prix" class="block text-gray-700 font-medium mb-2">Prix (FCFA)</label>
                    <input type="number" name="prix" id="prix" value="{{ old('prix') }}"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none"
                        placeholder="Ex : 25000000">
                    @error('prix') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Surface --}}
                <div>
                    <label for="surface" class="block text-gray-700 font-medium mb-2">Surface (m²)</label>
                    <input type="number" name="surface" id="surface" value="{{ old('surface') }}"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none"
                        placeholder="Ex : 200">
                    @error('surface') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Pays --}}
                <div>
                    <label for="pays" class="block text-gray-700 font-medium mb-2">Pays</label>
                    <input type="text" name="pays" id="pays" value="{{ old('pays') }}"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none"
                        placeholder="Ex : Burkina Faso">
                    @error('pays') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Ville --}}
                <div>
                    <label for="ville" class="block text-gray-700 font-medium mb-2">Ville</label>
                    <input type="text" name="ville" id="ville" value="{{ old('ville') }}"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none"
                        placeholder="Ex : Ouagadougou">
                    @error('ville') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Section Images --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                {{-- Image principale --}}
                <div>
                    <label for="image_principale" class="block text-gray-700 font-medium mb-2">Image principale</label>
                    <input type="file" name="image_principale" id="image_principale" accept="image/*"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none">
                    @error('image_principale') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Galerie --}}
                <div>
                    <label for="images" class="block text-gray-700 font-medium mb-2">Galerie (plusieurs images)</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                        class="w-full rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-orange-400 p-2 outline-none focus:border-none">
                    @error('images.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            {{-- 🧡 Boutons --}}
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ url()->previous() }}"
                    class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition">
                    Annuler
                </a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white font-medium transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-layout>
