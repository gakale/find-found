<div class="space-y-6">
    @auth
        <div>
            <form wire:submit="addComment" class="space-y-4">
                <div>
                    <label for="content" class="sr-only">Votre commentaire</label>
                    <textarea wire:model="content" id="content" rows="3" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                              placeholder="Ajouter un commentaire..."></textarea>
                    @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
                        Commenter
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="rounded-md bg-blue-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1 md:flex md:justify-between">
                    <p class="text-sm text-blue-700">
                        Connectez-vous pour ajouter un commentaire
                    </p>
                    <p class="mt-3 text-sm md:mt-0 md:ml-6">
                        <a href="{{ route('login') }}" class="whitespace-nowrap font-medium text-blue-700 hover:text-blue-600">
                            Se connecter <span aria-hidden="true">&rarr;</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    @endauth

    <div class="space-y-4">
        @forelse($comments as $comment)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-start">
                    <div class="flex items-center space-x-2">
                        <div class="font-medium text-gray-900">{{ $comment->user->name }}</div>
                        <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>

                    @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->id() === $post->user_id))
                        <button wire:click="deleteComment({{ $comment->id }})" class="text-gray-400 hover:text-red-500" title="Supprimer">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    @endif
                </div>

                <div class="mt-2 text-gray-700">
                    {{ $comment->content }}
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">
                Aucun commentaire pour le moment
            </div>
        @endforelse

        {{ $comments->links() }}
    </div>
</div>
