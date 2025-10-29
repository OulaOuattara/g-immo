<x-layout>
    <div class="max-w-7xl mx-auto mt-10 bg-white shadow-md rounded-xl p-6">

        {{-- ✅ Messages --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            👥 Gestion des Clients
        </h2>

        {{-- 🔍 FILTRES --}}
        <form method="GET" action="{{ route('clients.index') }}" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-3 md:space-y-0">

                {{-- Email --}}
                <div class="flex-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="text" id="email" name="email"
                        value="{{ request('email') }}"
                        placeholder="ex : client@mail.com"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none focus:border-none">
                </div>

                {{-- Téléphone --}}
                <div class="flex-1">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="text" id="phone" name="phone"
                        value="{{ request('phone') }}"
                        placeholder="ex : 70 00 00 00"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none focus:border-none">
                </div>

                {{-- Clients sans agent --}}
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="sans_agent" name="sans_agent" value="1"
                        {{ request('sans_agent') == '1' ? 'checked' : '' }}
                        class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-400">
                    <label for="sans_agent" class="text-gray-700 text-sm font-medium">Sans agent</label>
                </div>

                {{-- Boutons --}}
                <div class="flex space-x-2">
                    <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                        Appliquer
                    </button>
                    <a href="{{ route('clients.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Réinitialiser
                    </a>
                </div>
            </div>
        </form>


        {{-- Tableau responsive --}}
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg">
                <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Nom complet</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Téléphone</th>
                        <th class="px-4 py-3 text-left">Agent attribué</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($clients as $client)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $client->user->name ?? 'Non défini' }} {{ $client->user->lastName ?? '' }}</td>
                            <td class="px-4 py-3">{{ $client->user->email ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $client->user->phone ?? '—' }}</td>

                            {{-- Agent actuel --}}
                            <td class="px-4 py-3">
                                 @if ($client->agent)
                                    {{ $client->agent->user->name ?? 'Agent (nom manquant)' }}
                                    {{ $client->agent->user->lastName ?? '' }}
                                @else
                                    <span class="text-gray-400 italic">Aucun</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3 text-center space-x-2">
                                {{-- Formulaire d’attribution d’agent --}}
                                <form action="{{ route('clients.assignAgent', $client->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <select name="agent_id" class="border rounded px-2 py-1 text-sm">
                                        <option value="">Choisir un agent</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}"
                                                {{ $client->agent_id == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->user->name ?? 'Agent' }} {{ $agent->user->lastName ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="text-orange-600 hover:text-orange-800 font-medium text-sm ml-1">
                                        Attribuer
                                    </button>
                                </form>

                                {{-- Suppression --}}
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Supprimer ce client ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">
                                Aucun client enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $clients->links() }}
        </div>

    </div>
</x-layout>
