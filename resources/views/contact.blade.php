<x-layout>
<!-- Section Hero -->
<section class="relative bg-gray-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/maison5.jpeg') }}')"></div>
    <div class="relative container mx-auto px-6 py-24 text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-orange-500">Contactez G-IMMO</h1>
        <p class="text-xl max-w-2xl mx-auto">
            Une question ? Un projet immobilier ? Nous sommes à votre écoute et prêts à vous accompagner.
        </p>
    </div>
</section>

<!-- Section Coordonnées -->
<section class="py-16 bg-white text-gray-800" data-aos="fade-up">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-semibold text-center mb-12">Nos coordonnées</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-center">
            <div class="flex flex-col items-center">
                <div class="text-orange-500 text-5xl mb-4">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-orange-500">Adresse</h3>
                <p class="text-gray-600">Avenue Kwame Nkrumah,<br> Ouagadougou, Burkina Faso</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-orange-500 text-5xl mb-4">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-orange-500">Téléphone</h3>
                <p class="text-gray-600">+226 25 36 78 45<br>+226 70 12 34 56</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-orange-500 text-5xl mb-4">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-orange-500">Email</h3>
                <p class="text-gray-600">contact@g-immo.com</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-orange-500 text-5xl mb-4">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-orange-500">Horaires</h3>
                <p class="text-gray-600">Lun - Ven : 08h00 - 17h30<br>Sam : 08h00 - 12h00</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Formulaire -->
<section class=" container mx-auto py-16 bg-orange-100/50" data-aos="fade-up">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-semibold text-center mb-12">Envoyez-nous un message</h2>

        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <form action="" method="POST" class="space-y-6 w-full">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-transform duration-300 ease-in-out focus:border-none" />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse e-mail</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-transform duration-300 ease-in-out focus:border-none" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                        <input type="text" id="phone" name="phone"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-transform duration-300 ease-in-out focus:border-none" />
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Adresse</label>
                        <input type="text" id="address" name="address"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-transform duration-300 ease-in-out focus:border-none" />
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-transform duration-300 ease-in-out resize-none focus:border-none"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-lg transition-transform duration-300 ease-in-out transform hover:scale-105">
                        Envoyer le message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Section Google Maps -->
<section class="py-0" data-aos="fade-up">
    <div class="w-full h-[400px] md:h-[500px]">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63344.01076186448!2d-1.573!3d12.371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe2e95d5e6bb4abf%3A0x9e8c6f8c3e8a6d6b!2sOuagadougou!5e0!3m2!1sfr!2sbf!4v1695489987654!5m2!1sfr!2sbf" 
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
</section>
</x-layout>