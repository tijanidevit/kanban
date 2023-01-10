<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\DbDumper\Databases\MySql;

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


// Route::apiResource('columns', ColumnController::class)->only(['index','store']);
Route::prefix('columns')->group(function () {
    Route::get('/', [ColumnController::class, 'index']);
    Route::get('/lists', [ColumnController::class, 'lists']);
    Route::post('/', [ColumnController::class, 'store']);
    Route::delete('/{id}', [ColumnController::class, 'destroy']);
});



Route::apiResource('cards', CardController::class)->only(['store','index']);
Route::prefix('cards')->group(function () {
    Route::post('/', [CardController::class, 'store']);
    Route::get('/', [CardController::class, 'index']);
    Route::patch('/', [CardController::class, 'update']);
    Route::patch('/column', [CardController::class, 'updateColumn']);
    Route::delete('/', [CardController::class, 'delete']);
});
Route::get('/list-cards', [CardController::class, 'listCards']);



Route::post('/login', [AuthController::class, 'login']);
Route::get('/dump-db', function () {
    MySql::create()
        ->setDbName(env('DB_DATABASE'))
        ->setUserName(env('DB_USERNAME'))
        ->setPassword(env('DB_PASSWORD'))
        ->dumpToFile('dump.sql');
});

Route::get('/seed-user', function () {
    Artisan::call('db:seed', [
        '--force' => true
     ]);
});
