            {{-- 🧾 Formulaire complet des filtres --}}
            <form action="{{ route('properties.index') }}" method="GET" class="space-y-5">

                {{-- Type --}}
                <div>
                    <h4 class="font-medium text-gray-600 mb-2">Type</h4>
                    @foreach (['apartement', 'villa', 'terrain', 'immeuble'] as $type)
                        <label class="flex items-center space-x-2 text-gray-700">
                            <input type="checkbox" name="type[]" value="{{ $type }}"
                                {{ in_array($type, $filters['type'] ?? []) ? 'checked' : '' }}>
                            <span>{{ ucfirst($type) }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Usage --}}
                <div>
                    <h4 class="font-medium text-gray-600 mb-2">Usage</h4>
                    @foreach (['residence', 'commercial', 'bureau', 'agriculture', 'industriel'] as $usage)
                        <label class="flex items-center space-x-2 text-gray-700">
                            <input type="checkbox" name="usage[]" value="{{ $usage }}"
                                {{ in_array($usage, $filters['usage'] ?? []) ? 'checked' : '' }}>
                            <span>{{ ucfirst($usage) }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Option --}}
                <div>
                    <h4 class="font-medium text-gray-600 mb-2">Option</h4>
                    @foreach (['vente', 'location'] as $option)
                        <label class="flex items-center space-x-2 text-gray-700">
                            <input type="checkbox" name="option[]" value="{{ $option }}"
                                {{ in_array($option, $filters['option'] ?? []) ? 'checked' : '' }}>
                            <span>{{ ucfirst($option) }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Ville --}}
                <div>
                    <h4 class="font-medium text-gray-600 mb-2">Ville</h4>
                    <input type="text" name="ville" value="{{$filters['ville'] ?? '' }}"
                        placeholder="Ex : Ouagadougou"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400">
                </div>

                {{-- Prix max --}}
                <div>
                    <h4 class="font-medium text-gray-600 mb-2">Prix maximum</h4>
                    <input type="number" name="prix_max" value="{{ $filters['prix_max'] ?? '' }}"
                        placeholder="Ex : 100000000"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400">
                </div>

                {{-- Boutons --}}
                <div class="flex space-x-3 pt-3">
                    <button type="submit"
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg">
                        Appliquer
                    </button>
                    <a href="{{ route('properties.index',['reset' => true]) }}"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg text-center">
                        Réinitialiser
                    </a>
                </div>

            </form>