<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConsejoController;
use App\Http\Controllers\API\ProfesorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/profesores', [ProfesorController::class, 'index']);
Route::get('/profesores/{id}', [ProfesorController::class, 'show']);
Route::get('/search/profesores', [ProfesorController::class, 'search']);

Route::get('/consejos', [ConsejoController::class, 'index']);
Route::get('/consejos/{id}', [ConsejoController::class, 'show']);
Route::get('/search/consejos', [ConsejoController::class, 'search']);
Route::post('/crear', [ConsejoController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});