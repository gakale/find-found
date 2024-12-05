<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- En-tête avec bannière -->
            <div class="bg-gradient-to-r from-brown-600 to-brown-700 rounded-lg shadow-lg mb-8 p-8 text-white">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold mb-4">Bienvenue sur Lost & Found</h1>
                    <p class="text-lg mb-6">Retrouvez vos objets perdus ou aidez les autres à retrouver les leurs.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('posts.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white text-brown-600 font-medium rounded-xl shadow-lg hover:bg-brown-50 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Créer une annonce
                        </a>
                        <a href="{{ route('posts.create') }}?type=missing_person" 
                           class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-xl shadow-lg hover:bg-red-700 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Signaler une disparition
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="bg-white rounded-2xl shadow-lg backdrop-blur-lg p-8 mb-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900">{{ \App\Models\Post::where('type', '!=', 'missing_person')->count() }}</div>
                        <div class="text-sm text-gray-600">Objets déclarés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900">{{ \App\Models\Post::where('status', 'found')->count() }}</div>
                        <div class="text-sm text-gray-600">Objets retrouvés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600">{{ \App\Models\Post::where('type', 'missing_person')->where('status', 'active')->count() }}</div>
                        <div class="text-sm text-red-600">Personnes recherchées</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ \App\Models\Post::where('type', 'missing_person')->where('status', 'found')->count() }}</div>
                        <div class="text-sm text-green-600">Personnes retrouvées</div>
                    </div>
                </div>
            </div>

            <x-google-ad slot="top-banner" />

            @livewire('posts-list')

            <x-google-ad slot="bottom-banner" />
        </div>
    </div>
</x-app-layout>
