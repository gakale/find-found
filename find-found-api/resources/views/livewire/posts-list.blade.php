<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Filtres -->
            <div class="mb-6 flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input wire:model.live="search" type="text" placeholder="Rechercher..." 
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-brown-300 focus:ring focus:ring-brown-200 focus:ring-opacity-50">
                </div>
                <div class="sm:w-48">
                    <select wire:model.live="type" 
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-brown-300 focus:ring focus:ring-brown-200 focus:ring-opacity-50">
                        <option value="">Tous les types</option>
                        <option value="lost">Objets perdus</option>
                        <option value="found">Objets trouvés</option>
                        <option value="missing_person">Personnes disparues</option>
                    </select>
                </div>
            </div>

            <!-- Liste des posts -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    @if($loop->iteration % 6 == 0)
                        <div class="col-span-full">
                            <x-google-ad slot="in-feed" />
                        </div>
                    @endif

                    <div class="bg-white border rounded-xl overflow-hidden hover:shadow-lg transition-all duration-200">
                        <!-- Image -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            @if(!empty($post->images))
                                <img src="{{ Storage::url($post->images[0]) }}" 
                                     alt="{{ $post->title }}"
                                     class="object-cover w-full h-48">
                            @else
                                <div class="flex items-center justify-center h-48 bg-gray-100">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Contenu -->
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ 
                                    $post->type === 'lost' ? 'bg-red-100 text-red-800' : 
                                    ($post->type === 'found' ? 'bg-green-100 text-green-800' : 
                                    'bg-purple-100 text-purple-800') 
                                }}">
                                    {{ $post->type === 'lost' ? 'Perdu' : 
                                       ($post->type === 'found' ? 'Trouvé' : 
                                       'Personne disparue') }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <a href="{{ route('posts.show', $post) }}" class="block mt-1">
                                <h2 class="text-xl font-semibold text-gray-900 hover:text-brown-600">{{ $post->title }}</h2>
                            </a>
                            <p class="mt-2 text-gray-600 line-clamp-3">{{ Str::limit($post->description, 150) }}</p>
                            
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $post->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
