<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ResourceController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/resources/upload', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');

    // Vote routes
    Route::post('/resources/{resource}/vote', [VoteController::class, 'vote'])->name('resources.vote');
});

require __DIR__ . '/auth.php';
