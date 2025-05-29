<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordUploadController extends Controller
{
    /**
     * Show the word upload form.
     */
    public function index()
    {
        return view('words.upload');
    }

    /**
     * Handle the word upload.
     */
    public function store(Request $request)
    {
        $request->validate([
            'danish_word' => 'required|string|max:255',
            'english_translation' => 'required|string|max:255',
            'category' => 'required|string|max:100',
        ]);

        // In a real app, you'd save this to the database
        return redirect()->route('words.upload')->with('success', 'Word uploaded successfully!');
    }
}
