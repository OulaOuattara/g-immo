<x-layout>
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 mt-10 px-4">

        {{-- 📱 Barre filtres mobile (fixe en haut) --}}
        <div class="lg:hidden fixed top-0 left-0 right-0 bg-white shadow-md z-50">
            <div class="flex justify-between items-center px-4 py-3 border-b">
                <h3 class="text-lg font-semibold text-gray-800">🎯 Filtres</h3>
                <button id="toggleFilters" class="text-orange-500 font-medium">Fermer</button>
            </div>
            <div id="filtersPanel" class="max-h-[70vh] overflow-y-auto p-4 hidden">
                <x-filters :filters="$filters" />
            </div>
        </div>

        {{-- 🖥️ Sidebar filtres desktop --}}
        <aside class="hidden lg:block w-1/4 bg-white shadow-md rounded-2xl p-6 h-fit sticky top-24">
            @if (Auth::check() && optional(Auth::user()->role)->name === 'bailleur')
                <div class="mb-6 text-center">
                    <a href="{{ route('properties.mine') }}"
                    class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg font-medium">
                    Mes propriétés
                    </a>
                </div>
                <div class="w-full h-0.5 bg-orange-500 mb-2"></div>
            @endif

            <div class="flex items-center justify-center m-2 p-2"><h3 class="text-lg font-bold text-gray-600">Appliquez des filtres</h3></div>
            <x-filters :filters="$filters" />
        </aside>

        {{-- 🏠 Contenu principal --}}
        <section class="flex-1 mt-20 lg:mt-0">
            @if ($properties->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($properties as $property)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3">
                            <img src="{{ $property->photos->first()?->photo_path ? asset('storage/' . $property->photos->first()->photo_path) : asset('images/no-image.png') }}"
                                 alt="Image propriété"
                                 class="w-full h-48 object-cover rounded-lg mb-3">
                            <h3 class="font-semibold text-lg text-gray-800">{{ ucfirst($property->type) }}</h3>
                            <p class="text-gray-600">{{ $property->ville }}</p>
                            <p class="text-orange-600 font-bold">{{ number_format($property->prix, 0, ',', ' ') }} FCFA</p>
                            <a href="{{ route('properties.show', $property->id) }}"
                               class="mt-2 inline-block text-orange-500 font-medium hover:underline">
                                Voir détails
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10 flex justify-center">
                    {{ $properties->links() }}
                </div>

            @else
                <div class="text-center py-20 text-gray-600">
                    <p class="text-lg font-medium">Aucune propriété trouvée</p>
                    <p class="text-sm">Essayez de modifier vos filtres ou votre recherche.</p>
                </div>
            @endif
        </section>
    </div>

    {{-- JS Toggle mobile --}}
    <script>
        const toggleBtn = document.getElementById('toggleFilters');
        const filtersPanel = document.getElementById('filtersPanel');

        if (toggleBtn && filtersPanel) {
            // Valeur initiale
            toggleBtn.textContent = 'Ouvrir';

            toggleBtn.addEventListener('click', () => {
                const isHidden = filtersPanel.classList.toggle('hidden');

                // Si le panneau est caché => texte devient "Ouvrir"
                if (isHidden) {
                    toggleBtn.textContent = 'Ouvrir';
                } 
                // Si le panneau est visible => texte devient "Fermer"
                else {
                    toggleBtn.textContent = 'Fermer';
                }
            });
        }
    </script>

</x-layout>

