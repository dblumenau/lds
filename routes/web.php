<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordUploadController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Admin\UserApprovalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'approved'])->name('dashboard');

// Approval pending route (accessible to unapproved but authenticated users)
Route::get('/approval-pending', [ApprovalController::class, 'pending'])
    ->middleware('auth')
    ->name('approval.pending');

// Routes that require approval
Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Word upload feature
    Route::get('/words/upload', [WordUploadController::class, 'index'])->name('words.upload');
    Route::post('/words/upload', [WordUploadController::class, 'store'])->name('words.upload.store');
});

// Admin routes (super admin only)
Route::middleware(['auth', 'superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users/pending', [UserApprovalController::class, 'index'])->name('users.pending');
    Route::post('/users/{user}/approve', [UserApprovalController::class, 'approve'])->name('users.approve');
    Route::delete('/users/{user}/reject', [UserApprovalController::class, 'reject'])->name('users.reject');
});

require __DIR__.'/auth.php';
