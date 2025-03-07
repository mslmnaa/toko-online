@extends('layouts.main')

@section('content')
    <!-- Hero Section with Enhanced Parallax Effect -->
    <div class="relative  h-screen max-h-[800px] min-h-[600px] overflow-hidden">
        <div class="absolute inset-0 bg-fixed"
            style="background-image: url('/img/kopi1.jpg'); background-size: cover; background-position: center; background-attachment: "
            x-data x-init="$el.style.transform = `translateY(${window.pageYOffset * 0.5}px)`" @scroll.window="$el.style.transform = `translateY(${window.pageYOffset * 0.5}px)`">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/50"></div>
        <div class="relative h-full flex items-center justify-center text-center">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 opacity-0 translate-y-10 animate-fade-in-up">
                    Welcome to Tokomu
                </h1>
                <p
                    class="text-xl md:text-2xl text-gray-200 mb-10 opacity-0 translate-y-10 animate-fade-in-up animation-delay-300">
                    Experience the perfect blend of tradition and innovation
                </p>
                <div class="space-x-4 opacity-0 translate-y-10 animate-fade-in-up animation-delay-600">
                    <a href="/menu"
                        class="inline-block bg-white text-primary-800 px-8 py-4 rounded-full text-lg font-semibold
                          hover:bg-primary-100 transition-all duration-300 transform hover:scale-105
                          hover:shadow-lg">
                        Explore Our Menu
                    </a>
                    <a href="/about"
                        class="inline-block bg-transparent text-white border-2 border-white px-8 py-4 rounded-full text-lg font-semibold
                          hover:bg-white/10 transition-all duration-300">
                        About Us
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>

    <!-- Features Section with Enhanced Animations -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center fade-in-section">
            <span class="text-primary-600 font-medium">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl font-bold text-primary-800 mt-2 mb-16">Experience the Geraimu Difference</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ([
            [
                'icon' => 'coffee',
                'title' => 'Premium Coffee',
                'description' => 'Savor our carefully selected, locally-roasted coffee beans, bringing you the perfect cup every time.',
                'link' => '/menu',
                'cta' => 'View Our Selection',
            ],
            [
                'icon' => 'chair',
                'title' => 'Elegant Space',
                'description' => 'Immerse yourself in our sophisticated and welcoming atmosphere, perfect for both relaxation and productivity.',
                'link' => '/about',
                'cta' => 'Explore Our Space',
            ],
            [
                'icon' => 'cookie',
                'title' => 'Fresh Treats',
                'description' => 'Complement your coffee with our daily baked pastries and delectable gourmet snacks.',
                'link' => '/menu#treats',
                'cta' => 'See Our Treats',
            ],
        ] as $feature)
                <div
                    class="group bg-white p-8 rounded-xl shadow-lg border border-gray-100
                        transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl
                        fade-in-section">
                    <div
                        class="text-4xl text-primary-600 mb-6 transform transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12">
                        <i class="fas fa-{{ $feature['icon'] }}"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-primary-800 mb-4">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $feature['description'] }}
                    </p>
                    <a href="{{ $feature['link'] }}"
                        class="inline-flex items-center mt-6 text-primary-600 hover:text-primary-800
                          transition-colors duration-300 group-hover:translate-x-2">
                        {{ $feature['cta'] }}
                        <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Special Offer Section with Parallax -->
    <div class="relative bg-primary-50 py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 pattern-dots pattern-gray-800 pattern-size-4 pattern-opacity-10"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div
                class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-transform duration-500">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2">
                        <div class="relative h-full min-h-[400px]">
                            <div
                                class="absolute inset-0 bg-[url('/img/kopi1.jpg')] bg-cover bg-center transform transition-transform duration-700 hover:scale-110">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent"></div>
                        </div>
                    </div>
                    <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center fade-in-section">
                        <span class="text-primary-600 font-medium mb-2">Limited Time</span>
                        <h3 class="text-3xl md:text-4xl font-bold text-primary-800 mb-4">Happy Hour Special</h3>
                        <p class="text-gray-600 mb-8 text-lg">
                            Join us during happy hour (2-5 PM) and enjoy 20% off on all coffee drinks!
                            Perfect time to try our signature brews.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <button
                                class="inline-flex items-center bg-primary-600 text-white px-6 py-3 rounded-full
                                     text-lg font-semibold hover:bg-primary-700 transition-all duration-300
                                     transform hover:scale-105 hover:shadow-lg">
                                <span>Learn More</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                            <button
                                class="inline-flex items-center bg-transparent text-primary-600 border-2 border-primary-600
                                     px-6 py-3 rounded-full text-lg font-semibold hover:bg-primary-50
                                     transition-all duration-300">
                                View Menu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animation-delay-300 {
            animation-delay: 0.3s;
        }

        .animation-delay-600 {
            animation-delay: 0.6s;
        }

        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .pattern-dots {
            background-image: radial-gradient(currentColor 1px, transparent 1px);
            background-size: calc(10 * 1px) calc(10 * 1px);
        }
    </style>

    <!-- Intersection Observer Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.fade-in-section');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
@endsection
