<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TasksController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::resource('tasks', TasksController::class)->only(['index', 'show']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
