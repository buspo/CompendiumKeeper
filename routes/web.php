<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function(){
	redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/characters', [App\Http\Controllers\CharacterController::class, 'index'])->name('characters.index');
    Route::get('/characters/create', [App\Http\Controllers\CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [App\Http\Controllers\CharacterController::class, 'store'])->name('characters.store');
    // Aggiungi altre rotte per edit, update e delete
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');