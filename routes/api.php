<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EngelsPraktijk\ClassController;
use App\Http\Controllers\EngelsPraktijk\LevelController;
use App\Http\Controllers\EngelsPraktijk\CategoryController;
use App\Http\Controllers\EngelsPraktijk\QuestionController;
use App\Http\Controllers\EngelsPraktijk\Auth\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Create, Edit are pages reserved for front-end display (i.e. the page a user sees the edit form). These are useless in an API.

//User
Route::resource('user', UserController::class, [
    'except' => ['create', 'edit']
]);

//Category
Route::resource('categories', CategoryController::class, [
    'except' => ['create', 'edit']
]);

//Levels
Route::resource('levels', LevelController::class, [
    'except' => ['create', 'edit']
]);

//Class
Route::resource('classes', ClassController::class, [
    'except' => ['create', 'edit']
]);

//Questions
Route::resource('questions', QuestionController::class, [
    'except' => ['create', 'edit']
]);