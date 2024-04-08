<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth routes
Route::get('/unauthenticated', [AuthController::class, 'unauthenticated'])->name('login');

Route::post('/user', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/auth/user', [AuthController::class, 'user']);

Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);

// Protected routes
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/note', [NoteController::class, 'create']);
    
    Route::get('/notes', [NoteController::class, 'readAll']);
    
    Route::get('/note/{id}', [NoteController::class, 'show']);
    
    Route::put('/note/{id}', [NoteController::class, 'update']);
    
    Route::delete('/note/{id}', [NoteController::class, 'delete']);

    Route::put('/note/{id}/favorite', [NoteController::class, 'maskAsfavorite']);
    
    Route::put('/note/{id}/color', [NoteController::class, 'changeColor']);
});


