<x-public-layout title="Contact - Cap Toi M'aime">
    <!-- Hero -->
    <section class="bg-ctm-burgundy py-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-12"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <h1 class="font-display text-3xl md:text-4xl text-white uppercase">Contact</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-ctm-cream">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <!-- Contact Form -->
                <form action="mailto:hello@captoimaime.ch" method="GET" enctype="text/plain" class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Votre nom *</label>
                        <input
                            type="text"
                            name="name"
                            required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Votre email *</label>
                        <input
                            type="email"
                            name="email"
                            required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy"
                        >
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Sujet *</label>
                        <select
                            name="subject"
                            required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy"
                        >
                            <option value="">Selectionnez...</option>
                            <option value="adhesion">Question sur l'adhesion</option>
                            <option value="annuaire">Question sur l'annuaire</option>
                            <option value="professionnel">Je suis professionnel</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Votre message *</label>
                        <textarea
                            name="body"
                            rows="5"
                            required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ctm-burgundy focus:border-ctm-burgundy"
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-ctm-burgundy text-white py-3 rounded-lg font-medium hover:bg-ctm-burgundy-dark transition"
                    >
                        Envoyer
                    </button>
                </form>

                <!-- Link to main site -->
                <div class="mt-8 text-center text-gray-600 border-t pt-6">
                    <p>
                        En savoir plus sur l'association :
                        <a href="https://www.captoimaime.ch" target="_blank" class="text-ctm-burgundy font-medium hover:underline">
                            www.captoimaime.ch
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
