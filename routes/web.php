<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ResourceController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Resource routes
    Route::get('/resources/upload', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
    Route::put('/resources/{resource}', [ResourceController::class, 'update'])->name('resources.update');
    Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');

    // Vote routes
    Route::post('/resources/{resource}/vote', [VoteController::class, 'vote'])->name('resources.vote');

    // Comment routes
    Route::post('/resources/{resource}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');


require __DIR__ . '/auth.php';
