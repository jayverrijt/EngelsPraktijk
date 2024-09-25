<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\UpdatePasswdController;
use App\Http\Controllers\UnSocialController;
use App\Http\Controllers\UpdateUserDetails;
use App\Http\Controllers\addUserController;
use App\Http\Controllers\editUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google
// Logoff Fix
Route::get('/logoff', function () {
    Auth::logout();
    return redirect('/');
})->name('logoff');
require __DIR__.'/auth.php';
require __DIR__.'/cms.php';
require __DIR__.'/app.php';
