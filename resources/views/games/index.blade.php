<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Learn Danish with Mini-Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Memory Card Pairs Game -->
                        <a href="{{ route('games.matching-pairs') }}" class="block">
                            <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-500 transition-colors">
                                <h3 class="text-lg font-semibold mb-2">Memory Card Pairs</h3>
                                <p class="text-gray-600">Find the Danish-English pairs by flipping cards</p>
                            </div>
                        </a>
                        
                        <!-- Match Madness Game -->
                        <a href="{{ route('games.match-madness') }}" class="block">
                            <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-500 transition-colors">
                                <h3 class="text-lg font-semibold mb-2">Match Madness</h3>
                                <p class="text-gray-600">Race against time to match Danish-English word pairs</p>
                            </div>
                        </a>
                        
                        <!-- More games placeholder -->
                        <div class="border-2 border-gray-200 rounded-lg p-6 opacity-50 cursor-not-allowed">
                            <h3 class="text-lg font-semibold mb-2">Word Builder</h3>
                            <p class="text-gray-600">Coming soon...</p>
                        </div>
                        
                        <div class="border-2 border-gray-200 rounded-lg p-6 opacity-50 cursor-not-allowed">
                            <h3 class="text-lg font-semibold mb-2">Sentence Constructor</h3>
                            <p class="text-gray-600">Coming soon...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>