<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-2xl font-bold text-center mb-8">Inscription</h2>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex flex-col space-y-4">
                    <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        S'inscrire
                    </button>
                    
                    <a href="{{ route('login') }}" class="text-center text-sm text-gray-600 hover:text-gray-900">
                        Déjà un compte ? Se connecter
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
