<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    Modifier l'annonce
                </h2>

                @livewire('edit-post', ['post' => $post])
            </div>
        </div>
    </div>
</x-app-layout>
