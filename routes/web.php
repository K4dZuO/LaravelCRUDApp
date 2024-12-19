<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TurtleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::get('/turtles', [TurtleController::class, 'index'])->name('turtles.index');
//    Route::get('/turtles/create', [TurtleController::class, 'create'])->name('turtles.create');
//    Route::post('/turtles', [TurtleController::class, 'store'])->name('turtles.store');
//    Route::get('/turtles/{turtle}', [TurtleController::class, 'show'])->name('turtles.show');
//    Route::get('/turtles/{turtle}/edit', [TurtleController::class, 'edit'])->name('turtles.edit');
//    Route::put('/turtles/{turtle}', [TurtleController::class, 'update'])->name('turtles.update');
//    Route::delete('/turtles/{turtle}', [TurtleController::class, 'destroy'])->name('turtles.destroy');
//
//    // Маршрут для восстановления мягко удаленной карточки
//    Route::post('/turtles/{turtle}/restore', [TurtleController::class, 'restore'])->name('turtles.restore');
//});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/turtles', [TurtleController::class, 'index'])->name('turtles.index');
    Route::get('/users/{person}', [TurtleController::class, 'index_persone'])->name('turtles_person.index');

    Route::get('/turtles/create', [TurtleController::class, 'create'])->name('turtles.create');
    Route::post('/turtles', [TurtleController::class, 'store'])->name('turtles.store');

    Route::get('/turtles/{turtle}', [TurtleController::class, 'show'])->name('turtles.show');
    Route::get('/turtles/{turtle}/edit', [TurtleController::class, 'edit'])->name('turtles.edit');


    Route::put('/turtles/{turtle}', [TurtleController::class, 'update'])->withTrashed()->name('turtles.update');
    Route::delete('/turtles/{turtle}', [TurtleController::class, 'destroy'])->name('turtles.destroy');
    Route::post('/turtles/{turtle}/restore', [TurtleController::class, 'restore'])
        ->withTrashed()
        ->name('turtles.restore');
    Route::delete('/turtles/{turtle}/force', [TurtleController::class, 'forceDestroy'])->name('turtles.force_destroy');

});

require __DIR__.'/auth.php';
