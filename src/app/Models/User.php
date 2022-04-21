<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;//暗黙的にタイムスタンプをする機能をオフにする

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
				'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items()
    {
    return $this->hasMany('App\Models\Item');
    }

    public function comments()
    {
    return $this->hasMany('App\Models\Comment');
    }

		public function insertUser($nickname, $email, $password, $created_at)
		{
      return $this->create([
				'nickname'=> $nickname,
				'email'=> $email,
				'password'=> Hash::make($password),
				'created_at'=>$created_at,
			]);
		}

		public function login($email, $password)
		{
      $hashedPassword = User::where('email', $email)->value('password');
			$user_id = User::where('email', $email)->value('id');

			if (password_verify($password, $hashedPassword)){
				Session::put('user_id',$user_id);
				return true;
			}else{
				return false;
			}
		}

		public function editUser($user_id)
		{
      $user = User::where('id',$user_id)->get();
			return $user;
		}

		public function updateUser($user_id, $nickname, $password, $created_at)
		{
      User::where('id',$user_id)->update([
        'nickname'=> $nickname,
				'password'=> Hash::make($password),
				'created_at'=> $created_at,
			]);

      return User::where('id', $user_id)->get();
		}

    public function getAllUser()
    {
      return User::all();
    }

    public function deleteUser($user_id)
    {
      return User::find($user_id)->delete();
    }
}
