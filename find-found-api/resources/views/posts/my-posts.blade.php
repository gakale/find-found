<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-brown-600 to-brown-700 rounded-lg shadow-lg mb-8 p-8 text-white">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold mb-4">Mes publications</h1>
                    <p class="text-lg mb-6">Gérez vos annonces d'objets perdus, trouvés et signalements.</p>
                    <a href="{{ route('posts.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-white text-brown-600 font-medium rounded-xl shadow-lg hover:bg-brown-50 transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer une nouvelle annonce
                    </a>
                </div>
            </div>

            <!-- Liste des publications -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if($posts->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune publication</h3>
                            <p class="mt-1 text-sm text-gray-500">Commencez par créer votre première annonce.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($posts as $post)
                                <div class="bg-white border rounded-xl overflow-hidden hover:shadow-lg transition-all duration-200">
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

                                        <div class="flex items-center justify-between text-sm">
                                            <div class="flex items-center space-x-4 text-gray-500">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    {{ $post->views_count ?? 0 }}
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                    </svg>
                                                    {{ $post->comments->count() }}
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('posts.edit', $post) }}" 
                                                   class="text-brown-600 hover:text-brown-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <button onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')) { document.getElementById('delete-form-{{ $post->id }}').submit(); }" 
                                                        class="text-red-600 hover:text-red-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
