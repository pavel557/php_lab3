<?php

use App\Http\ApiV1\Modules\GamedevStudios\Controllers\GamedevStudiosController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/gamedev-studios', [ GamedevStudiosController::class, 'create']);

Route::patch('/gamedev-studios/{id}', [GamedevStudiosController::class, 'patch']);

Route::put('/gamedev-studios/{id}', [GamedevStudiosController::class, 'update']);

Route::delete('/gamedev-studios/{id}', [GamedevStudiosController::class, 'delete']);

Route::get('/gamedev-studios/{id}', [GamedevStudiosController::class, 'get']);
