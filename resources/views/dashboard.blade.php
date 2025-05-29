<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Welcome back, {{ auth()->user()->name }}!</h3>
                    
                    <p class="mb-6">{{ __("You're logged in and approved!") }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Regular User Features --}}
                        <a href="{{ route('words.upload') }}" class="block p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <h4 class="font-semibold text-indigo-900 mb-2">📝 Upload Words</h4>
                            <p class="text-sm text-indigo-700">Add your own Danish words to practice</p>
                        </a>
                        
                        <a href="#" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <h4 class="font-semibold text-green-900 mb-2">🎮 Play Games</h4>
                            <p class="text-sm text-green-700">Practice with fun mini-games</p>
                        </a>
                        
                        <a href="#" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <h4 class="font-semibold text-purple-900 mb-2">📊 View Progress</h4>
                            <p class="text-sm text-purple-700">Track your learning journey</p>
                        </a>
                        
                        {{-- Super Admin Features --}}
                        @if(auth()->user()->isSuperAdmin())
                            <a href="{{ route('admin.users.pending') }}" class="block p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                <h4 class="font-semibold text-red-900 mb-2">👥 Manage Users</h4>
                                <p class="text-sm text-red-700">Approve or reject pending users</p>
                            </a>
                        @endif
                    </div>
                    
                    @if(auth()->user()->isSuperAdmin())
                        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <strong>Super Admin:</strong> You have access to administrative features.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
