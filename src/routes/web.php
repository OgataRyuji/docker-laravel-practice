<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Item;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\Pre_userController;

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
    $dt_from = new \Carbon\Carbon();
	$dt_from->startOfMonth();

	$dt_to = new \Carbon\Carbon();
	$dt_to->endOfMonth();
    //'UserController@test';
    //'ItemController@testitem';
    //$userCount = User::count();
    $userCount = User::whereBetween('created_at', [$dt_from, $dt_to])->count();
    $itemCount = Item::count();
  return view('index',[
    'userCount' => $userCount,
    'itemCount' => $itemCount
  ]);
});

Route::get('/registration_pre',function(){
  return view('users/registration_pre');
});

Route::post('/registration_pre', [Pre_userController::class,'addUserPre']);

Route::get('/registration_main',function(){
  return view('users/registration_main');
});

Route::get('/registration_pre_success',function(){
  return view('users/registration_pre_success');
});