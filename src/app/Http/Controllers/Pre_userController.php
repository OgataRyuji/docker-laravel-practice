<?php

namespace App\Http\Controllers;

use App\Models\Pre_user;

use Illuminate\Http\Request;

use App\Mail\SendRegistrationPreMail;
use Illuminate\Support\Facades\Mail;

class Pre_userController extends Controller
{
	private $pre_user;
  public function __construct()
	{
		$this->pre_user = new Pre_user();
	}

	public function addUserPre(Request $request)
	{
		//バリデーション
		$rules = [
			'email' => ['required', 'email', 'unique:pre_users']
    ];
    $this->validate($request, $rules);

		$created_at = now();
		$email = $request->email;
    $pre_user = $this->pre_user->insertPreUser($email, $created_at);

		Mail::send(new SendRegistrationPreMail($email));

		return redirect('/registration_pre_success');
	}
}
