<?php

use App\Http\Controllers\API\NotesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/hi/{id}', [UserController::class, 'HI']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/text', [NotesController::class, 'store']);
    Route::get('/text/{id}', [NotesController::class, 'show']);
    Route::put('/text/{id}/{text_id}', [NotesController::class, 'update']);
    Route::delete('/text/{id}/{text_id}', [NotesController::class, 'destroy']);
});
