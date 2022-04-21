<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{
  private $user;
  private $item;
  private $comment;
	public function __construct()
	{
		$this->user = new User();
    $this->item = new Item();
    $this->comment = new Comment();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
      //$user = new User;
			$rules = [
				'nickname' => ['required',  'string', 'min:5'],
				'email' => ['required', 'email', 'unique:users'],
				'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
			];
			$this->validate($request, $rules);
      /*
      $user->nickname = $request->nickname;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->created_at = now();
      $user->save(); */

      $nickname = $request->nickname;
      $email = $request->email;
      $password = Hash::make($request->password);
      $created_at = now();
      $user = $this->user->insertUser($nickname, $email, $password, $created_at);

			return response()->json($user);
    }

		public function storeItem(Request $request)
    {
      //$item = new Item;
      $rules = [
        'item_title' => ['required','string'],
        'item_explain' => ['required','string']
      ];
      $this->validate($request, $rules);
      /*
      $item->item_title = $request->item_title;
      $item->item_explain = $request->item_explain;
      $item->created_at = now();
      $item->user_id = $request->user_id;
      $item->save(); */

      $item_title = $request->item_title;
      $item_explain = $request->item_explain;
      $created_at = now();
      $user_id = $request->user_id;
      $item = $this->item->insertItem($item_title, $item_explain, $created_at, $user_id);

      return response()->json($item);
    }

		public function storeComment(Request $request)
    {
      //$comment = new Comment;
      $rules = [
        'text' => ['required','string'],
      ];
      $this->validate($request, $rules);
      /*
      $comment->text = $request->text;
      $comment->created_at = now();
      $comment->user_id = $request->user_id;
      $comment->item_id = $request->item_id;
      $comment->save(); */

      $text = $request->text;
      $created_at = now();
      $user_id = $request->user_id;
      $item_id = $request->item_id;
      $comment = $this->comment->insertComment($text, $created_at, $user_id, $item_id);

      return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser(Request $request)
    {
			//$user = User::all();
      $user = $this->user->getAllUser();
			return response()->json($user);
    }

		public function showItem(Request $request)
    {
      //$item = Item::all();
      $item = $this->item->getAllItem();
      return response()->json($item);
    }

		public function showComment(Request $request)
    {
      //$comment = Comment::all();
      $comment = $this->comment->getAllComment();
      return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
			$rules = [
				'nickname' => ['required',  'string', 'min:5'],
				'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
			];
			$this->validate($request, $rules);

      /*
			$user = User::find($request->id);
      $user->nickname = $request->nickname;
      $user->password = Hash::make($request->password);
      $user->created_at = now();
      $user->save(); */

      $user_id = $request->id;
      $nickname = $request->nickname;
      $password = Hash::make($request->password);
      $created_at = now();
      $user = $this->user->updateUser($user_id, $nickname, $password, $created_at);

			return response()->json($user);
    }

		public function updateItem(Request $request)
    {
      $rules = [
        'item_title' => ['required','string'],
        'item_explain' => ['required','string']
      ];
      $this->validate($request, $rules);

      /*
      $item = Item::find($request->id);
      $item->item_title = $request->item_title;
      $item->item_explain = $request->item_explain;
      $item->created_at = now();
      $item->user_id = $request->user_id;
      $item->save(); */

      $item_id = $request->id;
      $item_title = $request->item_title;
      $item_explain = $request->item_explain;
      $created_at = now();

      $item = $this->item->updateItem($item_id, $item_title, $item_explain, $created_at);

      return response()->json($item);
    }

		public function updateComment(Request $request)
    {
      $rules = [
        'text' => ['required','string'],
      ];
      $this->validate($request, $rules);

      /*
      $comment = Comment::find($request->id);
      $comment->text = $request->text;
      $comment->created_at = now();
      $comment->save(); */

      $comment_id = $request->id;
      $text = $request->text;
      $created_at = now();

      $comment = $this->comment->updateComment($comment_id, $text, $created_at);

      return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser(Request $request)
    {
      /*
      $user = User::find($request->id);
			$user->delete(); */

      $user_id = $request->id;
      $user = $this->user->deleteUser($user_id);
			return response()->json($this->user->getAllUser());
    }

		public function destroyItem(Request $request)
    {
      /*
      $item = Item::find($request->id);
      $item->delete(); */

      $item_id = $request->id;
      $item = $this->item->deleteItem($item_id);
      return response()->json($this->item->getAllItem());
    }

		public function destroyComment(Request $request)
    {
      /*
      $comment = Comment::find($request->id);
      $comment->delete(); */

      $comment_id = $request->id;
      $comment = $this->comment->deleteComment($comment_id);
      return response()->json($this->comment->getAllComment());
    }

    public function apiHello()
    {
      return 'Hello World';
    }


}
