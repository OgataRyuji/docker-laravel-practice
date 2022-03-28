<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Item;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //'UserController@test';
    //'ItemController@testitem';
    $userCount = User::count();
    $itemCount = Item::count();
  return view('index',[
    'userCount' => $userCount,
    'itemCount' => $itemCount
  ]);
});

//Route::get('/', [ App\Http\Controllers\UserController::class, 'test']);
//Route::get('/', [ App\Http\Controllers\ItemController::class, 'testitem']);