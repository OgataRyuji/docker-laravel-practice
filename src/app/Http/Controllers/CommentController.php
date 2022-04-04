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
/*
		$rules = [
			'text' => ['required',  'string']
		];
		$this->validate($request, $rules);
*/
		$comment->text = $request->comment;
		$comment->created_at = now();
		$comment->user_id = $request->session()->get('user_id');
		$comment->item_id = $request->item_id;
		$comment->save();

		return redirect()->route('items.detail',['user_id'=>$request->session()->get('user_id'), 'item_id'=>$request->item_id, 'post_user'=>$request->item_post_user]);
	}

	public function getedit()
	{
    $comment_id = $_GET['comment_id'];
		$comment = Comment::where('id',$comment_id)->get();
		return view('comments.edit_comment')->with('comment',$comment);
	}

	public function updateComment(Request $request)
	{
		/*
		$rules = [
			'text' => ['required',  'string']
		];
		$this->validate($request, $rules);
    */

    $comment = Comment::find($request->comment_id);
		$comment->text = $request->edit_comment;
		$comment->created_at = now();
		//$comment->user_id = Session::get('user_id');
		$comment->save();

		return redirect()->route('items.detail',['user_id'=>$request->session()->get('user_id'), 'item_id'=>$request->item_id, 'post_user'=>$request->post_user]);
	}
}
