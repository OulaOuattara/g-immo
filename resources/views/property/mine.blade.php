<x-layout>
    <div class="max-w-7xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">

        {{-- 🔹 Titre + bouton d’ajout --}}
        <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 border-b pb-3 space-y-3 md:space-y-0">
            <h2 class="text-2xl font-semibold text-gray-800">
                🏠 Mes propriétés
            </h2>

            <a href="{{ route('properties.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 text-white font-medium rounded-lg shadow hover:bg-orange-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter une propriété
            </a>
        </div>

        {{-- 🔹 Barre de recherche et filtres --}}
        <form method="GET" action="{{ route('properties.mine') }}" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0">

                {{-- Champ de recherche --}}
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher (ville, type, option...)"
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none">

                {{-- Filtre statut --}}
                <select name="status"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Statut --</option>
                    <option value="disponible" {{ request('status') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="indisponible" {{ request('status') == 'indisponible' ? 'selected' : '' }}>Indisponible</option>
                </select>

                {{-- Filtre type --}}
                <select name="type"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Type --</option>
                    @foreach (['apartement', 'villa', 'terrain', 'immeuble'] as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>

                {{-- Filtre option --}}
                <select name="option"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400">
                    <option value="">-- Option --</option>
                    @foreach (['vente', 'location'] as $option)
                        <option value="{{ $option }}" {{ request('option') == $option ? 'selected' : '' }}>
                            {{ ucfirst($option) }}
                        </option>
                    @endforeach
                </select>

                {{-- Bouton appliquer --}}
                <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white font-medium rounded-lg shadow hover:bg-orange-600 transition">
                    Appliquer
                </button>

                {{-- Bouton réinitialiser --}}
                <a href="{{ route('properties.mine') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Réinitialiser
                </a>
            </div>
        </form>

        {{-- 🔹 Tableau des propriétés --}}
        @if ($properties->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full border-collapse">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Ville</th>
                            <th class="px-4 py-3 text-left">Prix (FCFA)</th>
                            <th class="px-4 py-3 text-left">Surface (m²)</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($properties as $property)
                            <tr class=" hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                   <img src="{{ $property->photos->first()?->photo_path ? asset('storage/' . $property->photos->first()->photo_path) : asset('images/no-image.png') }}"
                                 alt="Image propriété"
                                 class="w-full h-16 object-cover rounded-lg mb-3">
                                </td>

                                <td class="px-4 py-3">{{ ucfirst($property->type) }}</td>
                                <td class="px-4 py-3">{{ ucfirst($property->ville) }}</td>
                                <td class="px-4 py-3">{{ number_format($property->prix, 0, ',', ' ') }}</td>
                                <td class="px-4 py-3">{{ $property->surface }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-sm rounded-full
                                        {{ $property->status === 'disponible'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('properties.show', $property->id) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">Voir</a>

                                    <a href="{{ route('properties.edit', $property->id) }}"
                                       class="text-yellow-600 hover:text-yellow-800 font-medium">Modifier</a>

                                    <form action="{{ route('properties.destroy', $property->id) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette propriété ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $properties->links() }}
            </div>

        @else
            <div class="text-center py-16 text-gray-600">
                <p class="text-lg font-medium">Vous n’avez encore ajouté aucune propriété.</p>
                <p class="text-sm mb-4">Utilisez les filtres ci-dessus ou ajoutez une nouvelle propriété.</p>
                
            </div>
        @endif
    </div>
</x-layout>

