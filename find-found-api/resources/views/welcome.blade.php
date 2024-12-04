@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">
                    Bienvenue sur Lost & Found
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base sm:text-lg md:mt-5 md:text-xl">
                    Retrouvez vos objets perdus ou aidez les autres à retrouver les leurs.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="{{ route('posts.create') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                            Créer une annonce
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <livewire:stats />
    </div>

    <!-- Recent Posts Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Dernières annonces</h2>
            <div class="relative">
                <select class="block appearance-none bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option>Tous les types</option>
                    <option>Objets perdus</option>
                    <option>Objets trouvés</option>
                    <option>Personnes disparues</option>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($posts as $post)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                @if($post->images && count($post->images) > 0)
                    <img class="h-48 w-full object-cover" src="{{ Storage::url($post->images[0]) }}" alt="">
                @endif
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $post->title }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ Str::limit($post->description, 100) }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->type === 'lost' ? 'bg-red-100 text-red-800' : ($post->type === 'found' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                            {{ $post->type === 'lost' ? 'Perdu' : ($post->type === 'found' ? 'Trouvé' : 'Disparu') }}
                        </span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            {{ $post->location }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection