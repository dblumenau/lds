@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6">Upload Your Own Words</h2>
                
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('words.upload.store') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="danish_word" class="block text-sm font-medium text-gray-700">Danish Word</label>
                        <input type="text" name="danish_word" id="danish_word" value="{{ old('danish_word') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('danish_word') border-red-500 @enderror" 
                               placeholder="e.g., hej" required>
                        @error('danish_word')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="english_translation" class="block text-sm font-medium text-gray-700">English Translation</label>
                        <input type="text" name="english_translation" id="english_translation" value="{{ old('english_translation') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('english_translation') border-red-500 @enderror" 
                               placeholder="e.g., hello" required>
                        @error('english_translation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" id="category" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('category') border-red-500 @enderror" 
                                required>
                            <option value="">Select a category</option>
                            <option value="greetings" {{ old('category') == 'greetings' ? 'selected' : '' }}>Greetings</option>
                            <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food & Drink</option>
                            <option value="travel" {{ old('category') == 'travel' ? 'selected' : '' }}>Travel</option>
                            <option value="family" {{ old('category') == 'family' ? 'selected' : '' }}>Family</option>
                            <option value="numbers" {{ old('category') == 'numbers' ? 'selected' : '' }}>Numbers</option>
                            <option value="colors" {{ old('category') == 'colors' ? 'selected' : '' }}>Colors</option>
                            <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-2 rounded-md text-sm font-medium transition-colors">
                            Upload Word
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">💡 Pro Tip</h3>
                    <p class="text-sm text-blue-700">
                        Upload words that you find useful in your daily life. The more personal and relevant the words are to you, 
                        the easier it will be to remember them!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection