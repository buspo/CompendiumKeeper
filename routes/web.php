<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('characters', App\Http\Controllers\CharacterController::class)->except('destroy');
    Route::get('characters/{character}/delete', [\App\Http\Controllers\CharacterController::class, 'destroy'])->name('characters.destroy');
    Route::post('characters/upload', [\App\Http\Controllers\CharacterController::class, 'upload'])->name('characters.upload');
    Route::get('characters/{character}/view', [\App\Http\Controllers\CharacterController::class, 'view'])->name('characters.view');
    Route::post('characters/share', [\App\Http\Controllers\CharacterController::class, 'share'])->name('characters.share');
    Route::get('/characters/{character}/shared-users', [\App\Http\Controllers\CharacterController::class, 'getSharedUsers'])->name('characters.shared-users');
    Route::post('/characters/remove-share', [\App\Http\Controllers\CharacterController::class, 'removeShare'])->name('characters.remove-share');

    Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/profile', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
