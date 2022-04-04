<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class ItemController extends Controller
{
	public function showitem()
	{
		$items = Item::orderBy('created_at', 'DESC')->get();
		return view('items.index')->with('items',$items);
	}

	public function getnew()
	{
		return view('items.new');
	}

	public function postitem(Request $request)
	{
		$login_user = Session::get('user_id');
    $item = new Item;

		//バリデーション
		$rules = [
			'item_title' => ['required','string'],
			'item_explain' => ['required','string']
    ];
		$this->validate($request, $rules);

		$item->item_title = $request->item_title;
    $item->item_explain = $request->item_explain;
    $item->created_at = now();
		$item->user_id = $login_user;
    $item->save();

		return redirect('/index');
	}

	public function getdetail()
	{
    $item_id = $_GET['item_id'];
		$item = Item::where('id',$item_id)->get();
		$comments = Comment::orderBy('created_at', 'DESC')->get();
		return view('items.detail')->with([
      'item'=>$item,
			'comments'=>$comments
		]);
	}

	public function getedit()
	{
    $item_id = $_GET['item_id'];
		$item = Item::where('id',$item_id)->get();
		return view('items.edit_item')->with('item',$item);
	}

	public function updateitem(Request $request)
	{
		//バリデーション
		$rules = [
			'item_title' => ['required','string'],
			'item_explain' => ['required','string']
    ];
		$this->validate($request, $rules);

    $item = Item::find($request->edit_item_id);
		$item->item_title = $request->item_title;
		$item->item_explain = $request->item_explain;
		$item->created_at = now();
		$item->user_id = Session::get('user_id');
		$item->save();

		return redirect('/index');
	}

	public function getdelete()
	{
    $item_id = $_GET['item_id'];
		$item = Item::where('id',$item_id)->get();
		return view('items.delete')->with('item',$item);
	}

	public function deleteitem(Request $request)
	{
    Item::find($request->item_id)->delete();
		return redirect('/index');
	}

	public function getmypage()
	{
		$user_id = $_GET['user_id'];
		$items = Item::where('user_id',$user_id)->get();
		return view('users.mypage')->with('items',$items);
	}
}
