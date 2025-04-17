<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'index']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/checklist', [App\Http\Controllers\Api\ChecklistController::class, 'index']);
    Route::post('/checklist', [App\Http\Controllers\Api\ChecklistController::class, 'store']);
    Route::delete('/checklist/{id}', [App\Http\Controllers\Api\ChecklistController::class, 'destroy']);
});
