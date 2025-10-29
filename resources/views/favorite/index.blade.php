<x-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white rounded-2xl shadow-lg p-8">

        @if ($favorites->isEmpty())
            <p class="text-gray-600 text-center">Vous n’avez encore ajouté aucune propriété en favori.</p>
        @else
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($favorites as $favorite)
                    @php
                        $property = $favorite->property;
                        $photo = $property?->photos->first();
                    @endphp

                    @if ($property)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3">
                            <img src="{{ $photo ? asset('storage/' . $photo->photo_path) : asset('images/no-image.png') }}"
                                 alt="Image propriété"
                                 class="w-full h-48 object-cover rounded-lg mb-3">
                            <h3 class="font-semibold text-lg text-gray-800">{{ ucfirst($property->type) }}</h3>
                            <p class="text-gray-600">{{ $property->ville }}</p>
                            <p class="text-orange-600 font-bold">{{ number_format($property->prix, 0, ',', ' ') }} FCFA</p>

                            <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 text-red-500 hover:text-red-700">
                                    Retirer
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
