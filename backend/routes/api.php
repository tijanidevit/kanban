<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
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


Route::apiResource('columns', ColumnController::class)->only(['index','store']);
Route::prefix('columns')->group(function () {
    Route::delete('/', [ColumnController::class, 'destroy']);
});



Route::apiResource('cards', CardController::class)->only(['store','index']);
Route::prefix('cards')->group(function () {
    Route::patch('/', [CardController::class, 'update']);
    Route::delete('/', [CardController::class, 'delete']);
});
Route::get('/list-cards', [CardController::class, 'listCards']);


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
