<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    /**
     * Display a listing of users pending approval.
     */
    public function index()
    {
        $pendingUsers = User::where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.pending', compact('pendingUsers'));
    }

    /**
     * Approve a user.
     */
    public function approve(User $user)
    {
        $user->approve(auth()->user());
        
        return redirect()->route('admin.users.pending')
            ->with('success', "User {$user->name} has been approved.");
    }

    /**
     * Reject a user.
     */
    public function reject(User $user)
    {
        $user->delete();
        
        return redirect()->route('admin.users.pending')
            ->with('success', "User has been rejected and removed.");
    }
}
