<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Movie;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\GenreController;

Route::get('/genres/create', [GenreController::class, 'create'])->name('genre.create');
Route::post('/genres', [GenreController::class, 'store'])->name('genre.store');
Route::get('/genres', [GenreController::class, 'index'])->name('genre.index');  

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // admin.users.index
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/movies', [MovieController::class, 'index'])->name('movie.list');
Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

require __DIR__.'/auth.php';
