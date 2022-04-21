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
		'created_at',
	];

	public function user(){
		return $this->belongsTo('App\Models\User');
  }

	public function item(){
		return $this->belongsTo('App\Models\Item');
  }

  public function itemDetailComment($item_id)
	{
		$comments = Comment::where('item_id',$item_id)->orderBy('created_at', 'DESC')->get();
		return $comments;
	}

	public function insertComment($text, $created_at, $user_id, $item_id)
	{
    return $this->create([
      'text'=>$text,
			'created_at'=>$created_at,
			'user_id'=>$user_id,
			'item_id'=>$item_id,
		]);
	}

	public function getComment($comment_id)
	{
    $comment = Comment::where('id',$comment_id)->get();
		return $comment;
	}

	public function updateComment($comment_id, $text, $created_at)
	{
		Comment::where('id',$comment_id)->update([
      'text'=>$text,
			'created_at'=>$created_at,
		]);

		return Comment::where('id', $comment_id)->get();
	}

	public function deleteComment($comment_id)
	{
    $comment = Comment::find($comment_id)->delete();
		return  $comment;
	}

	public function getAllComment()
	{
      return Comment::all();
	}
}
