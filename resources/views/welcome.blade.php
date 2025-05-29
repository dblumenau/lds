<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Swift Danish - Tailored for You</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        {{-- Mobile-First Navigation --}}
        <nav class="bg-white shadow-lg" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    {{-- Logo and Brand --}}
                    <div class="flex items-center">
                        <a href="/" class="flex items-center space-x-3">
                            <img src="{{ asset('images/swift_danish_logo.png') }}" alt="Swift Danish" class="h-10 w-auto">
                            <span class="font-bold text-xl text-indigo-600">Swift Danish</span>
                        </a>
                    </div>

                    {{-- Mobile menu button --}}
                    <div class="flex items-center sm:hidden">
                        <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="h-6 w-6" :class="{'block': open, 'hidden': !open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Desktop Navigation --}}
                    <div class="hidden sm:flex sm:items-center sm:space-x-8">
                        <a href="{{ route('games.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Mini Games</a>
                        <a href="#lessons" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Lessons</a>
                        <a href="#progress" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Progress</a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium transition-colors">Get Started</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Mobile Navigation Menu --}}
            <div x-show="open" x-transition class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('games.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Mini Games</a>
                    <a href="#lessons" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Lessons</a>
                    <a href="#progress" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Progress</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-base font-medium text-indigo-600 hover:text-indigo-700 hover:bg-gray-50">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-indigo-600 hover:text-indigo-700 hover:bg-gray-50">Get Started</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Hero Section --}}
        <section class="px-4 py-12 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                {{-- Prominent Logo --}}
                <div class="mb-8">
                    <img src="{{ asset('images/swift_danish_logo.png') }}" alt="Swift Danish" class="mx-auto h-32 sm:h-40 lg:h-48 w-auto shadow-lg rounded-lg">
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    Swift Danish
                </h1>
                <p class="text-2xl sm:text-3xl text-indigo-600 mb-8 font-semibold">
                    Tailored for You
                </p>
                <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Master Danish through interactive mini-games and personalized learning. 
                    Upload your own word pairs and practice with games tailored to your needs!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('games.index') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-8 py-3 rounded-lg text-lg font-semibold transition-colors shadow-lg transform hover:scale-105">
                        🎮 Play Mini Games Now
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="bg-white text-indigo-600 hover:bg-gray-50 px-8 py-3 rounded-lg text-lg font-semibold border-2 border-indigo-600 transition-colors">
                            Create Account
                        </a>
                    @else
                        <a href="{{ route('words.upload') }}" class="bg-white text-indigo-600 hover:bg-gray-50 px-8 py-3 rounded-lg text-lg font-semibold border-2 border-indigo-600 transition-colors">
                            📝 Upload Words
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        {{-- Key Features Highlight --}}
        <section class="px-4 py-16 sm:px-6 lg:px-8 bg-indigo-50">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                            🎮 Interactive Mini Games
                        </h2>
                        <p class="text-lg text-gray-700 mb-6">
                            Learning Danish has never been more fun! Our mini games turn vocabulary practice into an engaging experience:
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-2">✓</span>
                                <span><strong>Memory Pairs:</strong> Classic card-matching game with Danish-English word pairs</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-2">✓</span>
                                <span><strong>Match Madness:</strong> Fast-paced word matching against the clock</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-2">✓</span>
                                <span><strong>More games coming:</strong> Word Builder, Sentence Constructor, and more!</span>
                            </li>
                        </ul>
                        <a href="{{ route('games.index') }}" class="inline-flex items-center bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-3 rounded-lg font-semibold transition-colors">
                            Play Games Now
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%23f3f4f6'/%3E%3Crect x='50' y='50' width='140' height='90' rx='8' fill='%234f46e5' opacity='0.8'/%3E%3Crect x='210' y='50' width='140' height='90' rx='8' fill='%236366f1' opacity='0.8'/%3E%3Crect x='50' y='160' width='140' height='90' rx='8' fill='%238b5cf6' opacity='0.8'/%3E%3Crect x='210' y='160' width='140' height='90' rx='8' fill='%23a78bfa' opacity='0.8'/%3E%3Ctext x='120' y='100' text-anchor='middle' fill='white' font-size='20' font-weight='bold'%3EHej%3C/text%3E%3Ctext x='280' y='100' text-anchor='middle' fill='white' font-size='20' font-weight='bold'%3EHello%3C/text%3E%3Ctext x='120' y='210' text-anchor='middle' fill='white' font-size='20' font-weight='bold'%3ETak%3C/text%3E%3Ctext x='280' y='210' text-anchor='middle' fill='white' font-size='20' font-weight='bold'%3EThanks%3C/text%3E%3C/svg%3E" alt="Memory game preview" class="w-full rounded-lg">
                        <p class="text-center text-gray-600 mt-4">Memory Pairs game in action</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Custom Word Upload Feature --}}
        <section class="px-4 py-16 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="order-2 lg:order-1">
                        <div class="bg-gray-50 p-8 rounded-xl">
                            <div class="space-y-4">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold">Danish</span>
                                        <span class="font-semibold">English</span>
                                    </div>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <span>Hej</span>
                                        <span>Hello</span>
                                    </div>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <span>Farvel</span>
                                        <span>Goodbye</span>
                                    </div>
                                </div>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <span>Tak</span>
                                        <span>Thanks</span>
                                    </div>
                                </div>
                                <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                                    + Add More Words
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                            📝 Personalized Learning
                        </h2>
                        <p class="text-lg text-gray-700 mb-6">
                            Make Swift Danish truly yours! Upload your own Danish-English word pairs and practice with vocabulary that matters to you:
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-2">✓</span>
                                <span><strong>Custom vocabulary:</strong> Focus on words relevant to your interests or profession</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-2">✓</span>
                                <span><strong>CSV upload:</strong> Easily import word lists from spreadsheets</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-2">✓</span>
                                <span><strong>Practice your way:</strong> Your custom words appear in all mini games</span>
                            </li>
                        </ul>
                        @auth
                            @if(auth()->user()->isApproved())
                                <a href="{{ route('words.upload') }}" class="inline-flex items-center bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-3 rounded-lg font-semibold transition-colors">
                                    Upload Your Words
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </a>
                            @else
                                <p class="text-gray-600 italic">Account approval required to upload custom words</p>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-3 rounded-lg font-semibold transition-colors">
                                Sign Up to Upload Words
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        {{-- Features Grid --}}
        <section class="px-4 py-16 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-center text-gray-900 mb-12">
                    More Features
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- Feature 2 --}}
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">📱</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Mobile First</h3>
                        <p class="text-gray-600">Learn anywhere, anytime with our responsive design optimized for all devices</p>
                    </div>
                    {{-- Feature 3 --}}
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">📊</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Track Progress</h3>
                        <p class="text-gray-600">Monitor your learning journey with detailed progress tracking and achievements</p>
                    </div>
                    {{-- Feature 4 --}}
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🎯</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Structured Lessons</h3>
                        <p class="text-gray-600">Follow a carefully designed curriculum from beginner to advanced levels</p>
                    </div>
                    {{-- Feature 5 --}}
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🗣️</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Native Audio</h3>
                        <p class="text-gray-600">Perfect your pronunciation with audio from native Danish speakers</p>
                    </div>
                    {{-- Feature 6 --}}
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🏆</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Achievements</h3>
                        <p class="text-gray-600">Earn badges and rewards as you progress through your learning journey</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Mini Games Preview --}}
        <section id="games" class="px-4 py-16 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-center text-gray-900 mb-12">
                    Popular Mini Games
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Game Card 1 --}}
                    <a href="{{ route('games.matching-pairs') }}" class="block">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                            <div class="text-4xl mb-4">🃏</div>
                            <h3 class="text-lg font-semibold mb-2">Memory Pairs</h3>
                            <p class="text-gray-600 text-sm">Match Danish words with their English translations</p>
                        </div>
                    </a>
                    {{-- Game Card 2 --}}
                    <a href="{{ route('games.match-madness') }}" class="block">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                            <div class="text-4xl mb-4">⚡</div>
                            <h3 class="text-lg font-semibold mb-2">Match Madness</h3>
                            <p class="text-gray-600 text-sm">Race against time to match word pairs</p>
                        </div>
                    </a>
                    {{-- Game Card 3 --}}
                    <a href="{{ route('games.index') }}" class="block opacity-60">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                            <div class="text-4xl mb-4">🧩</div>
                            <h3 class="text-lg font-semibold mb-2">Word Builder</h3>
                            <p class="text-gray-600 text-sm">Coming soon - Build Danish words</p>
                        </div>
                    </a>
                    {{-- Game Card 4 --}}
                    <a href="{{ route('games.index') }}" class="block opacity-60">
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                            <div class="text-4xl mb-4">📝</div>
                            <h3 class="text-lg font-semibold mb-2">Sentence Constructor</h3>
                            <p class="text-gray-600 text-sm">Coming soon - Build sentences</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="px-4 py-16 sm:px-6 lg:px-8 bg-indigo-600">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                    Ready to Start Your Danish Journey?
                </h2>
                <p class="text-xl text-indigo-100 mb-8">
                    Play mini games instantly or create an account to upload your own vocabulary
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('games.index') }}" class="bg-white text-indigo-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition-colors inline-block shadow-lg transform hover:scale-105">
                        🎮 Play Games Now
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="bg-indigo-500 text-white hover:bg-indigo-400 px-8 py-3 rounded-lg text-lg font-semibold transition-colors inline-block">
                            Create Account
                        </a>
                    @else
                        <a href="{{ route('words.upload') }}" class="bg-indigo-500 text-white hover:bg-indigo-400 px-8 py-3 rounded-lg text-lg font-semibold transition-colors inline-block">
                            Upload Words
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="bg-gray-900 text-gray-300 px-4 py-8 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; 2025 Swift Danish. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
