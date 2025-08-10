@extends('layouts.app')

@section('content')
<div 
    x-data="{ show: true }"
    class="max-w-md mx-auto p-8 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl"
    x-show="show"
    x-transition.duration.700ms
>
    {{-- Title --}}
    <h2 class="text-3xl font-extrabold mb-8 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
        Login 🔑
    </h2>

    {{-- Success or failure message --}}
    @if (session('status'))
        <div 
            x-data="{ visible: true }"
            x-show="visible"
            x-transition
            x-init="setTimeout(() => visible = false, 4000)"
            class="mb-6 p-4 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-xl shadow-lg text-center font-semibold"
        >
            ✅ {{ session('status') }}
        </div>
    @endif

    {{-- Login form --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Email Address</label>
            <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-pink-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12A4 4 0 118 12a4 4 0 018 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7m0-7H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v7a2 2 0 01-2 2h-7z" />
                </svg>
            </span>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        {{-- Password --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Password</label>
            <input type="password" name="password" required autocomplete="current-password"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
            <span class="absolute left-4 top-10 text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2v2a2 2 0 002 2h4a2 2 0 002-2v-2c0-1.105-.895-2-2-2z" />
                </svg>
            </span>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="rounded dark:bg-gray-900 border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-300">Remember Me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="text-sm text-pink-400 hover:underline">
                    Forgot your password?
                </a>
            @endif
        </div>

        {{-- Submit button --}}
        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide">
            Login 🚀
        </button>
    </form>
</div>
@endsection
