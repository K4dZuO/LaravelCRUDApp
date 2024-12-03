<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

Route::get('/', function () {
    return redirect('/cards');
});


Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
Route::get('/cards/create', [CardController::class, 'create']) -> name('cards.create');
Route::post('/cards', [CardController::class, 'store']) -> name('cards.store');
Route::get('/cards/{card}', [CardController::class, 'show']) -> name('cards.show');
Route::get('/cards/{card}/edit', [CardController::class, 'edit'])->name('cards.edit');
Route::put('/cards/{card}', [CardController::class, 'update'])->name('cards.update');
Route::delete('/cards/{card}', [CardController::class, 'destroy'])->name('cards.destroy');
Route::post('/cards/{id}/restore', [CardController::class, 'restore'])->name('cards.restore');
