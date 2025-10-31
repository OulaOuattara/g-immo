<x-layout>
<section class="bg-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4 lg:px-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-10 text-center">Mon profil</h1>

        {{-- ✅ Message de succès --}}
        {{-- @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg text-center mb-6">
                {{ session('success') }}
            </div>
        @endif --}}

        {{-- 🧍 Informations utilisateur --}}
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 mb-10">
                <div class="flex flex-col items-center">
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : '/images/default-avatar.webp' }}"
                         class="w-32 h-32 rounded-full object-cover  shadow-md mb-4">
                    <p class="text-gray-600 text-sm italic">
                        Membre depuis le {{ $user->created_at->format('d/m/Y') }}
                    </p>
                </div>

                <div class="flex-1 text-center md:text-left space-y-2">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ $user->name }} {{ $user->lastName }}
                    </h2>
                    <p class="text-orange-500 font-medium">
                        {{ ucfirst($user->role->name ?? 'Utilisateur') }}
                    </p>
                    <p class="text-gray-600"><i class="fas fa-envelope mr-2 text-orange-400"></i>{{ $user->email }}</p>
                    <p class="text-gray-600"><i class="fas fa-phone mr-2 text-orange-400"></i>{{ $user->phone ?? 'Non renseigné' }}</p>
                    <p class="text-gray-600"><i class="fas fa-map-marker-alt mr-2 text-orange-400"></i>{{ $user->address ?? 'Non renseignée' }}</p>
                </div>
            </div>

            <hr class="my-6 border-gray-200">

            {{-- Boutons --}}
            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10">
                <button type="button" id="editProfileBtn"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Éditer le profil
                </button>

                <button type="button" id="changePasswordBtn"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-3 rounded-lg transition">
                    Changer le mot de passe
                </button>
            </div>
        </div>
    </div>

    {{-- 🟧 MODALE ÉDITION PROFIL --}}
    <div id="editProfileModal" class="fixed inset-0 bg-gray-500/70 justify-center items-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-lg relative flex flex-col">
            <button type="button" id="closeEditModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>

            <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">Modifier le profil</h2>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="flex flex-col items-center mb-4">
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : '/images/default-avatar.webp' }}" 
                         id="profilePreview"
                         class="w-24 h-24 rounded-full object-cover mb-3">
                    {{-- <label for="photo"
                           class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded-lg cursor-pointer">
                        Changer la photo
                    </label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="previewProfile(event)"> --}}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nom</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-semibold text-gray-700 mb-1">Prénom</label>
                        <input type="text" id="lastName" name="lastName" value="{{ old('lastName', $user->lastName) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Adresse</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" id="cancelEditModal"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Annuler</button>
                    <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- 🔒 MODALE CHANGEMENT MOT DE PASSE --}}
    <div id="passwordModal" class="fixed inset-0 bg-gray-500/70 justify-center items-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative flex flex-col">
            <button type="button" id="closePasswordModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>

            <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">Changer le mot de passe</h2>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-500 outline-none focus:border-none">
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" id="cancelPasswordModal"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Annuler</button>
                    <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-700">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- JS pour gérer les modales --}}
<script>
    const editBtn = document.getElementById('editProfileBtn');
    const editModal = document.getElementById('editProfileModal');
    const closeEdit = document.getElementById('closeEditModal');
    const cancelEdit = document.getElementById('cancelEditModal');

    const passBtn = document.getElementById('changePasswordBtn');
    const passModal = document.getElementById('passwordModal');
    const closePass = document.getElementById('closePasswordModal');
    const cancelPass = document.getElementById('cancelPasswordModal');

    // 🔸 Éditer le profil
    editBtn.addEventListener('click', () => {
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');
    });
    closeEdit.addEventListener('click', closeEditModal);
    cancelEdit.addEventListener('click', closeEditModal);
    function closeEditModal() {
        editModal.classList.remove('flex');
        editModal.classList.add('hidden');
    }

    // 🔸 Changer le mot de passe
    passBtn.addEventListener('click', () => {
        passModal.classList.remove('hidden');
        passModal.classList.add('flex');
    });
    closePass.addEventListener('click', closePasswordModal);
    cancelPass.addEventListener('click', closePasswordModal);
    function closePasswordModal() {
        passModal.classList.remove('flex');
        passModal.classList.add('hidden');
    }

    // 🔹 Preview photo profil
    function previewProfile(event) {
        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById('profilePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</x-layout>
