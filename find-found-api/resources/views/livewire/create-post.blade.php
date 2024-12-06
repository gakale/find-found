<div class="max-w-2xl mx-auto">
    <form wire:submit="save" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" wire:model="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type d'annonce</label>
            <select wire:model.live="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="lost">Objet perdu</option>
                <option value="found">Objet trouvé</option>
                <option value="missing_person">Personne disparue</option>
            </select>
            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if($type !== 'missing_person')
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select wire:model="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Sélectionner une catégorie...</option>
                    <option value="electronics">Électronique</option>
                    <option value="jewelry">Bijoux</option>
                    <option value="documents">Documents</option>
                    <option value="clothing">Vêtements</option>
                    <option value="accessories">Accessoires</option>
                    <option value="pets">Animaux</option>
                    <option value="keys">Clés</option>
                    <option value="wallet">Portefeuille/Sac</option>
                    <option value="other">Autre</option>
                </select>
                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="datetime-local" wire:model="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700">Images ({{ count($images) }}/3)</label>
            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="newImage" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Télécharger des images</span>
                            <input type="file" wire:model="newImage" id="newImage" class="sr-only" accept="image/*" {{ count($images) >= 3 ? 'disabled' : '' }}>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 2MB</p>
                </div>
            </div>
            @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @error('images') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if (count($images) > 0)
                <div class="mt-4 grid grid-cols-2 gap-4">
                    @foreach($images as $index => $image)
                        <div class="relative">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-24 w-full object-cover rounded">
                            <button type="button" wire:click="removeImage({{ $index }})" class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @if($type === 'missing_person')
            <div class="space-y-6 bg-red-50 p-6 rounded-lg border border-red-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="person_name" class="block text-sm font-medium text-gray-700">Nom de la personne</label>
                        <input type="text" wire:model="person_name" id="person_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('person_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="person_age" class="block text-sm font-medium text-gray-700">Âge</label>
                        <input type="number" wire:model="person_age" id="person_age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('person_age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="person_gender" class="block text-sm font-medium text-gray-700">Genre</label>
                        <select wire:model="person_gender" id="person_gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sélectionner...</option>
                            <option value="male">Masculin</option>
                            <option value="female">Féminin</option>
                            <option value="other">Autre</option>
                        </select>
                        @error('person_gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="person_height" class="block text-sm font-medium text-gray-700">Taille (optionnel)</label>
                        <input type="text" wire:model="person_height" id="person_height" placeholder="ex: 1m75" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('person_height') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="person_weight" class="block text-sm font-medium text-gray-700">Poids (optionnel)</label>
                        <input type="text" wire:model="person_weight" id="person_weight" placeholder="ex: 70kg" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('person_weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="last_seen_date" class="block text-sm font-medium text-gray-700">Date de dernière vue</label>
                        <input type="datetime-local" wire:model="last_seen_date" id="last_seen_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('last_seen_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="last_seen_location" class="block text-sm font-medium text-gray-700">Lieu de dernière vue</label>
                    <input type="text" wire:model="last_seen_location" id="last_seen_location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('last_seen_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="clothes_worn" class="block text-sm font-medium text-gray-700">Vêtements portés</label>
                    <textarea wire:model="clothes_worn" id="clothes_worn" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    @error('clothes_worn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="distinctive_features" class="block text-sm font-medium text-gray-700">Signes distinctifs</label>
                    <textarea wire:model="distinctive_features" id="distinctive_features" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    @error('distinctive_features') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="person_description" class="block text-sm font-medium text-gray-700">Description supplémentaire (optionnel)</label>
                    <textarea wire:model="person_description" id="person_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    @error('person_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="police_report_number" class="block text-sm font-medium text-gray-700">Numéro de rapport de police (optionnel)</label>
                    <input type="text" wire:model="police_report_number" id="police_report_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('police_report_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="is_urgent" id="is_urgent" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                    <label for="is_urgent" class="ml-2 block text-sm text-red-700">Cas urgent</label>
                </div>
            </div>
        @endif

        <div class="space-y-6">
            <div>
                <label for="contact_phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                <input type="tel" wire:model="contact_phone" id="contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('contact_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="contact_email" class="block text-sm font-medium text-gray-700">Email (optionnel)</label>
                <input type="email" wire:model="contact_email" id="contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('contact_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" wire:model="has_reward" id="has_reward" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="has_reward" class="ml-2 block text-sm text-gray-700">Proposer une récompense</label>
                </div>

                @if($has_reward)
                    <div>
                        <label for="reward_amount" class="block text-sm font-medium text-gray-700">Montant de la récompense</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" wire:model="reward_amount" id="reward_amount" class="pl-7 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="0.00" step="0.01" min="0">
                        </div>
                        @error('reward_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif
            </div>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
            <input type="text" wire:model="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex justify-end">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Publier l'annonce
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-validation-errors', ({errors}) => {
                let errorMessage = 'Veuillez corriger les erreurs suivantes :\n';
                for (let field in errors) {
                    errorMessage += `- ${errors[field]}\n`;
                }
                alert(errorMessage);
            });
        });
    </script>
</div>
