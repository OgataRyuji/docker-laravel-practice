<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('/sample', [ApiController::class, 'apiHello']);

Route::post('/user', [ApiController::class, 'storeUser']);

Route::get('/user', [ApiController::class, 'showUser']);

Route::put('/user', [ApiController::class, 'updateUser']);

Route::delete('/user', [ApiController::class, 'destroyUser']);

Route::post('/item', [ApiController::class, 'storeItem']);

Route::get('/item', [ApiController::class, 'showItem']);

Route::put('/item', [ApiController::class, 'updateItem']);

Route::delete('/item', [ApiController::class, 'destroyItem']);

Route::post('/comment', [ApiController::class, 'storeComment']);

Route::get('/comment', [ApiController::class, 'showComment']);

Route::put('/comment', [ApiController::class, 'updateComment']);

Route::delete('/comment', [ApiController::class, 'destroyComment']);