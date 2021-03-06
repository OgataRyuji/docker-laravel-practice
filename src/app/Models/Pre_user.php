<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pre_user extends Model
{
	use HasFactory;
	public $timestamps = false;//暗黙的にタイムスタンプをする機能をオフにする

	protected $fillable = [
		'email',
		'created_at',
	];

	public function insertPreUser($email, $created_at)
	{
    return $this->create([
      'email'=>$email,
			'created_at'=>$created_at,
		]);
	}
}
