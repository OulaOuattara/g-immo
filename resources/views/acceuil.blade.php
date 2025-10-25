<x-layout>
    <!-- === HERO SECTION === -->
    <section
        class="relative flex flex-col items-center justify-center h-[85vh] bg-cover bg-center text-white"
        style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1400&q=80');"
    >
        
        <div class="relative z-10 text-center px-6 bg-gray-500/70 rounded-lg py-8">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Trouvez le bien de vos rêves avec <br>
                <span class="text-orange-500">G-IMMO</span>
            </h1>
            <p class="text-lg md:text-2xl mb-8">
                Vente, location et gestion immobilière — votre partenaire de confiance pour tous vos projets.
            </p>
            <a href="#services"
            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition">
                Découvrez nos offres
            </a>
        </div>
    </section>

    <!-- === SERVICES SECTION === -->
    <section id="services" class="py-16 bg-gray-50 text-center">
        <h2 class="text-3xl font-bold mb-12 text-gray-900">Nos Services</h2>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-6">
            <!-- Service 1 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8">
                <div class="text-5xl mb-4">🏠</div>
                <h3 class="text-xl font-semibold mb-3 text-orange-500">Gestion Locative</h3>
                <p class="text-gray-700">
                    Confiez-nous la gestion complète de vos biens : loyers, entretien, et suivi locatif.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8">
                <div class="text-5xl mb-4">💼</div>
                <h3 class="text-xl font-semibold mb-3 text-orange-500">Vente & Achat</h3>
                <p class="text-gray-700">
                    Bénéficiez de notre expertise pour vendre ou acquérir un bien au meilleur prix.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8">
                <div class="text-5xl mb-4">🔑</div>
                <h3 class="text-xl font-semibold mb-3 text-orange-500">Location</h3>
                <p class="text-gray-700">
                    Trouvez rapidement le logement ou le local professionnel idéal pour vos besoins.
                </p>
            </div>
        </div>
    </section>

    <!-- === PROPRIÉTÉS EN VEDETTE === -->
    <section id="proprietes" class="py-16 bg-white">
        <h2 class="text-3xl font-bold mb-12 text-center text-gray-900">
            Nos Propriétés en Vedette
        </h2>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6">
            <!-- Propriété 1 -->
            <div class="rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition bg-gray-50">
                <img
                    src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=800&q=80"
                    alt="Villa Moderne"
                    class="w-full h-60 object-cover"
                />
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">
                        Villa Moderne à Ouagadougou
                    </h3>
                    <p class="text-orange-500 font-bold mb-4">120 000 000 FCFA</p>
                    <a href="#"
                    class="bg-gray-900 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                        Voir les détails
                    </a>
                </div>
            </div>

            <!-- Propriété 2 -->
            <div class="rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition bg-gray-50">
                <img
                    src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80"
                    alt="Appartement Haut Standing"
                    class="w-full h-60 object-cover"
                />
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">
                        Appartement Haut Standing
                    </h3>
                    <p class="text-orange-500 font-bold mb-4">75 000 000 FCFA</p>
                    <a href="#"
                    class="bg-gray-900 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                        Voir les détails
                    </a>
                </div>
            </div>

            <!-- Propriété 3 -->
            <div class="rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition bg-gray-50">
                <img
                    src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80"
                    alt="Maison Familiale"
                    class="w-full h-60 object-cover"
                />
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">
                        Maison Familiale à Bobo-Dioulasso
                    </h3>
                    <p class="text-orange-500 font-bold mb-4">45 000 000 FCFA</p>
                    <a href="#"
                    class="bg-gray-900 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                        Voir les détails
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout>