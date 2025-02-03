<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('characters', App\Http\Controllers\CharacterController::class)->except('destroy');
    Route::get('characters/{character}/delete', [\App\Http\Controllers\CharacterController::class, 'destroy'])->name('characters.destroy');
    Route::post('characters/upload', [\App\Http\Controllers\CharacterController::class, 'upload'])->name('characters.upload');

    Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/profile', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
