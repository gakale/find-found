<div class="flex items-center space-x-2">
    <button wire:click="toggleLike" 
            class="flex items-center space-x-1 {{ $liked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }} transition-colors duration-200">
        <svg class="w-6 h-6" fill="{{ $liked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <span class="text-sm font-medium">{{ $likesCount }}</span>
    </button>
</div>
