<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }} - {{ config('app.name') }}</title>

        <!-- Meta tags pour le partage social -->
        <meta property="og:title" content="{{ $post->title }}" />
        <meta property="og:description" content="{{ Str::limit(strip_tags($post->description), 200) }}" />
        @if(count($post->images) > 0)
            <meta property="og:image" content="{{ Storage::url($post->images[0]) }}" />
        @endif
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $post->title }}">
        <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->description), 200) }}">
        @if(count($post->images) > 0)
            <meta name="twitter:image" content="{{ Storage::url($post->images[0]) }}" />
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    </head>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ $post->title }}
                            </h1>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Publié {{ $post->created_at->diffForHumans() }}
                                par {{ $post->user->name }}
                            </div>
                        </div>
                        <span class="px-4 py-2 rounded-full text-sm font-semibold {{ 
                            $post->type === 'lost' ? 'bg-red-100 text-red-800' : 
                            ($post->type === 'found' ? 'bg-green-100 text-green-800' : 
                            'bg-purple-100 text-purple-800') 
                        }}">
                            {{ $post->type === 'lost' ? 'Perdu' : 
                               ($post->type === 'found' ? 'Trouvé' : 
                               'Personne disparue') }}
                        </span>
                        <!-- Boutons de partage -->
                        <div class="flex space-x-4">
                            <x-social-share 
                                :url="url()->current()"
                                :title="$post->title"
                            />
                        </div>
                    </div>

                    @if(count($post->images) > 0)
                        <div class="mb-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($post->images as $index => $image)
                                <div class="relative aspect-w-16 aspect-h-9">
                                    <img src="{{ Storage::url($image) }}" 
                                         alt="Image {{ $index + 1 }}" 
                                         class="object-cover w-full h-full rounded-lg shadow-md">
                                    
                                    <!-- Bouton pour agrandir -->
                                    <a href="{{ Storage::url($image) }}" 
                                       data-lightbox="image-{{ $index }}" 
                                       data-title="{{ $post->title }} - Image {{ $index + 1 }}"
                                       class="absolute top-2 right-2 p-2 bg-black bg-opacity-50 rounded-full hover:bg-opacity-75 transition-all duration-200">
                                        <svg class="w-6 h-6 text-white" 
                                             fill="none" 
                                             stroke="currentColor" 
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" 
                                                  stroke-linejoin="round" 
                                                  stroke-width="2" 
                                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                        </svg>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <x-google-ad slot="post-top" />

                    <div class="mt-6 prose max-w-none">
                        {!! $post->description !!}
                    </div>

                    <x-google-ad slot="post-middle" />

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h2 class="text-xl font-semibold text-gray-900">Informations</h2>
                        
                        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Lieu</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $post->location }}</dd>
                            </div>

                            @if($post->has_reward)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Récompense</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ number_format($post->reward_amount, 2) }} €</dd>
                            </div>
                            @endif

                            @if($post->contact_phone)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $post->contact_phone }}</dd>
                            </div>
                            @endif

                            @if($post->contact_email)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $post->contact_email }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-300 focus:ring ring-gray-200 disabled:opacity-25 transition">
                            Retour à la liste
                        </a>
                        
                        @if(auth()->check() && auth()->id() === $post->user_id)
                            <div class="flex space-x-2">
                                <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
                                    Modifier
                                </a>
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition">
                                    Supprimer
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="mt-12">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Commentaires</h2>
                        @livewire('comments', ['post' => $post])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-google-ad slot="post-bottom" />

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': false,
            'albumLabel': "Image %1 sur %2"
        });
    </script>
    @endpush
</x-app-layout>
