<div class="p-6">
    <!-- Hero Section -->
    <div class="bg-[#6C5DD3] rounded-lg shadow-lg p-8 mb-8">
        <h1 class="text-4xl font-bold text-white mb-4">
            Bienvenue sur Lost & Found
        </h1>
        <p class="text-lg text-white/90 mb-8">
            Retrouvez vos objets perdus ou aidez les autres à retrouver les leurs.
        </p>
        <button class="inline-flex items-center px-6 py-3 bg-white text-[#6C5DD3] font-medium rounded-lg hover:bg-opacity-90 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Créer une annonce
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Objets perdus -->
        <div class="bg-white rounded-lg p-6 flex items-start space-x-4">
            <div class="p-3 rounded-full bg-blue-100">
                <svg class="w-6 h-6 text-[#6C5DD3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 text-sm font-medium">Objets perdus</h2>
                <p class="text-2xl font-bold text-[#6C5DD3]">{{ $lostItems }}</p>
            </div>
        </div>

        <!-- Objets trouvés -->
        <div class="bg-white rounded-lg p-6 flex items-start space-x-4">
            <div class="p-3 rounded-full bg-green-100">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 text-sm font-medium">Objets trouvés</h2>
                <p class="text-2xl font-bold text-green-600">{{ $foundItems }}</p>
            </div>
        </div>

        <!-- Utilisateurs actifs -->
        <div class="bg-white rounded-lg p-6 flex items-start space-x-4">
            <div class="p-3 rounded-full bg-purple-100">
                <svg class="w-6 h-6 text-[#6C5DD3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 text-sm font-medium">Utilisateurs actifs</h2>
                <p class="text-2xl font-bold text-[#6C5DD3]">{{ App\Models\User::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="flex items-center space-x-4 mb-8">
        <div class="flex-1">
            <input wire:model.debounce.300ms="search" type="text" 
                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6C5DD3] focus:border-[#6C5DD3]" 
                placeholder="Rechercher...">
        </div>
        <div>
            <select wire:model="filter" 
                class="px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#6C5DD3] focus:border-[#6C5DD3]">
                <option value="all">Tous les types</option>
                <option value="lost">Objets perdus</option>
                <option value="found">Objets trouvés</option>
                <option value="missing">Personnes disparues</option>
            </select>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="col-span-1">
            <!-- Publicité dans la barre latérale -->
            <x-google-ad :slot="config('services.google.adsense.slots.sidebar')" />
        </div>
        @foreach($recentPosts as $post)
        <div class="bg-white rounded-lg overflow-hidden">
            @if($post->images && count($post->images) > 0)
                <img class="w-full h-48 object-cover" src="{{ Storage::url($post->images[0]) }}" alt="{{ $post->title }}">
            @else
                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($post->description, 100) }}</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-[#6C5DD3] flex items-center justify-center">
                            <span class="text-white font-medium">{{ substr($post->user->name, 0, 1) }}</span>
                        </div>
                        <span class="ml-2 text-sm text-gray-600">{{ $post->user->name }}</span>
                    </div>
                    <span class="text-sm text-gray-500">{{ $post->location }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
