<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;
	public $timestamps = false;//暗黙的にタイムスタンプをする機能をオフにする

	protected $fillable = [
		'item_title',
		'item_explain',
		'user_id',
		'created_at',
	];

	public function user(){
		return $this->belongsTo('App\Models\User');
	}

	public function comments(){
		return $this->hasMany('App\Models\Comment');
	}

	public function showItem($searchTitle, $searchExplain)
	{
		return Item::where('item_title','LIKE','%'.$searchTitle.'%')->where('item_explain','LIKE','%'.$searchExplain.'%')->orderBy('created_at', 'DESC')->paginate(2);
	}

	public function insertItem($item_title, $item_explain, $created_at, $user_id)
	{
    return $this->create([
      'item_title'=>$item_title,
			'item_explain'=>$item_explain,
			'created_at'=>$created_at,
			'user_id'=>$user_id,
		]);
	}

	public function getItem($item_id)
	{
    $item = Item::where('id',$item_id)->get();
		return $item;
	}

	public function updateItem($item_id, $item_title, $item_explain, $created_at)
	{
    Item::where('id',$item_id)->update([
			'item_title'=>$item_title,
			'item_explain'=>$item_explain,
			'created_at'=>$created_at,
		]);

		return Item::where('id', $item_id)->get();
	}

	public function deleteItem($item_id)
	{
		$item = Item::find($item_id)->delete();
		return $item;
	}

	public function mypage($user_id)
	{
    $items = Item::where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
		return $items;
	}

	public function getAllItem()
	{
    return Item::all();
	}
}
