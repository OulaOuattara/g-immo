<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">
            Création d’un compte Manager
        </h2>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Grille responsive : 1 colonne mobile / 2 colonnes desktop --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nom --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2" required>
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Prénom --}}
                <div>
                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                    <input type="text" name="lastName" id="lastName" value="{{ old('lastName') }}"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2" required>
                    @error('lastName')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2" required>
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Téléphone --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2">
                    @error('phone')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Adresse --}}
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2">
                    @error('address')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Rôle --}}
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                    <select name="role_id" id="role_id"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2" required>
                        <option value="">-- Sélectionnez un rôle --</option>
                        @foreach ($roles as $role)
                            <option class="hover:bg-yellow-400 hover:text-white transition-colors duration-200" value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}
                            >
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Mot de passe --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-lg border-gray-300 border-2 focus:ring-1 focus:ring-yellow-400 outline-none focus:border-none p-2" required>
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Bouton d’envoi --}}
            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                    Créer le compte
                </button>
            </div>
        </form>
    </div>
</div>
</x-layout>