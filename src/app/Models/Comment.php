<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use HasFactory;
	public $timestamps = false;//暗黙的にタイムスタンプをする機能をオフにする

	protected $fillable = [
		'text',
		'user_id',
		'item_id',
	];

	public function user(){
		return $this->belongsTo('App\Models\User');
  }

	public function item(){
		return $this->belongsTo('App\Models\Item');
  }
}
