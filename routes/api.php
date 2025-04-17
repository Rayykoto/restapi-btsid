<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'index']);
