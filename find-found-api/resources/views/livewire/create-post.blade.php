<div class="max-w-2xl mx-auto">
    <form wire:submit="save" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" wire:model="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type d'annonce</label>
            <select wire:model="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="lost">Objet perdu</option>
                <option value="found">Objet trouvé</option>
            </select>
            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Images</label>
            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Télécharger des images</span>
                            <input id="images" type="file" wire:model="images" class="sr-only" multiple accept="image/*">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG jusqu'à 2MB</p>
                </div>
            </div>
            @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if(count($images) > 0)
                <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3">
                    @foreach($images as $index => $image)
                        <div class="relative">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-24 w-full object-cover rounded-lg">
                            <button type="button" wire:click="removeImage({{ $index }})" class="absolute top-0 right-0 -mt-2 -mr-2 p-1 bg-red-600 rounded-full text-white hover:bg-red-700 focus:outline-none">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
            <input type="text" wire:model="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="contact_phone" class="block text-sm font-medium text-gray-700">Téléphone de contact</label>
            <input type="tel" wire:model="contact_phone" id="contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('contact_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de contact</label>
            <input type="email" wire:model="contact_email" id="contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('contact_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="space-y-4">
            <div class="flex items-center">
                <input type="checkbox" wire:model="has_reward" id="has_reward" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <label for="has_reward" class="ml-2 block text-sm text-gray-700">Récompense proposée</label>
            </div>

            @if($has_reward)
                <div>
                    <label for="reward_amount" class="block text-sm font-medium text-gray-700">Montant de la récompense (€)</label>
                    <input type="number" wire:model="reward_amount" id="reward_amount" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('reward_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Publier l'annonce
            </button>
        </div>
    </form>
</div>
