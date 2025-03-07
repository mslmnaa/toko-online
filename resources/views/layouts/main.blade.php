<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Geraimu - Experience premium coffee in an elegant setting. Browse our menu, order online, and discover our story.">
    <meta name="theme-color" content="#1a472a">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Geraimu - Your Elegant Coffee Experience')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-sA+O9Va5TFidnHFLNLA4v5mZRrL7kz9me8iM9rsLPoo=" crossorigin=""/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-o9Nn8+HqUv8OgUT1jGJ93cn2DYkzC7cr+2Wyr4dA95I=" crossorigin=""></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-93e82042.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-4c1a4052.css') }}"> --}}

    <script type="module" src="{{ asset('build/assets/app-a5e28c11.js') }}"></script>
    
    
    <style>
        [x-cloak] { 
            display: none !important; 
        }
    </style>
</head>
<body class="font-sans bg-gray-50 text-gray-800 min-h-screen flex flex-col antialiased selection:bg-primary-200 selection:text-primary-900">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-primary-800">
        Skip to main content
    </a>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-gradient-to-b from-black/70 to-transparent backdrop-blur-sm supports-[backdrop-filter]:bg-black/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo section -->
                <div class="flex items-center">
                    <a href="/" class="group flex items-center space-x-3 hover:opacity-90 transition-all duration-300" aria-label="Geraimu Home">
                        <img src="/img/logo.png" alt="" class="h-12 w-auto transform group-hover:scale-105 transition-transform duration-300">
                        <span class="text-2xl font-bold tracking-tight text-white group-hover:text-primary-200">Geraimu</span>
                    </a>
                </div>


                <!-- Mobile menu button -->
                <div class="flex md:hidden items-center">
                    <button 
                        id="mobile-menu-button" 
                        class="relative text-white p-2 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Toggle menu"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path class="origin-center transition-all" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @php
                        $navItems = [
                            ['route' => '/', 'name' => 'Home'],
                            ['route' => '/menu', 'name' => 'Menu'],
                            ['route' => '/about', 'name' => 'About'],
                            ['route' => '/contact', 'name' => 'Contact'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a 
                            href="{{ $item['route'] }}" 
                            class="group relative text-white hover:text-primary-200 transition-colors duration-200 font-medium"
                            @if(request()->is(trim($item['route'], '/')))
                                aria-current="page"
                            @endif
                        >
                            {{ $item['name'] }}
                            <span class="absolute inset-x-0 -bottom-1 h-0.5 bg-primary-400 scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                        </a>
                    @endforeach

                   <!-- Cart with animation -->
                    <a href="{{ route('cart.index') }}" class="group relative text-white hover:text-primary-200 transition-colors duration-200 font-medium">
                        <span class="flex items-center">
                            <svg class="w-6 h-6 mr-2 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Cart ({{ count(session('cart', [])) }})
                        </span>
                    </a>

                    <!-- Auth links -->
                    @auth
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button 
                                @click="open = !open" 
                                class="flex items-center text-white hover:text-primary-200 transition-colors duration-200 font-medium focus:outline-none focus:ring-2 focus:ring-white/50 rounded-lg px-3 py-2"
                                :aria-expanded="open"
                            >
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-5 w-5 transform transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div 
                                x-show="open" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5"
                            >
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="#" onclick="showLoginModal()" class="text-white hover:text-primary-200 transition-colors duration-200 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-white text-primary-800 px-6 py-2.5 rounded-full hover:bg-primary-50 transition-all duration-300 font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Register</a>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white/90 backdrop-blur-sm rounded-xl shadow-lg mt-2">
                    @foreach($navItems as $item)
                        <a 
                            href="{{ $item['route'] }}" 
                            class="block px-4 py-2.5 rounded-lg text-gray-800 hover:bg-primary-50 hover:text-primary-800 transition-colors duration-200"
                            @if(request()->is(trim($item['route'], '/')))
                                aria-current="page"
                            @endif
                        >
                            {{ $item['name'] }}
                        </a>
                    @endforeach

                    <a href="{{ route('cart.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-gray-800 hover:bg-primary-50 hover:text-primary-800 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Cart ({{ count(session('cart', [])) }})
                    </a>

                    @auth
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 rounded-lg text-gray-800 hover:bg-primary-50 hover:text-primary-800 transition-colors duration-200">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-gray-800 hover:bg-primary-50 hover:text-primary-800 transition-colors duration-200">Logout</button>
                        </form>
                    @else
                        <a href="#" onclick="showLoginModal()" class="block px-4 py-2.5 rounded-lg text-gray-800 hover:bg-primary-50 hover:text-primary-800 transition-colors duration-200">Login</a>
                        <a href="{{ route('register') }}" class="block mx-4 my-2 text-center bg-primary-800 text-white px-6 py-2.5 rounded-lg hover:bg-primary-700 transition-colors duration-200 font-semibold shadow-md">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer with improved layout -->
    <footer class="bg-primary-900 text-white py-16 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="/" class="inline-block group">
                        <div class="flex items-center space-x-3 mb-6">
                            <img src="/img/logo.png" alt="" class="h-12 w-auto">
                            <span class="text-2xl font-bold tracking-tight group-hover:text-primary-200 transition-colors duration-200">Geraimu</span>
                        </div>
                    </a>
                    <p class="text-gray-300 max-w-md">Your elegant corner for premium coffee and delightful moments. Experience the perfect blend of tradition and innovation in every cup.</p>
                    <div class="mt-6">
                        <h4 class="font-semibold text-lg mb-3">Opening Hours</h4>
                        <p class="text-gray-300">Monday - Friday: 10:00 AM - 5:00 PM</p>
                        <p class="text-gray-300">Saturday: 8:00 AM - 03:00 PM</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="/menu" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                Our Menu
                            </a>
                        </li>
                        <li>
                            <a href="/about" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="/contact" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                Contact
                            </a>
                        </li>
                        {{-- <li>
                            <a href="/faq" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                FAQ
                            </a>
                        </li> --}}
                    </ul>
                </div>

                <div>
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold">Connect With Us</h3>
                        
                        <div class="flex space-x-4">
                            <!-- Facebook -->
                            <a href="#" 
                               class="text-gray-400 hover:text-primary-600 transition-colors p-2" 
                               aria-label="Follow us on Facebook">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" 
                                          d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" 
                                          clip-rule="evenodd" />
                                </svg>
                            </a>
                    
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/geraimu.space/" target="_blank"
                               class="text-gray-400 hover:text-primary-600 transition-colors p-2" 
                               aria-label="Follow us on Instagram">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" 
                                          d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" 
                                          clip-rule="evenodd" />
                                </svg>
                            </a>
                    
                            <!-- Twitter -->
                            <a href="#" 
                               class="text-gray-400 hover:text-primary-600 transition-colors p-2" 
                               aria-label="Follow us on Twitter">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.093 4.093 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.615 11.615 0 006.29 1.84" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold text-lg mb-3">Newsletter</h4>
                        <form class="flex flex-col space-y-3">
                            <input 
                                type="email" 
                                placeholder="Enter your email" 
                                class="px-4 py-2.5 bg-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-white placeholder-gray-400"
                                required
                            >
                            <button 
                                type="submit" 
                                class="bg-primary-600 text-white px-4 py-2.5 rounded-lg hover:bg-primary-700 transition-colors duration-200 font-medium"
                            >
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Geraimu Coffee Shop. All rights reserved.</p>
                    <div class="flex space-x-6 md:justify-end text-sm text-gray-400">
                        <a href="/privacy" class="hover:text-white transition-colors duration-200">Privacy Policy</a>
                        <a href="/terms" class="hover:text-white transition-colors duration-200">Terms of Service</a>
                        <a href="/sitemap" class="hover:text-white transition-colors duration-200">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
    
    <!-- Modal Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-8 overflow-hidden">
            <!-- Close Button -->
            <button 
                onclick="closeLoginModal()" 
                class="absolute right-4 top-4 text-gray-400 hover:text-gray-600 transition-colors duration-200"
                aria-label="Close modal"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Content -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
                <p class="mt-2 text-gray-600">Please sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200"
                        placeholder="Enter your email"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200"
                            placeholder="Enter your password"
                        >
                        <button 
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                            aria-label="Toggle password visibility"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember_me" 
                            name="remember"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded transition-colors duration-200"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                        class="text-sm text-primary-600 hover:text-primary-800 font-medium transition duration-150 ease-in-out">
                        Forgot password?
                    </a>
                @endif
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                >
                    Sign in
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-800 transition-colors duration-200">
                        Register now
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
    <!-- Scripts -->
    <script defer src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Mobile menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            const icon = button.querySelector('svg');

            button.addEventListener('click', function() {
                const expanded = button.getAttribute('aria-expanded') === 'true';
                button.setAttribute('aria-expanded', !expanded);
                menu.classList.toggle('hidden');

                // Animate hamburger to X
                if (!expanded) {
                    icon.innerHTML = `
                        <path class="transform rotate-45 translate-y-2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16"/>
                        <path class="opacity-0" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16"/>
                        <path class="transform -rotate-45 -translate-y-2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 18h16"/>
                    `;
                } else {
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    `;
                }
            });
        });

        function showLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }
    
        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }
    
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Update icon based on password visibility
            const svg = event.currentTarget.querySelector('svg');
            if (type === 'text') {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    
        // Close modal when clicking outside
        document.getElementById('loginModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeLoginModal();
            }
        });
    
        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeLoginModal();
            }
        });
    </script>
    
</body>
</html>

