<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pre_user;


class SendRegistrationPreMail extends Mailable
{
	use Queueable, SerializesModels;
	public $data;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($email)
	{
		$this->email = $email;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$user_id = Pre_user::where('email', $this->email)->value('id');
		return $this->view('mail.registration_pre_mail')
			->to($this->email, 'Test')
			->from('codetrain.ryuji.ogata@gmail.com', 'laravel掲示板事務局')
			->subject('仮登録完了メールです。')
			->with(['user_id' => $user_id]);
	}
}
