<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('games.index');
    }

    public function matchingPairs()
    {
        return view('games.matching-pairs');
    }

    public function matchMadness()
    {
        return view('games.match-madness');
    }
}