<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Show the approval pending page.
     */
    public function pending()
    {
        return view('approval.pending');
    }
}
