<x-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white rounded-2xl shadow-lg overflow-hidden">
        {{-- IMAGE PRINCIPALE --}}
        @php
            $mainPhoto = $property->photos->first(fn($p) => str_contains($p->photo_path, 'properties/main/'));
            $galleryPhotos = $property->photos->filter(fn($p) => str_contains($p->photo_path, 'properties/gallery/'));
        @endphp

        @if ($mainPhoto)
            <img src="{{ Storage::url($mainPhoto->photo_path) }}" alt="Image principale"
                class="w-full h-96 object-cover">
        @else
            <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500">
                Aucune image principale
            </div>
        @endif

        {{-- INFORMATIONS GÉNÉRALES --}}
        <div class="p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">
                {{ ucfirst($property->type) }} à {{ $property->ville }}
            </h1>

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

            {{-- DÉTAILS DU PROPRIÉTAIRE (visibles uniquement par manager ou agent) --}}
            @auth
                @if (in_array(Auth::user()->role->name, ['manager', 'agent']))
                    <div class="mt-8 border-t pt-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-3">👤 Détails du propriétaire</h2>
                        <p><span class="font-medium text-gray-600">Nom :</span> {{ $property->bailleur->name ?? 'Non renseigné' }}</p>
                        <p><span class="font-medium text-gray-600">Email :</span> {{ $property->bailleur->email ?? 'Non renseigné' }}</p>
                        <p><span class="font-medium text-gray-600">Téléphone :</span> {{ $property->bailleur->phone ?? 'Non renseigné' }}</p>
                    </div>
                @endif
            @endauth

            {{-- Si non connecté ou autre rôle --}}
            @guest
                <p class="mt-6 text-gray-500 italic text-sm text-center">
                    Connectez-vous pour voir plus d’informations sur cette propriété.
                </p>
            @endguest

            {{-- 🔙 Bouton retour --}}
            <div class="mt-10 text-center">
                <a href="{{ route('properties.index') }}"
                   class="inline-block px-6 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition">
                    Retour à la liste des propriétés
                </a>
            </div>
        </div>
    </div>
</x-layout>
