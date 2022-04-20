<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{
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
     *
     * '/api/user'に'POST'形式でアクセスすると、'storeUser'メソッドが動く
     * '/api/item'に'POST'形式でアクセスすると、'storeItem'メソッドが動く
     * '/api/comment'に'POST'形式でアクセスすると、'storeComment'メソッドが動く
     */
    public function storeUser(Request $request)
    {
      $user = new User;
			$rules = [
				'nickname' => ['required',  'string', 'min:5'],
				'email' => ['required', 'email', 'unique:users'],
				'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
			];
			$this->validate($request, $rules);
      $user->nickname = $request->nickname;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->created_at = now();
      $user->save();
			return response()->json($user);
    }

		public function storeItem(Request $request)
    {
      $item = new Item;
      $rules = [
        'item_title' => ['required','string'],
        'item_explain' => ['required','string']
      ];
      $this->validate($request, $rules);
      $item->item_title = $request->item_title;
      $item->item_explain = $request->item_explain;
      $item->created_at = now();
      $item->user_id = $request->user_id;
      $item->save();

      return response()->json($item);
    }

		public function storeComment(Request $request)
    {
      $comment = new Comment;
      $rules = [
        'text' => ['required','string'],
      ];
      $this->validate($request, $rules);
      $comment->text = $request->text;
      $comment->created_at = now();
      $comment->user_id = $request->user_id;
      $comment->item_id = $request->item_id;
      $comment->save();

      return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * '/api/user'に'GET'形式でアクセスすると、'showUser'メソッドが動く
     * '/api/item'に'GET'形式でアクセスすると、'showUser'メソッドが動く
     * '/api/comment'に'GET'形式でアクセスすると、'showUser'メソッドが動く
     */
    public function showUser(Request $request)
    {
      //$user = User::find($request->id);
			$user = User::all();
			return response()->json($user);
    }

		public function showItem(Request $request)
    {
      $item = Item::all();
      return response()->json($item);
    }

		public function showComment(Request $request)
    {
      $comment = Comment::all();
      return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * '/api/user'に'PUT'形式でアクセスすると、'updateUser'メソッドが動く
     * '/api/item'に'PUT'形式でアクセスすると、'updateItem'メソッドが動く
     * '/api/comment'に'PUT'形式でアクセスすると、'updateComment'メソッドが動く
     */
    public function updateUser(Request $request)
    {
			$rules = [
				'nickname' => ['required',  'string', 'min:5'],
				'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
			];
			$this->validate($request, $rules);

			$user = User::find($request->id);
      $user->nickname = $request->nickname;
      $user->password = Hash::make($request->password);
      $user->created_at = now();
      $user->save();

			return response()->json($user);
    }

		public function updateItem(Request $request)
    {
      $rules = [
        'item_title' => ['required','string'],
        'item_explain' => ['required','string']
      ];
      $this->validate($request, $rules);

      $item = Item::find($request->id);
      $item->item_title = $request->item_title;
      $item->item_explain = $request->item_explain;
      $item->created_at = now();
      $item->user_id = $request->user_id;
      $item->save();

      return response()->json($item);
    }

		public function updateComment(Request $request)
    {
      $rules = [
        'text' => ['required','string'],
      ];
      $this->validate($request, $rules);

      $comment = Comment::find($request->id);
      $comment->text = $request->text;
      $comment->created_at = now();
      $comment->save();

      return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * '/api/user'に'DELETE'形式でアクセスすると、'destroyUser'メソッドが動く
     * '/api/item'に'DELETE'形式でアクセスすると、'destroyItem'メソッドが動く
     * '/api/comment'に'DELETE'形式でアクセスすると、'destroyComment'メソッドが動く
     */
    public function destroyUser(Request $request)
    {
      $user = User::find($request->id);
			$user->delete();
			return response()->json(User::all());
    }

		public function destroyItem(Request $request)
    {
      $item = Item::find($request->id);
      $item->delete();
      return response()->json(Item::all());
    }

		public function destroyComment(Request $request)
    {
      $comment = Comment::find($request->id);
      $comment->delete();
      return response()->json(Comment::all());
    }

    public function apiHello()
    {
      return 'Hello World';
    }


}
