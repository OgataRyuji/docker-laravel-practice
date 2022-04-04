<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
	public function addComment(Request $request)
	{
		$comment = new Comment;

		$rules = [
			'comment' => ['required',  'string']
		];
		$this->validate($request, $rules);

		$comment->text = $request->comment;
		$comment->created_at = now();
		$comment->user_id = $request->session()->get('user_id');
		$comment->item_id = $request->item_id;
		$comment->save();

		return redirect()->route('items.detail',['user_id'=>$request->session()->get('user_id'), 'item_id'=>$request->item_id, 'post_user'=>$request->item_post_user]);
	}
}
