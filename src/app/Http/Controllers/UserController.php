<?php

namespace App\Http\Controllers;

use App\Models\User;

//use Illuminate\Http\Request;

class UserController extends Controller
{
  public function test()
  {
    $data = User::count();
    return view('index')->with(['data'=>$data]);
  }
}
