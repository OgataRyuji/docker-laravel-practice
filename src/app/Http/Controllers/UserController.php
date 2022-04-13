<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Mail\SendRegistrationMainMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
  public function addUser(Request $request)
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

    $email = $request->email;
    Mail::send(new SendRegistrationMainMail($email));

    return redirect('/registration_main_success');
  }

	public function getlogin()
	{
		return view('users.session');
	}

	public function postlogin(Request $request)
	{
		$rules = [
			'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
		];
		$this->validate($request, $rules);

		$hashedPassword = User::where('email', $request->email)->value('password');
		$user_id = User::where('email', $request->email)->value('id');
		if (password_verify($request->password, $hashedPassword)) {
			Session::put('user_id',$user_id);
			return redirect('/index');
		}else{
			return redirect('/session');
		}
  }

	public function getedit()
	{
		$user_id = $_GET['user_id'];
		$user = User::where('id',$user_id)->get();
		return view('users.edit_user')->with('user',$user);
	}

	public function updateuser(Request $request)
	{
		//バリデーション
		$rules = [
			'nickname' => ['required',  'string', 'min:5'],
			'password' => ['required', 'regex: /^[0-9a-zA-Z]{10,}$/']
		];
		$this->validate($request, $rules);

    $user = User::find($request->user_id);
		$user->nickname = $request->nickname;
		$user->password = Hash::make($request->password);
		$user->created_at = now();
		$user->save();

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

	public function csvExport()
	{
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
		return redirect('/admin_user');
	}

}
