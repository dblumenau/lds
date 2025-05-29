@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="text-center">
                    <div class="mb-6">
                        <svg class="mx-auto h-24 w-24 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-2xl font-bold mb-4">Account Pending Approval</h2>
                    
                    <p class="text-gray-600 mb-6">
                        Thank you for registering! Your account is currently pending approval by our administrators.
                    </p>
                    
                    <p class="text-gray-600 mb-8">
                        You will receive an email notification once your account has been approved. This usually takes 24-48 hours.
                    </p>
                    
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">
                            Registered as: <strong>{{ auth()->user()->email }}</strong>
                        </p>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-indigo-600 hover:text-indigo-500 underline text-sm">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection