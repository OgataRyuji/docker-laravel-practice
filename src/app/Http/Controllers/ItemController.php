<?php

namespace App\Http\Controllers;

use App\Models\Item;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

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
		$user_id = $_GET['user_id'];
    $item_id = $_GET['item_id'];
		$post_user = $_GET['post_user'];
		$item = Item::where('id',$item_id)->get();
		return view('items.detail')->with('item',$item);
	}
}
