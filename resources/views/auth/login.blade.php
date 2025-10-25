<x-layout>

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center px-4">
    <div class="flex flex-col md:flex-row bg-white shadow-2xl rounded-2xl overflow-hidden max-w-4xl w-full">

        {{-- IMAGE D’ILLUSTRATION --}}
        <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/Herro-g-immo.jpg') }}');">
        </div>

        {{-- FORMULAIRE DE CONNEXION --}}
        <div class="w-full md:w-1/2 p-8 md:p-10">
            {{-- Logo --}}
            <div class="flex justify-center mb-6">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-yellow-500 text-white font-bold rounded-full flex items-center justify-center text-xl">
                        G
                    </div>
                    <h1 class="text-2xl font-extrabold text-gray-800">G-IMMO</h1>
                </div>
            </div>

            {{-- Titre --}}
            <h2 class="text-xl md:text-2xl font-bold text-center mb-2 text-gray-700">
                Connexion à votre espace
            </h2>
            <p class="text-center text-gray-500 mb-8">
                Gérez vos biens et vos agents facilement.
            </p>

            {{-- Formulaire --}}
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1 font-medium">Adresse e-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border-gray-300 rounded-lg p-3 border focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="exemple@mail.com" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1 font-medium">Mot de passe</label>
                    <input type="password" name="password"
                        class="w-full border-gray-300 rounded-lg p-3 border focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        placeholder="••••••••" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bouton --}}
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 transition text-white font-semibold py-3 rounded-lg shadow">
                    Se connecter
                </button>

                {{-- Lien vers l'inscription --}}
                <p class="text-center text-sm text-gray-600 mt-6">
                    Vous n'avez pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-yellow-600 font-medium hover:underline">
                        Créer un compte visiteur
                    </a>
                </p>
            </form>

            {{-- Slogan --}}
            <div class="text-center mt-8 text-gray-500 text-sm">
                <p>© {{ date('Y') }} G-IMMO. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</div>
</x-layout>