@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    {{-- Header --}}
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <nav class="space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Register</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Laravel + Vue.js + Tailwind CSS
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">
                A clean setup
            </p>
        </div>

        {{-- Tech Stack Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Laravel {{ app()->version() }}</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    The PHP framework for web artisans. Building robust applications with elegant syntax.
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Vue.js 3</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    The progressive JavaScript framework. Reactive components for modern web interfaces.
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tailwind CSS</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    A utility-first CSS framework for rapidly building custom user interfaces.
                </p>
            </div>
        </div>

        {{-- Vue Component Example --}}
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                Vue.js Component Example
            </h3>
            <div id="vue-app">
                <example-component></example-component>
            </div>
        </div>

        {{-- Getting Started --}}
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Getting Started</h3>
            <div class="space-y-4 text-gray-600 dark:text-gray-400">
                <p>To start developing with this setup:</p>
                <ol class="list-decimal list-inside space-y-2 ml-4">
                    <li>Run <code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">npm run dev</code> to start Vite development server</li>
                    <li>Create Vue components in <code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">resources/js/components/</code></li>
                    <li>Components are auto-registered and available in Blade templates</li>
                    <li>Use Alpine.js for simple interactions, Vue.js for complex components</li>
                </ol>
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <p class="font-semibold mb-2">Key Directories:</p>
                    <ul class="list-disc list-inside space-y-1 ml-4">
                        <li><code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">resources/views/</code> - Blade templates</li>
                        <li><code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">resources/js/components/</code> - Vue components</li>
                        <li><code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">resources/css/</code> - Stylesheets</li>
                        <li><code class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">routes/web.php</code> - Web routes</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
