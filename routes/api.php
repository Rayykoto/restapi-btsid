<?php

use App\Http\Controllers\Api\ChecklistItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'index']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/checklist', [App\Http\Controllers\Api\ChecklistController::class, 'index']);
    Route::post('/checklist', [App\Http\Controllers\Api\ChecklistController::class, 'store']);
    Route::delete('/checklist/{id}', [App\Http\Controllers\Api\ChecklistController::class, 'destroy']);

    Route::prefix('checklist/{checklist}')->group(function () {
        Route::get('item', [ChecklistItemController::class, 'index']);
        Route::post('item', [ChecklistItemController::class, 'store']);
        Route::get('item/{item}', [ChecklistItemController::class, 'show']);
        Route::put('item/{item}', [ChecklistItemController::class, 'update']);
        Route::delete('item/{item}', [ChecklistItemController::class, 'destroy']);
        Route::put('item/rename/{item}', [ChecklistItemController::class, 'rename']);
    });
});
