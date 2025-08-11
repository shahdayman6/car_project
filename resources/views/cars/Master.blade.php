<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://kit.fontawesome.com/yourkitcode.js" crossorigin="anonymous"></script>
    <style>
        .car-image {
            transition: opacity 1s ease-in-out;
        }
        .hover-zoom:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-black text-white font-sans">
    <div 
        x-data="{ sidebarOpen: false }" 
        @mousemove.window="
            if ($event.clientX < 30) sidebarOpen = true;
            else if ($event.clientX > 220) sidebarOpen = false;
        " 
        class="flex h-screen overflow-hidden transition-all duration-500 ease-in-out"
    >
      <!-- Sidebar -->
<aside 
    :class="sidebarOpen ? 'w-72' : 'w-0'" 
    class="bg-gradient-to-b from-gray-950 via-gray-900 to-gray-950 text-white transition-all duration-500 ease-in-out overflow-hidden shadow-[0_0_35px_rgba(0,0,0,0.6)] z-50 border-r border-gray-800"
>
    <!-- Logo / Title -->
    <div class="p-6 text-center border-b border-gray-800">
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
               class="flex items-center gap-4 px-5 py-3 bg-gray-850 hover:bg-gradient-to-r hover:from-purple-700 hover:to-pink-600 rounded-xl transition-all duration-300 group shadow-md hover:shadow-purple-500/30">
                <i class="fas fa-home text-xl group-hover:scale-125 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Home</span>
            </a>
        </li>

        <!-- Cars Dropdown -->
<li x-data="{ open: false }">
    <!-- Main Button -->
    <button @click="open = !open" 
        class="w-full flex items-center justify-between px-5 py-3 
               bg-gradient-to-r from-gray-800 to-gray-900 
               hover:from-purple-700 hover:to-pink-600
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

    <!-- Dropdown Items -->
    <ul x-show="open" x-transition class="mt-2 space-y-2">
        <li>
            <a href="{{ Auth::check() ? route('cars.request.form') : route('login') }}"
               class="flex items-center justify-between px-5 py-3 
                      bg-gradient-to-r from-gray-800 to-gray-900
                      hover:from-purple-700 hover:to-pink-600
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
                      hover:from-purple-700 hover:to-pink-600
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

        <!-- Spare Parts Dropdown -->
<li x-data="{ open: false }">
    <!-- Main Button -->
    <button @click="open = !open" 
        class="w-full flex items-center justify-between px-5 py-3 
               bg-gradient-to-r from-gray-800 to-gray-900 
               hover:from-purple-700 hover:to-pink-600
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

    <!-- Dropdown Items -->
    <ul x-show="open" x-transition class="mt-2 space-y-2">
        <li>
           <a href="{{ Auth::check() ? url('/spare-parts/buy') : route('login') }}"
              class="flex items-center justify-between px-5 py-3 
                 bg-gradient-to-r from-gray-800 to-gray-900
                 hover:from-purple-700 hover:to-pink-600
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
           <a href="{{ Auth::check() ? route('spare-parts.create') : route('login', ['redirect' => 'spare-parts.create']) }}"
             class="flex items-center justify-between px-5 py-3 
               bg-gradient-to-r from-gray-800 to-gray-900
              hover:from-purple-700 hover:to-pink-600
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
            <a href="#" 
               class="flex items-center gap-4 px-5 py-3 bg-gray-850 hover:bg-gradient-to-r hover:from-purple-700 hover:to-pink-600 rounded-xl transition-all duration-300 group shadow-md hover:shadow-purple-500/30">
                <i class="fas fa-tags text-xl group-hover:scale-110 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Offers</span>
            </a>
        </li>
    </ul>
</aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
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
                 <div x-show="open" x-transition class="absolute right-0 mt-4 w-36 bg-gray-800 text-white rounded-xl shadow-2xl z-50 p-2">
    <a href="{{ route('profile') }}" class="block w-full text-left px-4 py-2 hover:bg-blue-600 hover:text-white rounded-md transition font-semibold">
        👤 My Profile
    </a>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-600 hover:text-white rounded-md transition font-semibold">
            🚪 Logout
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

    <!-- ✅ شريط البحث -->
    <div>
        <input 
            type="text" 
            placeholder="Search by name or year..." 
            oninput="handleSearch(this.value)" 
            class="w-full px-4 py-4 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500"
        >
    </div>
</nav>

            <!-- Car Showcase -->
            <div class="p-8 flex-1 overflow-y-auto">
                <h2 class="text-3xl font-semibold mb-6">Explore Our Cars</h2>
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($cars as $index => $car)
                        <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition duration-500">
                            <div class="relative h-64 overflow-hidden group">
                              @foreach ($car['images'] as $i => $image)
    @php
        $imageFromImages = 'images/cars/' . $image;
        $imageFromStorage = $image;

        $pathInImages = public_path($imageFromImages);
        $pathInStorage = public_path($imageFromStorage);

        $finalImagePath = file_exists($pathInImages) ? asset($imageFromImages) : asset($imageFromStorage);
    @endphp

    <img 
        src="{{ $finalImagePath }}" 
        alt="{{ $car['name'] }}"
        class="absolute w-full h-full object-cover car-image car-{{ $index }}"
        style="opacity: {{ $i === 0 ? 1 : 0 }};"
    >
@endforeach
                                <button onclick="prevImage({{ $index }})" class="absolute left-2 top-1/2 -translate-y-1/2 text-white bg-purple-700 bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">‹</button>
                                <button onclick="nextImage({{ $index }})" class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-purple-700 bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">›</button>
                            </div>
                            <div class="p-4">
                                <h2 class="text-xl font-bold text-purple-400 mb-2">{{ $car['name'] }}</h2>
                                <p class="text-gray-300 mb-4">{{ $car['price'] }} $</p>
                                <p class="text-gray-400 mb-2">Year: {{ $car['year'] }}</p>
                                <a href="{{ route('cars.show', ['id' => $car->id]) }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-800 transition">
    View Details
</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const imageIndexes = Array({{ count($cars) }}).fill(0);
        const imageCounts = [
            @foreach ($cars as $car)
                {{ count($car['images']) }},
            @endforeach
        ];

        function updateImageDisplay(carIndex) {
            const images = document.querySelectorAll(`.car-${carIndex}`);
            images.forEach((img, i) => {
                img.style.opacity = (i === imageIndexes[carIndex]) ? 1 : 0;
            });
        }

        function nextImage(carIndex) {
            imageIndexes[carIndex] = (imageIndexes[carIndex] + 1) % imageCounts[carIndex];
            updateImageDisplay(carIndex);
        }

        function prevImage(carIndex) {
            imageIndexes[carIndex] = (imageIndexes[carIndex] - 1 + imageCounts[carIndex]) % imageCounts[carIndex];
            updateImageDisplay(carIndex);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const carCount = {{ count($cars) }};
            for (let i = 0; i < carCount; i++) {
                setInterval(() => nextImage(i), 2000);
            }
        });
    </script>

    <script>
    function handleSearch(query) {
        const isNumeric = /^\d+$/.test(query.trim());
        const cards = document.querySelectorAll(".grid > div");

        cards.forEach(card => {
            const name = card.querySelector("h2")?.innerText.toLowerCase();
            const year = card.querySelector("p:nth-of-type(2)")?.innerText.match(/\d{4}/)?.[0];

            if (query.trim() === "") {
                card.style.display = "block";
            } else if (isNumeric && year) {
                card.style.display = year.includes(query) ? "block" : "none";
            } else if (name) {
                card.style.display = name.includes(query.toLowerCase()) ? "block" : "none";
            } else {
                card.style.display = "none";
            }
        });
    }
</script>
</body>
</html>
