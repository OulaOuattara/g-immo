<x-layout>
    <!-- Section Hero -->
    <section class="relative bg-gray-700 text-white overflow-hidden" >
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/Herro-g-immo.jpg') }}');"></div>
        <div class="relative container mx-auto px-6 py-24 text-center bg-gray-700/60" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-orange-500">À propos de G-IMMO</h1>
            <p class="text-2xl max-w-2xl mx-auto text-gray-100">
                Votre partenaire de confiance dans la gestion immobilière moderne et responsable.
            </p>
        </div>
    </section>

    <!-- Section Qui sommes-nous -->
    <section class="py-16 bg-white text-gray-800" data-aos="fade-right">
        <div class="container mx-auto px-6 text-center md:text-left">
            <h2 class="text-3xl font-semibold mb-6 border-l-4 border-orange-500 pl-4 inline-block">Qui sommes-nous ?</h2>
            <p class="text-lg leading-relaxed max-w-3xl mx-auto md:mx-0">
                <strong>G-IMMO</strong> est une agence de gestion immobilière moderne qui accompagne propriétaires et locataires 
                à chaque étape de leurs projets. Notre mission : offrir une expérience immobilière simple, transparente et humaine.
                Nous combinons expertise, technologie et proximité pour garantir la satisfaction de nos clients.
            </p>
        </div>
    </section>

    <!-- Section Nos valeurs -->
    <section class="py-16 bg-gray-100" data-aos="fade-up">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center mb-12">Nos valeurs</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $valeurs = [
                        ['icon' => '🏠', 'titre' => 'Confiance', 'texte' => 'Nous plaçons la confiance au cœur de chaque relation avec nos clients et partenaires.'],
                        ['icon' => '💡', 'titre' => 'Innovation', 'texte' => 'Nous exploitons les technologies modernes pour simplifier la gestion immobilière.'],
                        ['icon' => '🤝', 'titre' => 'Proximité', 'texte' => 'Nous accompagnons nos clients avec écoute et réactivité à chaque étape de leur projet.'],
                        ['icon' => '🌿', 'titre' => 'Responsabilité', 'texte' => 'Nous promouvons une gestion durable et respectueuse de l’environnement.'],
                    ];
                @endphp
                @foreach($valeurs as $index => $valeur)
                    <div class="rounded-2xl overflow-hidden bg-white shadow-md transition duration-500 delay-105 ease-in-out hover:scale-105 hover:-translate-y-2 hover:shadow-xl"
                        ">
                        <!-- En-tête coloré -->
                        <div class="bg-orange-500 text-white py-4 text-4xl text-center">
                            {{ $valeur['icon'] }}
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $valeur['titre'] }}</h3>
                            <p class="text-gray-600">{{ $valeur['texte'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section Mission & Vision -->
    <section class="py-16 bg-white" data-aos="fade-left">
        <div class="container mx-auto px-6 text-center md:text-left">
            <h2 class="text-3xl font-semibold mb-6 border-l-4 border-orange-500 pl-4 inline-block">Notre mission & vision</h2>
            <p class="text-lg leading-relaxed max-w-3xl mx-auto md:mx-0">
                Chez <strong>G-IMMO</strong>, nous croyons que chaque bien immobilier mérite une gestion rigoureuse et humaine.  
                Notre vision est de bâtir un écosystème où la transparence, la confiance et l’efficacité deviennent les piliers 
                d’un marché immobilier durable et accessible à tous.
            </p>
        </div>
    </section>

    <!-- Section Notre équipe -->
    <section class="py-16 bg-gray-100" data-aos="fade-up">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center mb-12">Notre équipe</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                @php
                    $equipe = [
                        ['img' => '/images/yves.png', 'nom' => 'Yves BARRO', 'poste' => 'manager', 'desc' => 'Dirige l’équipe et veille à la qualité du service client.'],
                        ['img' => '/images/emmanuel.jpg', 'nom' => 'Oula Emmanuel OUATTARA', 'poste' => 'Agent Immobilier', 'desc' => 'Spécialiste du conseil et du suivi des transactions immobilières.'],
                        ['img' => '/images/rego_boss.png', 'nom' => 'Registre BASSOLE', 'poste' => 'Chargé de Gestion', 'desc' => 'Assure la coordination et la transparence dans la gestion locative.'],
                    ];
                @endphp

                @foreach($equipe as $index => $membre)
                    <article
                        class="rounded-2xl overflow-visible shadow-md transform hover:scale-105 hover:-translate-y-2 hover:shadow-xl bg-white transition duration-500 delay-105 ease-in-out"
                        
                    >
                        <!-- En-tête coloré -->
                        <div class="rounded-t-2xl bg-linear-to-r from-orange-500/95 to-orange-400/90 p-4 flex justify-center relative">
                            <img src="{{ $membre['img'] }}"
                                alt="{{ $membre['nom'] }}"
                                class="w-24 h-24 md:w-28 md:h-28 rounded-full object-cover border-4 border-white absolute -bottom-12 shadow-lg">
                        </div>

                        <!-- Corps de la carte -->
                        <div class="p-8 pt-16 text-center">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900 leading-tight">{{ $membre['nom'] }}</h3>
                            <p class="text-orange-500 font-medium mt-1 mb-3">{{ $membre['poste'] }}</p>
                            <p class="text-sm text-gray-600">{{ $membre['desc'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>