@extends('layouts.main')

@section('content')
<!-- Hero Section with Dynamic Parallax -->
<div class="relative h-[600px] overflow-hidden">
    <div class="absolute inset-0 transform scale-105" 
         style="background-image: url('/img/kopi2.jpg'); 
                background-size: cover; 
                background-position: center;"
         data-parallax="scroll">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/50"></div>
    <div class="relative h-full flex items-center justify-center">
        <div class="text-center max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-down">
                About Geraimu
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-8 animate-fade-up max-w-2xl mx-auto leading-relaxed">
                Crafting exceptional coffee experiences since 2010
            </p>
            <a href="#our-story" class="inline-block animate-bounce-slow">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Story and Mission Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Our Story Card -->
        <div id="our-story" class="scroll-mt-24">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="/img/kopi5.jpg" alt="Geraimu story" class="object-cover w-full h-full">
                </div>
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <span class="w-12 h-12 bg-primary-500 rounded-full flex items-center justify-center transform rotate-3 transition-transform group-hover:rotate-12">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </span>
                        <h2 class="text-3xl font-bold text-primary-800 ml-4">Our Story</h2>
                    </div>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p class="transform hover:translate-x-2 transition-transform duration-300">
                            Founded in 2010, Geraimu began as a small coffee cart in the heart of the city. Our founder, Jane Doe, had a vision to bring premium, ethically sourced coffee to busy professionals and coffee enthusiasts alike.
                        </p>
                        <p class="transform hover:translate-x-2 transition-transform duration-300">
                            Over the years, we've grown into a beloved local chain, but our commitment to quality and community remains unchanged. Every cup we serve is a testament to our passion for great coffee and exceptional service.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Mission Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
            <div class="aspect-w-16 aspect-h-9">
                <img src="/img/kopi8.png" alt="Our mission" class="object-cover w-full h-full">
            </div>
            <div class="p-8">
                <div class="flex items-center mb-6">
                    <span class="w-12 h-12 bg-primary-500 rounded-full flex items-center justify-center transform rotate-3 transition-transform group-hover:rotate-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </span>
                    <h2 class="text-3xl font-bold text-primary-800 ml-4">Our Mission</h2>
                </div>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p class="transform hover:translate-x-2 transition-transform duration-300">
                        At Geraimu, our mission is to create a warm, inviting space where people can enjoy premium coffee, connect with others, and find moments of peace in their busy days.
                    </p>
                    <p class="transform hover:translate-x-2 transition-transform duration-300">
                        We're committed to sustainability, supporting local communities, and ensuring that every step of our supply chain is ethical and environmentally responsible.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Coffee Section -->
    <div class="mt-16">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2 gap-0">
                <div class="relative h-full min-h-[400px]">
                    <img src="/img/kopi6.jpg" alt="Coffee roasting process" class="absolute inset-0 w-full h-full object-cover">
                </div>
                <div class="p-8 lg:p-12">
                    <div class="flex items-center mb-8">
                        <span class="w-12 h-12 bg-primary-500 rounded-full flex items-center justify-center transform rotate-3 transition-transform group-hover:rotate-12">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <h2 class="text-3xl font-bold text-primary-800 ml-4">Our Coffee</h2>
                    </div>
                    <div class="space-y-6 text-gray-600 leading-relaxed">
                        <p class="transform hover:translate-x-2 transition-transform duration-300">
                            We source our beans from small, sustainable farms around the world. Our master roaster carefully crafts each batch to bring out the unique flavors and aromas of every origin.
                        </p>
                        <p class="transform hover:translate-x-2 transition-transform duration-300">
                            From our signature espresso blend to our rotating selection of single-origin pour-overs, we offer a coffee experience that caters to both the casual drinker and the connoisseur.
                        </p>
                        <div class="pt-6">
                            <a href="{{ route('menu') }}" 
                               class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg 
                                      hover:bg-primary-700 transition-colors duration-200">
                                <span>Explore Our Menu</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-down {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-up {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(10px);
        }
    }

    .animate-fade-down {
        animation: fade-down 1s ease-out;
    }

    .animate-fade-up {
        animation: fade-up 1s ease-out;
    }

    .animate-bounce-slow {
        animation: bounce-slow 2s infinite;
    }

    [data-parallax="scroll"] {
        transform: translateY(0);
        transition: transform 0.1s ease-out;
    }
</style>

<script>
    // Simple parallax effect
    document.addEventListener('DOMContentLoaded', function() {
        const parallaxElement = document.querySelector('[data-parallax="scroll"]');
        
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            if (parallaxElement) {
                parallaxElement.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    });
</script>
@endsection