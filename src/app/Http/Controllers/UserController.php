<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Mail\SendRegistrationMainMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function addUser(Request $request)
  {
    $user = new User;

    $rules = [
      'nickname' => ['required',  'string', 'min:5'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
    ];
    $this->validate($request, $rules);

    $user->nickname = $request->nickname;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->created_at = now();
	$user->save();

    $email = $request->email;
	Mail::send(new SendRegistrationMainMail($email));

    return redirect('/registration_main_success');
  }
}
