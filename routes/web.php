<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('characters', App\Http\Controllers\CharacterController::class)->except('destroy');
    Route::get('characters/{character}/delete', [\App\Http\Controllers\CharacterController::class, 'destroy'])->name('characters.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
