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
                    <div class="bg-white border rounded-xl overflow-hidden hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                        <!-- Image -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            @if(!empty($post->images))
                                <img src="{{ asset('storage/' . $post->images[0]) }}" 
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

                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">
                                    {{ $post->title }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ 
                                    $post->type === 'lost' ? 'bg-red-100 text-red-800' : 
                                    ($post->type === 'found' ? 'bg-green-100 text-green-800' : 
                                    'bg-purple-100 text-purple-800') 
                                }}">
                                    {{ $post->type === 'lost' ? 'Perdu' : ($post->type === 'found' ? 'Trouvé' : 'Disparu') }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $post->description }}</p>

                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $post->views_count }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        {{ $post->comments->count() }}
                                    </div>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="inline-flex items-center text-brown-600 hover:text-brown-800">
                                    Voir plus
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
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
