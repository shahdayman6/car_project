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
    :class="sidebarOpen ? 'w-64' : 'w-0'" 
    class="bg-gray-950 text-white transition-all duration-500 ease-in-out overflow-hidden shadow-2xl z-50 border-r border-gray-800"
>
    <!-- Logo / Title -->
    <div class="p-6 text-center border-b border-gray-800">
        <div class="text-3xl font-extrabold text-purple-400 drop-shadow-lg tracking-wide">
            🚘 AutoGalaxy
        </div>
        <p class="text-sm text-gray-400 mt-1">Drive Your Dream</p>
    </div>

    <!-- Language & Dark/Light Mode Toggle -->
    <div class="p-4 space-y-6 text-lg font-medium">
        <button 
            id="lang-toggle" 
            class="px-4 py-2 w-full bg-gray-800 text-white rounded-lg hover:bg-purple-700 focus:outline-none transition duration-300"
            onclick="toggleLanguage()"
        >
            English
        </button>
        <button 
            id="theme-toggle" 
            class="px-4 py-2 w-full bg-gray-800 text-white rounded-lg hover:bg-purple-700 focus:outline-none transition duration-300"
            onclick="toggleTheme()"
        >
            Toggle Dark Mode
        </button>
    </div>

    <!-- Menu Items -->
    <ul class="p-5 space-y-4 text-lg font-medium">
        <li>
            <a href="#" class="flex items-center gap-4 px-5 py-3 bg-gray-800 hover:bg-purple-700 rounded-xl transition duration-300 group">
                <i class="fas fa-home text-xl group-hover:scale-125 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Home</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-4 px-5 py-3 bg-gray-800 hover:bg-purple-700 rounded-xl transition duration-300 group">
                <i class="fas fa-car-side text-xl group-hover:rotate-12 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">All Cars</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-4 px-5 py-3 bg-gray-800 hover:bg-purple-700 rounded-xl transition duration-300 group">
                <i class="fas fa-tools text-xl group-hover:rotate-6 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Spare Parts</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-4 px-5 py-3 bg-gray-800 hover:bg-purple-700 rounded-xl transition duration-300 group">
                <i class="fas fa-tags text-xl group-hover:scale-110 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Offers</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-4 px-5 py-3 bg-gray-800 hover:bg-purple-700 rounded-xl transition duration-300 group">
                <i class="fas fa-envelope text-xl group-hover:translate-x-1 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">Contact Us</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center gap-4 px-5 py-3 bg-gray-800 hover:bg-purple-700 rounded-xl transition duration-300 group">
                <i class="fas fa-question-circle text-xl group-hover:scale-110 transition-transform"></i>
                <span class="group-hover:tracking-wider transition-all duration-300">FAQs</span>
            </a>
        </li>
    </ul>
</aside>

<script>
    // Toggle Dark/Light Mode
    function toggleTheme() {
        const currentTheme = localStorage.getItem('theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.body.classList.toggle('dark', newTheme === 'dark');
        localStorage.setItem('theme', newTheme);
    }

    // Set initial theme on page load
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.body.classList.toggle('dark', savedTheme === 'dark');
    });

    // Toggle language (English / Arabic)
    function toggleLanguage() {
        const currentLang = localStorage.getItem('lang');
        const newLang = currentLang === 'ar' ? 'en' : 'ar';
        localStorage.setItem('lang', newLang);
        updateLanguage(newLang);
    }

    function updateLanguage(lang) {
        //const langText = lang === 'ar' ? 'العربية' : 'English';
        const themeText = lang === 'ar' ? 'تبديل الوضع المظلم' : 'Toggle Dark Mode';
        const menuItems = document.querySelectorAll('ul li a span');
        menuItems.forEach(item => {
           // item.textContent = lang === 'ar' ? item.textContent.replace(/Home/, 'الصفحة الرئيسية').replace(/All Cars/, 'جميع السيارات').replace(/Spare Parts/, 'قطع الغيار').replace(/Offers/, 'العروض').replace(/Contact Us/, 'اتصل بنا').replace(/FAQs/, 'الأسئلة الشائعة') : item.textContent;
        });
        document.querySelector('#lang-toggle').textContent = langText;
        document.querySelector('#theme-toggle').textContent = themeText;
    }

    // Set initial language on page load
    document.addEventListener('DOMContentLoaded', () => {
        const savedLang = localStorage.getItem('lang') || 'en';
        updateLanguage(savedLang);
    });
</script>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Navbar -->
           <nav class="bg-gray-950 p-4 flex items-center shadow-md relative">
    <h1 class="absolute left-1/2 transform -translate-x-1/2 text-3xl font-extrabold text-purple-400 tracking-widest drop-shadow-lg">
        🚙 AutoGalaxy
    </h1>

    <div class="ml-auto space-x-4 flex items-center">
        @auth
            <span class="text-white text-lg font-medium">{{ Auth::user()->name }}</span>
            <img src="https://i.pravatar.cc/40" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-white">
        @else
            <a href="/login" class="bg-blue-700 text-white px-5 py-2 rounded-full text-lg hover:bg-blue-900 transition duration-300 shadow-md">Login</a>
           <a href="{{ url('register') }}" class="bg-purple-700 text-white px-5 py-2 rounded-full text-lg hover:bg-purple-900 transition duration-300 shadow-md">Register</a>
        @endauth
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
                                    <img 
                                        src="{{ asset('images/cars/' . '/' . $image) }}" 
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
                                <p class="text-gray-300 mb-4">{{ $car['price'] }}</p>
                                <a href="#" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-800 transition">View Details</a>
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
</body>
</html>
