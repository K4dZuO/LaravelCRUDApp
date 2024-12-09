<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurtleController;

Route::get('/', function () {
    return redirect('/turtles');
});


Route::get('/turtles', [TurtleController::class, 'index'])->name('turtles.index');
Route::get('/turtles/create', [TurtleController::class, 'create'])->name('turtles.create');
Route::post('/turtles', [TurtleController::class, 'store'])->name('turtles.store');
Route::get('/turtles/{turtle}', [TurtleController::class, 'show'])->name('turtles.show');
Route::get('/turtles/{turtle}/edit', [TurtleController::class, 'edit'])->name('turtles.edit');
Route::put('/turtles/{turtle}', [TurtleController::class, 'update'])->name('turtles.update');
Route::delete('/turtles/{turtle}', [TurtleController::class, 'destroy'])->name('turtles.destroy');

