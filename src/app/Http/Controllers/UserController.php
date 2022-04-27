<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Mail\SendRegistrationMainMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{
	private $user;
	public function __construct()
	{
		$this->user = new User();
	}
  public function addUser(UserRequest $request)
  {
    /*$rules = [
      'nickname' => ['required',  'string', 'min:5'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
    ];
    $this->validate($request, $rules); */

		$nickname = $request->nickname;
    $password = $request->password;
    $email = $request->email;
		$created_at = now();
		$user = $this->user->insertUser($nickname, $email, $password, $created_at);
    Mail::send(new SendRegistrationMainMail($email));

    return redirect('/registration_main_success');
  }

	public function getlogin()
	{
		return view('users.session');
	}

	public function postlogin(LoginRequest $request)
	{
		/*$rules = [
			'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
		];
		$this->validate($request, $rules); */

		$email = $request->email;
		$password = $request->password;
		$user = $this->user->login($email, $password);
		if ($user) {
			return redirect('/index');
		}elseif(!$user){
      return redirect('/session');
		}
  }

	public function getedit()
	{
		$user_id = $_GET['user_id'];
		$user = $this->user->editUser($user_id);
		return view('users.edit_user')->with('user',$user);
	}

	public function updateuser(EditUserRequest $request)
	{
		//バリデーション
		/*$rules = [
			'nickname' => ['required',  'string', 'min:5'],
			'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
		];
		$this->validate($request, $rules); */

		$user_id = $request->user_id;
		$nickname = $request->nickname;
		$password = $request->password;
		$created_at = now();
		$user = $this->user->updateUser($user_id, $nickname, $password, $created_at);

		return redirect()->route('users.mypage',['user_id'=>$request->user_id]);
	}

	public function getLogout()
	{
		return view('users.logout');
	}

	public function logout()
	{
    session()->flush();
		return redirect('/');
	}

	public function getAdminTop()
	{
		return view('admin.admin_top');
	}

	public function getAdminUser()
	{
		return view('admin.admin_user_data');
	}

	public function csv(Request $request){
    if ($request->has('export-user')){
      $dt_from = new \Carbon\Carbon();
			$dt_from->startOfMonth();

			$dt_to = new \Carbon\Carbon();
			$dt_to->endOfMonth();

			//ファイル名
			$filename = 'laravel_user_data.csv';
			if (!$fp = fopen($filename, 'w')) {
				echo "Cannot open file ($filename)";
				exit;
			}
			$users = User::whereBetween('created_at',[$dt_from, $dt_to])->get();
			foreach ($users as $user) {
				$output_text  = '"';
				$output_text .= $user['id'];
				$output_text .= '","' . $user['nickname'];
				$output_text .= '","' . $user['email'];
				$output_text .= '","' . $user['password'];
				$output_text .= '","' . $user['created_at'];
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
		}elseif($request->has('inport-user')) {
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
			ini_set('max_execution_time', 100);
			foreach($file as $line)
			{
				//$this->validate($data, $rules);
				$validator = validator::make($line,[
					$line[1] => ['string', 'min:5'],
					$line[2] => ['email', 'unique:users,email'],
					$line[3] => ['regex: /^[0-9a-zA-Z]{10,}$/'],
				]);
				if ($validator->fails()){
					return redirect('/admin_user')
					->withErrors($validator)
          ->withInput();
				}
				$data[] = [
					//'id'     => $line[0],
					'nickname'   => $line[1],
					'email'   => $line[2],
					'password'   => $line[3],
					'created_at' => now(),
				];
				if(count($data) >= 1000){
					User::insert($data);
					$data = [];
				}
			}
			return view('admin.admin_user_data');
		}
	}
}
