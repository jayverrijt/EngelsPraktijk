<?php

use App\Http\Controllers\EngelsPraktijk\Auth\UserController;
use App\Http\Controllers\EngelsPraktijk\CategoryController;
use App\Http\Controllers\EngelsPraktijk\LevelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//User
Route::resource('user', UserController::class, [
    'except' => ['create', 'edit']
]);

//Category
Route::resource('categories', CategoryController::class, [
    'except' => ['create', 'edit', 'update']
]);

// Route::resource('', LevelController::class, [
//     'except' => ['']
// ]);