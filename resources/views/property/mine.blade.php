<x-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3 text-center">
            Mes propriétés
        </h2>

        @if ($properties->count())
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-orange-500 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Usage</th>
                            <th class="px-4 py-3 text-left">Ville</th>
                            <th class="px-4 py-3 text-left">Prix (FCFA)</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @foreach ($properties as $index => $property)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 capitalize">{{ $property->type }}</td>
                                <td class="px-4 py-3 capitalize">{{ $property->usage }}</td>
                                <td class="px-4 py-3">{{ $property->ville }}</td>
                                <td class="px-4 py-3 font-semibold text-orange-600">
                                    {{ number_format($property->prix, 0, ',', ' ') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-sm font-medium
                                        {{ $property->status === 'disponible' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 flex justify-center space-x-2">
                                    <a href="{{ route('properties.show', $property->id) }}"
                                       class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-sm">
                                        Voir
                                    </a>
                                    <a href="{{ route('properties.edit', $property->id) }}"
                                       class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">
                                        Modifier
                                    </a>
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette propriété ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-sm">
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
            <div class="mt-6 flex justify-center">
                {{ $properties->links() }}
            </div>

        @else
            <div class="text-center py-20 text-gray-600">
                <p class="text-lg font-medium">Aucune propriété trouvée</p>
                <p class="text-sm">Vous n’avez encore ajouté aucune propriété.</p>
            </div>
        @endif

        {{-- Bouton retour --}}
        <div class="mt-6 text-center">
            <a href="{{ route('properties.index') }}"
               class="inline-block px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">
                Retour à la liste publique
            </a>
        </div>
    </div>
</x-layout>
