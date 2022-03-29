<?php

namespace App\Http\Controllers;

use App\Models\Pre_user;

use Illuminate\Http\Request;

use App\Mail\SendRegistrationPreMail;
use Illuminate\Support\Facades\Mail;

class Pre_userController extends Controller
{

	public function addUserPre(Request $request)
	{
		$pre_user = new Pre_user;
		//バリデーション
		$rules = [
			'email' => ['required', 'email', 'unique:pre_users']
    ];
    $this->validate($request, $rules);

		$pre_user->email = $request->email;
		$pre_user->created_at = now();
		$pre_user->save();

		$email = $request->email;
		Mail::send(new SendRegistrationPreMail($email));

		return redirect('/registration_pre_success');
	}
}
