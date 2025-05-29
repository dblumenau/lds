<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Learn Danish Swiftly - Fun Language Learning with Mini Games</title>

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
                        <a href="/" class="flex items-center space-x-2">
                            <span class="text-2xl">🇩🇰</span>
                            <span class="font-bold text-xl text-indigo-600">Learn Danish Swiftly</span>
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
                        <a href="#games" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Mini Games</a>
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
                    <a href="#games" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Mini Games</a>
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
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Learn Danish the <span class="text-indigo-600">Fun Way</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Master Danish through interactive mini-games, bite-sized lessons, and engaging challenges. 
                    Start your language journey today!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                            Start Learning Free
                        </a>
                    @endguest
                    <a href="#games" class="bg-white text-indigo-600 hover:bg-gray-50 px-8 py-3 rounded-lg text-lg font-semibold border-2 border-indigo-600 transition-colors">
                        Explore Games
                    </a>
                </div>
            </div>
        </section>

        {{-- Features Grid --}}
        <section class="px-4 py-16 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-center text-gray-900 mb-12">
                    Why Learn with Us?
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- Feature 1 --}}
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🎮</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Fun Mini Games</h3>
                        <p class="text-gray-600">Learn through play with word puzzles, memory games, and interactive challenges</p>
                    </div>
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
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                        <div class="text-4xl mb-4">🔤</div>
                        <h3 class="text-lg font-semibold mb-2">Word Match</h3>
                        <p class="text-gray-600 text-sm">Match Danish words with their English translations</p>
                    </div>
                    {{-- Game Card 2 --}}
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                        <div class="text-4xl mb-4">🧩</div>
                        <h3 class="text-lg font-semibold mb-2">Sentence Builder</h3>
                        <p class="text-gray-600 text-sm">Construct Danish sentences from word blocks</p>
                    </div>
                    {{-- Game Card 3 --}}
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                        <div class="text-4xl mb-4">🎧</div>
                        <h3 class="text-lg font-semibold mb-2">Listen & Learn</h3>
                        <p class="text-gray-600 text-sm">Practice pronunciation with audio challenges</p>
                    </div>
                    {{-- Game Card 4 --}}
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 cursor-pointer">
                        <div class="text-4xl mb-4">⚡</div>
                        <h3 class="text-lg font-semibold mb-2">Speed Quiz</h3>
                        <p class="text-gray-600 text-sm">Test your knowledge against the clock</p>
                    </div>
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
                    Join thousands of learners mastering Danish the fun way
                </p>
                @guest
                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition-colors inline-block">
                        Create Free Account
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="bg-white text-indigo-600 hover:bg-gray-100 px-8 py-3 rounded-lg text-lg font-semibold transition-colors inline-block">
                        Go to Dashboard
                    </a>
                @endguest
            </div>
        </section>

        {{-- Footer --}}
        <footer class="bg-gray-900 text-gray-300 px-4 py-8 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; 2025 Learn Danish Swiftly. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
