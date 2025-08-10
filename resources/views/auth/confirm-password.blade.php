<x-guest-layout>
    <div class="max-w-lg mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">

        {{-- العنوان --}}
        <h2 class="text-3xl font-extrabold mb-6 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
            🔒 Confirm Your Password
        </h2>

        <p class="mb-6 text-sm text-gray-300 text-center">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-purple-300 font-semibold" />
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    class="w-full pl-4 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"
                    placeholder="Enter your password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-400" />
            </div>

            <!-- Confirm Button -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide"
                >
                    Confirm
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
