<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Mail\SendRegistrationMainMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

	public function getlogin()
	{
		return view('users.session');
	}

	public function postlogin(Request $request)
	{
		$rules = [
			'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
		];
		$this->validate($request, $rules);

		$hashedPassword = User::where('email', $request->email)->value('password');
		$user_id = User::where('email', $request->email)->value('id');
		if (password_verify($request->password, $hashedPassword)) {
			Session::put('user_id',$user_id);
			return redirect('/index');
		}else{
			return redirect('/session');
		}
  }
}
