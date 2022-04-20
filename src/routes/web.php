<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Item;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\Pre_userController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;

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
  $userCount = User::whereBetween('created_at', [$dt_from, $dt_to])->count();
  $itemCount = Item::whereBetween('created_at', [$dt_from, $dt_to])->count();

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

Route::post('/registration_main', [UserController::class,'addUser']);

Route::get('/registration_pre_success',function(){
  return view('users/registration_pre_success');
});

Route::get('/registration_main_success',function(){
  return view('users/registration_main_success');
});

Route::get('/session',[
  UserController::class,'getlogin'
]);

Route::post('/session',[
  UserController::class,'postlogin'
]);

Route::get('/index', [ItemController::class, 'showitem']);

Route::get('/item_new', [ItemController::class, 'getnew']);

Route::post('/item_new', [ItemController::class, 'postitem']);

Route::get('/detail', [ItemController::class, 'getdetail'])->name('items.detail');
Route::post('/detail', [CommentController::class, 'addComment']);

Route::get('/edit_item', [ItemController::class, 'getedit']);

Route::post('/edit_item', [ItemController::class, 'updateitem']);

Route::get('/delete', [ItemController::class, 'getdelete']);

Route::post('/delete', [ItemController::class, 'deleteitem']);

Route::get('/mypage', [ItemController::class, 'getmypage'])->name('users.mypage');

Route::get('/edit_user', [UserController::class, 'getedit']);

Route::post('/edit_user', [UserController::class, 'updateuser']);

Route::get('/edit_comment', [CommentController::class, 'getedit']);

Route::post('/edit_comment', [CommentController::class, 'updateComment']);

Route::get('/delete_comment', [CommentController::class, 'getDelete']);

Route::post('/delete_comment', [CommentController::class, 'deleteComment']);

Route::get('/logout', [UserController::class, 'getLogout']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/admin_top', [UserController::class, 'getAdminTop'])->name('admin_top');

Route::get('/admin_user', [UserController::class, 'getAdminUser'])->name('admin_user');;

Route::post('/admin_user', [UserController::class, 'csv']);

Route::get('/admin_item', [ItemController::class, 'getAdminItem'])->name('admin_item');

Route::post('/admin_item', [ItemController::class, 'csv']);