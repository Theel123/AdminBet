<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\GamesController;
use App\Http\Controllers\Api\ProvidersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('/category/{id}', 'show');
    Route::post('category/create', 'store');
    Route::delete('/category/{id}', 'destroy');
    Route::put('/category/{id}', 'update');
});

Route::controller(GamesController::class)->group(function () {
    Route::get('games', 'index');
    Route::get('/game/{id}', 'show');
    Route::post('game/create', 'store');
    Route::delete('/game/{id}', 'destroy');
    Route::put('/game/{id}', 'update');
});

Route::controller(ProvidersController::class)->group(function () {
    Route::get('providers', 'index');
    Route::get('/provider/{id}', 'show');
    Route::post('provider/create', 'store');
    Route::delete('/provider/{id}', 'destroy');
    Route::put('/provider/{id}', 'update');
});
