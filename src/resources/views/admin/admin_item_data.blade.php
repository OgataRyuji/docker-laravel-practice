<?php
  use Illuminate\Support\Facades\Session;
  $login_user = (integer)Session::get('user_id');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('/assets/css/registration.css')}}">
  <title>PHPの学習</title>
	<style>
		.form_header{
			border: none;
		}
	</style>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="registration_page_header">
    <p>サイトタイトル</p>
  </header>
  <form class='form_wrap' action="/admin_item" method="POST" enctype="multipart/form-data">
	@csrf
    <div class='form_header'>
      <h1 class='form_header_text'>
        投稿データエクスポート
      </h1>
    </div>
    <div class='register-btn'>
      <input type="hidden" name="token" value="<?php //echo $_SESSION['token']; ?>">
      <input type="submit" class="register_red_btn" value="エクスポート" name="export-red-btn">
    </div><hr>
    <div class='form_header'>
      <h1 class='form_header_text'>
        投稿データインポート
      </h1>
			<p>外部キー制約を設定していますのでユーザーのインポートを先に行なうか、外部キー制約を無効にしてください。</p>
    </div>
    <div class='register-btn'>
      <input type="hidden" name="token" value="<?php //echo $_SESSION['token']; ?>">
			<input type="file" name="import-file">
      <input type="submit" class="register_red_btn" value="インポート" name="import-red-btn">
    </div>
  </form>
  <footer class="registration_page_footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src=""></script>
</body>
</html>