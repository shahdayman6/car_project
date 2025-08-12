<nav class="bg-gray-950 p-4 shadow-md relative">
    <!-- ✅ الشعار واسم الموقع + بيانات المستخدم -->
    <div class="flex justify-between items-center mb-4">
        <!-- ⬅ اللوجو والاسم -->
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo3.jpg') }}" alt="Logo" class="w-20 h-20 rounded-full shadow-lg">
            <span class="text-purple-500 font-extrabold text-2xl tracking-wider">Galaxy Motors</span>
        </div>

        <!-- ➡ بيانات المستخدم -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            @auth
                <div @click="open = !open" class="cursor-pointer text-right">
                    <img 
                        src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-user-bw.png.jpg') }}" 
                        alt="User Avatar" 
                        class="w-16 h-16 rounded-full border-4 border-purple-500 shadow-xl inline-block"
                    />
                    <span class="block mt-1 text-purple-400 font-bold text-sm tracking-wide">
                        {{ Auth::user()->name }}
                    </span>
                </div>
              <!-- قائمة المستخدم -->
<div 
    x-show="open" 
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
    class="absolute right-0 mt-4 w-44 bg-gray-900/90 backdrop-blur-md border border-gray-700/50 
           rounded-2xl shadow-[0_8px_30px_rgba(128,0,128,0.4)] z-50 overflow-hidden"
>
    <a href="{{ route('profile') }}" 
       class="flex items-center gap-3 px-4 py-3 text-purple-300 hover:text-white 
              hover:bg-purple-700/50 transition-all duration-200 font-semibold">
        <span>👤</span> My Profile
    </a>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" 
            class="flex items-center gap-3 px-4 py-3 text-red-400 hover:text-white 
                   hover:bg-red-700/50 transition-all duration-200 font-semibold w-full text-left">
            <span>🚪</span> Logout
        </button>
    </form>
</div>

            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="bg-blue-700 text-white px-5 py-2 rounded-full text-lg hover:bg-blue-900 transition duration-300 shadow-md">Login</a>
                    <a href="{{ route('register') }}" class="bg-purple-700 text-white px-5 py-2 rounded-full text-lg hover:bg-purple-900 transition duration-300 shadow-md">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>