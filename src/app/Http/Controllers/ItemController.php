<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
	private $item;
	public function __construct()
	{
		$this->item = new Item();
		$this->comment = new Comment();
	}
	public function showitem(Request $request)
	{

    $searchTitle = $request->serch_title;
		$searchExplain = $request->search_explain;

		$items = $this->item->showItem($searchTitle, $searchExplain);
		return view('items.index')->with('items',$items);
	}

	public function getnew()
	{
		return view('items.new');
	}

	public function postitem(Request $request)
	{
		$login_user = Session::get('user_id');

		//バリデーション
		$rules = [
			'item_title' => ['required','string'],
			'item_explain' => ['required','string']
    ];
		$this->validate($request, $rules);

		$item_title = $request->item_title;
		$item_explain = $request->item_explain;
		$created_at = now();
		$user_id = $login_user;
		$item = $this->item->insertItem($item_title, $item_explain, $created_at, $user_id);

		return redirect('/index');
	}

	public function getdetail()
	{
    $item_id = $_GET['item_id'];
		$item = $this->item->getItem($item_id);
		$comments = $this->comment->itemDetailComment($item_id);
		return view('items.detail')->with([
      'item'=>$item,
			'comments'=>$comments
		]);
	}

	public function getedit()
	{
    $item_id = $_GET['item_id'];
		$item = $this->item->getItem($item_id);
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
		$item_id = $request->edit_item_id;
		$item_title = $request->item_title;
		$item_explain = $request->item_explain;
		$created_at = now();

		$item = $this->item->updateItem($item_id, $item_title, $item_explain, $created_at);

		return redirect('/index');
	}

	public function getdelete()
	{
    $item_id = $_GET['item_id'];
		$item = $this->item->getItem($item_id);
		return view('items.delete')->with('item',$item);
	}

	public function deleteitem(Request $request)
	{
		$item_id = $request->item_id;
		$item = $this->item->deleteItem($item_id);
		return redirect('/index');
	}

	public function getmypage()
	{
		$user_id = $_GET['user_id'];
    $items = $this->item->mypage($user_id);
		return view('users.mypage')->with('items',$items);
	}

	public function getAdminItem()
	{
		return view('admin.admin_item_data');
	}

	public function csv(Request $request){
		if ($request->has('export-red-btn')){
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
		}elseif ($request->has('import-red-btn')) {
			// アップロードファイルのファイルパスを取得
			$file_path = $_FILES['import-file']['tmp_name'];
			// CSV取得
			$file = new \SplFileObject($file_path);
			$file->setFlags(
				\SplFileObject::READ_CSV |// CSVとして行を読み込み
				\SplFileObject::READ_AHEAD |// 先読み／巻き戻しで読み込み
				\SplFileObject::SKIP_EMPTY | // 空行を読み飛ばす
				\SplFileObject::DROP_NEW_LINE// 行末の改行を読み飛ばす
			);
			// 一行ずつ処理
			$data =[];
			foreach($file as $line)
			{
				$data[] = [
					//'id'     => $line[0],
					'item_title'   => $line[1],
					'item_explain'   => $line[2],
					'created_at' => now(),
					'user_id'=> $line[3],
				];
				if(count($data) >= 1000){
					Item::insert($data);
					$data = [];
				}
			}
			return view('admin.admin_item_data');
		}
	}
}
