<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TicketController;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'index'])->name('movie.list');
Route::get('/movies/{slug}', [MovieController::class, 'show'])->name('movies.show');

// Genre routes
Route::get('/genres', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genres/create', [GenreController::class, 'create'])->name('genre.create'); 
Route::post('/genres', [GenreController::class, 'store'])->name('genre.store');

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware(['auth'])->group(function() {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Admin routes
// Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Movie management
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{slug}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{slug}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{slug}', [MovieController::class, 'destroy'])->name('movies.destroy');
    
    // Ticket management
    Route::resource('tickets', TicketController::class);
    
    // User management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::get('/api/schedules/{schedule}/seats', function (Schedule $schedule) {
    if (!$schedule->hall) {
        return response()->json(['error' => 'Зал не найден'], 404);
    }

    $seats = $schedule->hall->hallSeats;

    if ($seats->isEmpty()) {
        return response()->json(['error' => 'Нет доступных мест'], 404);
    }

    return response()->json($seats->map(function ($seat) {
        return [
            'id' => $seat->id,
            'row' => $seat->row,
            'seat_number' => $seat->seat_number,
            'price' => $seat->price,
        ];
    }));
});