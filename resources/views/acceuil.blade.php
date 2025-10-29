<x-layout>

    {{-- === HERO SECTION === --}}
    <section
        class="relative flex flex-col items-center justify-center h-[85vh] bg-cover bg-center text-white"
        style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80');"
    >
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 text-center px-6 bg-gray-700/60 rounded-lg py-8">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Trouvez le bien de vos rêves avec <br>
                <span class="text-orange-500">G-IMMO</span>
            </h1>
            <p class="text-lg md:text-2xl mb-8">
                Vente, location et gestion immobilière — votre partenaire de confiance.
            </p>

            {{-- Barre de recherche intégrée --}}
            <form action="{{ route('properties.index') }}" method="GET" class="max-w-xl mx-auto flex rounded-full overflow-hidden shadow-lg">
                <input type="text" name="search" placeholder="Recherchez une propriété (ex: villa, Ouagadougou...)"
                       class="flex-1 px-5 py-3 text-gray-700 focus:outline-none bg-gray-100">
                <button type="submit" class="bg-orange-500 px-6 py-3 font-semibold hover:bg-orange-600 transition ">
                    Rechercher
                </button>
            </form>
        </div>
    </section>

    {{-- === SERVICES SECTION === --}}
    <section id="services" class="py-16 bg-gray-50 text-center">
        <h2 class="text-3xl font-bold mb-12 text-gray-900">Nos Services</h2>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-6">

            {{-- Gestion locative --}}
            <a href="{{ Auth::check() && (optional(Auth::user()->role)->name === 'bailleur' OR optional(Auth::user()->role)->name === 'manager' OR optional(Auth::user()->role)->name === 'agent') ? route('properties.mine') : route('login') }}"
               class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8 block">
                <div class="text-5xl mb-4">🏠</div>
                <h3 class="text-xl font-semibold mb-3 text-orange-500">Gestion Locative</h3>
                <p class="text-gray-700">
                    Confiez-nous la gestion complète de vos biens : loyers, entretien et suivi locatif.
                </p>
            </a>

            {{-- Vente & Achat --}}
            <a href="{{ route('properties.index', ['option' => 'vente']) }}"
               class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8 block">
                <div class="text-5xl mb-4">💼</div>
                <h3 class="text-xl font-semibold mb-3 text-orange-500">Vente & Achat</h3>
                <p class="text-gray-700">
                    Bénéficiez de notre expertise pour vendre ou acquérir un bien au meilleur prix.
                </p>
            </a>

            {{-- Location --}}
            <a href="{{ route('properties.index', ['option' => 'location']) }}"
               class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8 block">
                <div class="text-5xl mb-4">🔑</div>
                <h3 class="text-xl font-semibold mb-3 text-orange-500">Location</h3>
                <p class="text-gray-700">
                    Trouvez rapidement le logement ou le local professionnel idéal pour vos besoins.
                </p>
            </a>
        </div>
    </section>

    {{-- === PROPRIÉTÉS EN VEDETTE === --}}
    <section id="proprietes" class="py-16 bg-white">
        <h2 class="text-3xl font-bold mb-12 text-center text-gray-900">
            Nos Propriétés en Vedette
        </h2>

        @php
            $featured = \App\Models\Property::with('photos')
                ->where('status', 'disponible')
                ->latest()
                ->take(3)
                ->get();
        @endphp

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6">
            @forelse ($featured as $property)
                <div class="rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition bg-gray-50">
                    <img
                        src="{{ $property->photos->first()?->photo_path
                                ? asset('storage/' . $property->photos->first()->photo_path)
                                : asset('images/no-image.png') }}"
                        alt="{{ ucfirst($property->type) }}"
                        class="w-full h-60 object-cover"
                    />
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">
                            {{ ucfirst($property->type) }} à {{ ucfirst($property->ville) }}
                        </h3>
                        <p class="text-orange-500 font-bold mb-4">
                            {{ number_format($property->prix, 0, ',', ' ') }} FCFA
                        </p>
                        <a href="{{ route('properties.show', $property->id) }}"
                           class="bg-gray-900 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                            Voir les détails
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-600">
                    <p class="mb-4">Aucune propriété disponible pour le moment.</p>
                    <a href="{{ route('properties.index') }}"
                       class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg">
                       Voir toutes les propriétés
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    {{-- === SECTION CTA FINALE === --}}
    <section class="py-16 bg-orange-500 text-white text-center">
        <h2 class="text-3xl font-bold mb-6">
            Vous êtes propriétaire ? Mettez votre bien en valeur dès aujourd’hui !
        </h2>
        <p class="max-w-2xl mx-auto mb-8 text-lg">
            Publiez votre propriété sur G-IMMO et atteignez des milliers de clients potentiels.
        </p>

        @auth
            <a href="{{ route('properties.create') }}"
               class="bg-white text-orange-600 px-8 py-3 rounded-full font-semibold shadow hover:bg-gray-100 transition">
                Ajouter une propriété
            </a>
        @else
            <a href="{{ route('login') }}"
               class="bg-white text-orange-600 px-8 py-3 rounded-full font-semibold shadow hover:bg-gray-100 transition">
                Se connecter pour publier
            </a>
        @endauth
    </section>

</x-layout>
