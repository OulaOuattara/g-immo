<x-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white rounded-2xl shadow-lg overflow-hidden">
        {{-- ✅ Messages flash --}}
        {{-- @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif --}}

        {{-- Conteneur pour les messages temporaires --}}
        <div id="jsAlert" class="hidden fixed top-4 right-4 px-4 py-4 rounded-lg shadow-lg text-white text-lg z-50"></div>


        {{-- IMAGE PRINCIPALE --}}
        @php
            $mainPhoto = $property->photos->first(fn($p) => str_contains($p->photo_path, 'properties/main/'));
            $galleryPhotos = $property->photos->filter(fn($p) => str_contains($p->photo_path, 'properties/gallery/'));
            $user = Auth::user();
        @endphp

        @if ($mainPhoto)
            <img src="{{ Storage::url($mainPhoto->photo_path) }}" alt="Image principale"
                 class="w-full h-96 object-cover">
        @else
            <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500">
                Aucune image principale
            </div>
        @endif

        <div class="p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">
                {{ ucfirst($property->type) }} à {{ $property->ville }}
            </h1>

            {{-- Informations principales --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-6">
                <div><span class="font-medium text-gray-600">Usage :</span> {{ ucfirst($property->usage) }}</div>
                <div><span class="font-medium text-gray-600">Option :</span> {{ ucfirst($property->option) }}</div>
                <div><span class="font-medium text-gray-600">Surface :</span> {{ $property->surface }} m²</div>
                <div><span class="font-medium text-gray-600">Prix :</span>
                    <span class="text-orange-600 font-bold">{{ number_format($property->prix, 0, ',', ' ') }} FCFA</span>
                </div>
                <div><span class="font-medium text-gray-600">Pays :</span> {{ $property->pays }}</div>
                <div><span class="font-medium text-gray-600">Statut :</span>
                    <span class="px-2 py-1 rounded-lg text-white text-sm {{ $property->status === 'disponible' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>
            </div>

            {{-- 🔹 BOUTONS D’ACTION (affichés toujours) --}}
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                {{-- ❤️ Ajouter aux favoris --}}
                <form id="favoriteForm" method="POST" action="{{ route('favorites.store') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <button type="button" id="favoriteBtn"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
                        Ajouter aux favoris
                    </button>
                </form>

                {{-- 📅 Prendre rendez-vous --}}
                <button type="button" id="rendezvousBtn"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg shadow transition">
                    Prendre rendez-vous
                </button>
            </div>

            {{-- GALERIE --}}
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Galerie</h2>
            @if ($galleryPhotos->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($galleryPhotos as $photo)
                        <img src="{{ Storage::url($photo->photo_path) }}" alt="Photo galerie"
                             class="rounded-lg object-cover w-full h-48 hover:scale-105 transition-transform duration-200">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Aucune image supplémentaire pour cette propriété.</p>
            @endif

            {{-- DÉTAILS DU PROPRIÉTAIRE --}}
            @auth
                @if (in_array(Auth::user()->role->name, ['manager', 'agent','bailleur']))
                    <div class="mt-8 border-t pt-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-3">Détails du propriétaire</h2>
                        <p><span class="font-medium text-gray-600">Nom :</span> {{ $property->bailleur->name ?? 'Non renseigné' }}</p>
                        <p><span class="font-medium text-gray-600">Email :</span> {{ $property->bailleur->email ?? 'Non renseigné' }}</p>
                        <p><span class="font-medium text-gray-600">Téléphone :</span> {{ $property->bailleur->phone ?? 'Non renseigné' }}</p>
                    </div>
                @endif
            @endauth

            {{-- Bouton retour --}}
            <div class="mt-10 text-center">
                <a href="{{ route('properties.index') }}"
                   class="inline-block px-6 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition">
                    Retour à la liste des propriétés
                </a>
            </div>
        </div>
    </div>

    {{-- 📅 MODALE DE RENDEZ-VOUS --}}
    <div id="rendezvousModal" class="fixed inset-0 bg-gray-500/70 justify-center items-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md relative flex flex-col">
            <h2 class="text-xl font-semibold mb-4">Prendre rendez-vous</h2>
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <div class="mb-4">
                    <label for="appointment_date" class="block text-gray-700 mb-1">Date et heure</label>
                    <input type="datetime-local" name="appointment_date" id="appointment_date" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400 outline-none focus:border-none">
                </div>
                <div class="mb-4">
                    <label for="type" class="block text-gray-700 mb-1">Type de rendez-vous</label>
                    <select name="type" id="type" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400 outline-none focus:border-none">
                        <option value="">-- Choisir un type --</option>
                        <option value="visite">Visite du bien</option>
                        <option value="transaction">Finalisation de transaction</option>
                        <option value="consultation">Consultation</option>
                    </select>
                </div>
                <input type="hidden" name="status" value="enAttente">
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                        Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS comportement boutons --}}
    <script>
         const user = @json(Auth::user());
        const favoriteBtn = document.getElementById('favoriteBtn');
        const favoriteForm = document.getElementById('favoriteForm');
        const rendezvousBtn = document.getElementById('rendezvousBtn');
        const modal = document.getElementById('rendezvousModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const jsAlert = document.getElementById('jsAlert');

        /**
         * Afficher un message temporaire
         */
        function showMessage(message, type = 'error') {
            jsAlert.textContent = message;
            jsAlert.classList.remove('hidden');
            jsAlert.classList.remove('bg-red-500', 'bg-green-500', 'bg-orange-500');
            jsAlert.classList.add(type === 'success' ? 'bg-green-500' : type === 'warning' ? 'bg-orange-500' : 'bg-red-500');

            // Disparaît après 3 secondes
            setTimeout(() => {
                jsAlert.classList.add('hidden');
            }, 3000);
        }

        // ❤️ Favoris
        favoriteBtn.addEventListener('click', () => {
            if (!user) {
                showMessage("Veuillez vous connecter pour ajouter une propriété aux favoris.", "warning");
                setTimeout(() => window.location.href = "{{ route('login') }}", 2000);
            } else if (user.role.name !== 'client') {
                showMessage("Seuls les clients peuvent ajouter une propriété aux favoris.");
            } else {
                favoriteForm.submit();
            }
        });

        // 📅 Rendez-vous
        rendezvousBtn.addEventListener('click', () => {
            if (!user) {
                showMessage("Veuillez vous connecter pour prendre un rendez-vous.", "warning");
                setTimeout(() => window.location.href = "{{ route('login') }}", 2000);
            } else if (['client', 'manager'].includes(user.role.name)) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                showMessage("Seuls les clients et les managers peuvent prendre un rendez-vous.");
            }
        });

        // Fermer la modale
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            });
        }
    </script>
</x-layout>
