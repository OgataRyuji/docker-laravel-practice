<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Pagination\Paginator;

class ItemController extends Controller
{
	public function showitem()
	{
		$items = Item::orderBy('created_at', 'DESC')->paginate(4);
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
		$comments = Comment::where('item_id',$item_id)->orderBy('created_at', 'DESC')->get();
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
		$items = Item::where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
		return view('users.mypage')->with('items',$items);
	}

	public function searchItem(Request $request)
	{
		$searchTitle = $request->serch_title;
		$searchExplain = $request->search_explain;
		$items = Item::where('item_title','LIKE','%'.$searchTitle.'%')->where('item_explain','LIKE','%'.$searchExplain.'%')->orderBy('created_at', 'DESC')->paginate(4);
		return view('items.index')->with('items',$items);
	}

	public function getAdminItem()
	{
		return view('admin.admin_item_data');
	}

	public function csvExport()
	{
		$dt_from = new \Carbon\Carbon();
    $dt_from->startOfMonth();

    $dt_to = new \Carbon\Carbon();
    $dt_to->endOfMonth();

    //ファイル名
    $filename = 'laravel_item_data.csv';
    if (!$fp = fopen($filename, 'w')) {
      echo "Cannot open file ($filename)";
      exit;
    }
		$items = Item::whereBetween('created_at',[$dt_from, $dt_to])->get();
		foreach ($items as $item) {
			$output_text  = '"';
			$output_text .= $item['id'];
			$output_text .= '","' . $item['item_title'];
			$output_text .= '","' . $item['item_explain'];
			$output_text .= '","' . $item['created_at'];
			$output_text .= '","' . $item['user_id'];
			$output_text .= '"';
			$output_text .= "\n";

			if (fwrite($fp, mb_convert_encoding($output_text, "UTF-8")) === false) {
					break;
			}
		}
		fclose($fp);

		/* ファイルの存在確認 */
		if (!file_exists($filename)){
			die("Error: File(".$filename.") does not exist");
		}
		/* オープンできるか確認 */
		if (!($fp = fopen($filename, "r"))){
			die("Error: Cannot open the file(".$filename.")");
		}
		fclose($fp);

		/* ファイルサイズの確認 */
		if (($content_length = filesize($filename)) === 0){
			die("Error: File size is 0.(".$filename.")");
		}

		/* ダウンロード用のHTTPヘッダー送信 */
		header("Cache-Control: private");
		header("Pragma: private");
		header('Content-Description: File Transfer');
		header("Content-Disposition: inline; filename=\"".basename($filename)."\"");
		header("Content-Length: ".$content_length);
		header("Content-Type: application/octet-stream");
		header('Content-Transfer-Encoding: binary');

		/* ファイルを読んで出力 */
		if (!readfile($filename)){
			die("Cannot read the file(".$filename.")");
		}
		return redirect('/admin_item');
	}
}
