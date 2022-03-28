<?php

namespace App\Http\Controllers;

use App\Models\Item;

//use Illuminate\Http\Request;

class ItemController extends Controller
{
	public function testitem()
	{
		$item = Item::count();
		return view('index')->with(['data'=>$item]);
	}
}
