<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Retrouvé') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased font-sans bg-gray-50">
    <!-- Hero Section -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <span class="text-2xl font-extrabold text-brown-600">Retrouvé</span>
                        <svg class="w-6 h-6 ml-2 text-brown-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </a>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:ml-10 sm:flex">
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('posts.index') ? 'border-brown-600 text-brown-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                            Annonces
                        </a>
                        @auth
                        <a href="{{ route('posts.my-posts') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('posts.my-posts') ? 'border-brown-600 text-brown-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                            Mes publications
                        </a>
                        @endauth
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                {{ Auth::user()->name }}
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                                <a href="{{ route('posts.my-posts') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Mes publications
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                        Se déconnecter
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">Se connecter</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-brown-600 hover:bg-brown-700 text-white font-medium rounded-lg transition-colors">
                            Créer mon compte
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-gray-100"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-bl from-brown-50/50 to-transparent"></div>
        
        <!-- Main Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Text Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        <span class="block">Retrouvez ce qui</span>
                        <span class="block text-brown-600">compte le plus</span>
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 max-w-2xl mx-auto lg:mx-0">
                        Notre plateforme aide à retrouver les objets perdus et, plus important encore, les personnes disparues. Chaque minute compte quand il s'agit de retrouver un être cher.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-brown-600 rounded-xl shadow-lg hover:bg-brown-700 transform hover:scale-105 transition-all duration-200">
                            Commencer maintenant
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('posts.create') }}?type=missing_person" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-red-600 rounded-xl shadow-lg hover:bg-red-700 transform hover:scale-105 transition-all duration-200">
                            Signaler une disparition
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Column - Phone Mockup -->
                <div class="relative lg:ml-10">
                    <div class="relative w-full max-w-lg mx-auto">
                        <!-- Phone Mockup -->
                        <div class="relative transform -rotate-6 translate-x-8">
                            <div class="bg-white rounded-[3rem] p-3 shadow-2xl">
                                <img src="{{ asset('images/baniere.png') }}" alt="App Screenshot" class="rounded-[2.5rem] w-full h-auto" />
                            </div>
                        </div>
                        <!-- Feature Badges -->
                        <div class="absolute -left-4 top-1/4 bg-white rounded-xl shadow-lg p-4 transform -translate-y-1/2 animate-blob">
                            <div class="text-sm font-semibold text-brown-600">Objets trouvés</div>
                        </div>
                        <div class="absolute -right-4 top-2/3 bg-white rounded-xl shadow-lg p-4 transform -translate-y-1/2 animate-blob animation-delay-2000">
                            <div class="text-sm font-semibold text-red-600">Alertes disparition</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="bg-white rounded-2xl shadow-lg backdrop-blur-lg p-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-900">{{ App\Models\Post::where('type', '!=', 'missing_person')->count() }}</div>
                            <div class="text-sm text-gray-600">Objets déclarés</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-900">{{ App\Models\Post::where('type', 'found')->count() }}</div>
                            <div class="text-sm text-green-600">Objets retrouvés</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">{{ App\Models\Post::where('type', 'missing_person')->where('status', 'active')->count() }}</div>
                            <div class="text-sm text-red-600">Personnes recherchées</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900">100%</div>
                            <div class="text-sm text-gray-600">Gratuit</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-900">Comment ça marche ?</h2>
                <p class="mt-4 text-xl text-gray-600">Un processus simple en trois étapes</p>
            </div>

            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="absolute -left-4 -top-4 w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center text-2xl font-bold text-indigo-600">1</div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-900 mt-8">Déclarez votre objet</h3>
                        <p class="mt-4 text-gray-600">Décrivez l'objet perdu ou trouvé avec le maximum de détails pour faciliter son identification.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="absolute -left-4 -top-4 w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center text-2xl font-bold text-indigo-600">2</div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-900 mt-8">Recevez des notifications</h3>
                        <p class="mt-4 text-gray-600">Notre système vous alerte automatiquement lorsqu'une correspondance est trouvée.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="absolute -left-4 -top-4 w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center text-2xl font-bold text-indigo-600">3</div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-900 mt-8">Récupérez votre objet</h3>
                        <p class="mt-4 text-gray-600">Contactez la personne concernée et organisez la récupération de l'objet en toute sécurité.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white">Prêt à retrouver vos objets perdus ?</h2>
            <p class="mt-4 text-xl text-indigo-100">Rejoignez notre communauté et commencez dès maintenant</p>
            <div class="mt-8">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-indigo-600 bg-white rounded-xl shadow-lg hover:bg-gray-50 transform hover:scale-105 transition-all duration-200">
                    Créer un compte gratuitement
                </a>
            </div>
        </div>
    </div>
</body>
</html>
