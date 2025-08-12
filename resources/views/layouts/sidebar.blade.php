<style>
    /* الحالة العادية: مخفي */
    .sidebar {
        width: 0;
        transition: width 0.5s ease-in-out;
        overflow: hidden;
    }

    /* عند المرور بالماوس */
    .sidebar:hover {
        width: 18rem; /* نفس w-72 */
    }
</style>
<aside 
    class="sidebar bg-gradient-to-b from-gray-950 via-gray-900 to-gray-950 text-white transition-all duration-500 ease-in-out overflow-hidden shadow-[0_0_35px_rgba(0,0,0,0.6)] z-50 border-r border-gray-800"
>

    <!-- Logo / Title -->
    <div class="p-6 text-center border-b border-gray-800 relative">
        <!-- Close button (mobile) -->
        <button @click="sidebarOpen = false" 
                class="absolute top-4 right-4 text-gray-400 hover:text-white md:hidden transition-colors">
            <i class="fas fa-times text-lg"></i>
        </button>

        <div class="text-3xl font-extrabold bg-gradient-to-r from-purple-400 to-pink-500 bg-clip-text text-transparent drop-shadow-lg tracking-wide">
            🚘 Galaxy Motors
        </div>
        <p class="text-sm text-gray-400 mt-1 italic">Drive Your Dream</p>
    </div>

    <!-- Menu Items -->
    <ul class="p-5 space-y-4 text-lg font-medium">
        <!-- Home -->
        <li>
            <a href="{{ route('home') }}" 
               class="flex items-center gap-4 px-5 py-3 bg-gray-850 hover:bg-gradient-to-r hover:from-purple-600 hover:to-pink-500 rounded-xl transition-all duration-300 group shadow-md hover:shadow-purple-500/30">
                <i class="fas fa-home text-xl group-hover:scale-125 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Home</span>
            </a>
        </li>

        <!-- Cars Dropdown -->
        <li x-data="{ open: false }">
            <button @click="open = !open" 
                class="w-full flex items-center justify-between px-5 py-3 
                       bg-gradient-to-r from-gray-800 to-gray-900 
                       hover:from-purple-600 hover:to-pink-500
                       rounded-xl transition-all duration-300 
                       shadow-md hover:shadow-purple-500/40 
                       group">
                <div class="flex items-center gap-4">
                    <i class="fas fa-car text-xl transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="group-hover:tracking-wider transition-all duration-300">Cars</span>
                </div>
                <i :class="open ? 'fas fa-chevron-up rotate-180' : 'fas fa-chevron-down'"
                   class="transition-transform duration-300 ease-in-out"></i>
            </button>
            <ul x-show="open" x-transition class="mt-2 space-y-2 pl-3">
                <li>
                    <a href="{{ Auth::check() ? route('cars.request.form') : route('login') }}"
                       class="flex items-center justify-between px-5 py-3 
                              bg-gradient-to-r from-gray-800 to-gray-900
                              hover:from-purple-600 hover:to-pink-500
                              rounded-xl transition-all duration-300 
                              shadow-md hover:shadow-purple-500/40">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-shopping-cart text-lg"></i>
                            <span>Buy a Car</span>
                        </div>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ Auth::check() ? route('cars.create') : route('login') }}"
                       class="flex items-center justify-between px-5 py-3 
                              bg-gradient-to-r from-gray-800 to-gray-900
                              hover:from-purple-600 hover:to-pink-500
                              rounded-xl transition-all duration-300 
                              shadow-md hover:shadow-purple-500/40">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-tags text-lg"></i>
                            <span>Sell a Car</span>
                        </div>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Rent Cars -->
        <li>
            <a href="{{ Auth::check() ? route('rentals.index') : route('login') }}"
               class="flex items-center justify-between px-5 py-3 
                      bg-gradient-to-r from-gray-800 to-gray-900
                      hover:from-indigo-600 hover:to-purple-500
                      rounded-xl transition-all duration-300 
                      shadow-md hover:shadow-indigo-500/40">
                <div class="flex items-center gap-4">
                    <i class="fas fa-car-side text-lg"></i>
                    <span>Rent Cars</span>
                </div>
                <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </li>

        <!-- Spare Parts Dropdown -->
        <li x-data="{ open: false }">
            <button @click="open = !open" 
                class="w-full flex items-center justify-between px-5 py-3 
                       bg-gradient-to-r from-gray-800 to-gray-900 
                       hover:from-purple-600 hover:to-pink-500
                       rounded-xl transition-all duration-300 
                       shadow-md hover:shadow-purple-500/40 
                       group">
                <div class="flex items-center gap-4">
                    <i class="fas fa-cogs text-xl transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="group-hover:tracking-wider transition-all duration-300">Spare Parts</span>
                </div>
                <i :class="open ? 'fas fa-chevron-up rotate-180' : 'fas fa-chevron-down'"
                   class="transition-transform duration-300 ease-in-out"></i>
            </button>
            <ul x-show="open" x-transition class="mt-2 space-y-2 pl-3">
                <li>
                   <a href="{{ Auth::check() ? url('/spare-parts/buy') : route('login') }}"
                      class="flex items-center justify-between px-5 py-3 
                             bg-gradient-to-r from-gray-800 to-gray-900
                             hover:from-purple-600 hover:to-pink-500
                             rounded-xl transition-all duration-300 
                             shadow-md hover:shadow-purple-500/40">
                     <div class="flex items-center gap-4">
                       <i class="fas fa-shopping-cart text-lg"></i>
                       <span>Buy Spare Parts</span>
                     </div>
                       <i class="fas fa-arrow-right text-sm"></i>
                   </a>
                </li>
                <li>
                   <a href="{{ Auth::check() ? route('spare-parts.create') : route('login') }}"
                     class="flex items-center justify-between px-5 py-3 
                            bg-gradient-to-r from-gray-800 to-gray-900
                            hover:from-purple-600 hover:to-pink-500
                            rounded-xl transition-all duration-300 
                            shadow-md hover:shadow-purple-500/40">
                        <div class="flex items-center gap-4">
                            <i class="fas fa-tags text-lg"></i>
                            <span>Sell Spare Parts</span>
                        </div>
                        <i class="fas fa-arrow-right text-sm"></i>
                   </a>
                </li>
            </ul>
        </li>

        <!-- Offers -->
        <li>
            <a href="{{ route('complaints.index') }}" 
              class="flex items-center gap-4 px-5 py-3 bg-gray-850 hover:bg-gradient-to-r hover:from-purple-700 hover:to-pink-600 rounded-xl transition-all duration-300 group shadow-md hover:shadow-purple-500/30">
                <i class="fas fa-tags text-xl group-hover:scale-110 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Complaints</span>
            </a>
        </li>
     @if(Auth::check())
<li>
    <a href="{{ route('chat.show', ['receiver' => Auth::id()]) }}" 
      class="flex items-center gap-4 px-5 py-3 bg-gray-850 hover:bg-gradient-to-r hover:from-purple-700 hover:to-pink-600 rounded-xl transition-all duration-300 group shadow-md hover:shadow-purple-500/30">
        <i class="fas fa-comments text-xl group-hover:scale-110 transition-transform"></i>
        <span class="group-hover:tracking-wider transition-all duration-300">Chat</span>
    </a>
</li>
@endif




    </ul>
</aside>
