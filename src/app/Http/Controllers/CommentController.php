<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
	private $comment;
	public function __construct()
	{
		$this->comment = new Comment();
	}
	public function addComment(Request $request)
	{
  /*
		$rules = [
			'text' => ['required',  'string']
		];
		$this->validate($request, $rules);
  */
		$text = $request->comment;
		$created_at = now();
		$user_id = $request->session()->get('user_id');
		$item_id = $request->item_id;

		$comment = $this->comment->insertComment($text, $created_at, $user_id, $item_id);

		return redirect()->route('items.detail',['user_id'=>$request->session()->get('user_id'), 'item_id'=>$request->item_id, 'post_user'=>$request->item_post_user]);
	}

	public function getedit()
	{
    $comment_id = $_GET['comment_id'];
		$comment = $this->comment->getComment($comment_id);
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
		$comment_id = $request->comment_id;
		$text = $request->edit_comment;
		$created_at = now();

		$comment = $this->comment->updateComment($comment_id, $text, $created_at);

		return redirect()->route('items.detail',['user_id'=>$request->session()->get('user_id'), 'item_id'=>$request->item_id, 'post_user'=>$request->post_user]);
	}

	public function getDelete()
	{
    $comment_id = $_GET['comment_id'];
		$comment = $this->comment->getComment($comment_id);
		return view('comments.delete_comment')->with('comment',$comment);
	}

	public function deleteComment(Request $request)
	{
		$comment_id = $request->comment_id;
		$comment = $this->comment->deleteComment($comment_id);
		return redirect()->route('items.detail',['user_id'=>$request->session()->get('user_id'), 'item_id'=>$request->item_id, 'post_user'=>$request->post_user]);
	}
}
