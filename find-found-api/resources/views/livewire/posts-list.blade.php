<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Filtres -->
            <div class="mb-6 flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input wire:model.live="search" type="text" placeholder="Rechercher..." 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="sm:w-48">
                    <select wire:model.live="type" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Tous les types</option>
                        <option value="lost">Objets perdus</option>
                        <option value="found">Objets trouvés</option>
                    </select>
                </div>
            </div>

            <!-- Liste des posts -->
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="bg-white border rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ $post->title }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-sm {{ $post->type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $post->type === 'lost' ? 'Perdu' : 'Trouvé' }}
                                </span>
                            </div>
                            <p class="mt-2 text-gray-600">{{ Str::limit($post->description, 150) }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <div>
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $post->location }}
                                    </div>
                                    <div>
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Voir plus
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
