<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController\HomeController;
use App\Http\Controllers\UserController\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/add', [UserController::class, 'add'])->name('users.add');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/weather', [UserController::class, 'get_weather'])->name('users.get_weather');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
