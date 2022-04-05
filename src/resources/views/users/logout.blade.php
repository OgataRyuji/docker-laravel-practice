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
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="registration_page_header">
    <p>サイトタイトル</p>
  </header>
  <form class="form_wrap" action="/logout" method="POST">
  @csrf
    <div class="form_header">
      <h1 class="form_header_text">
        ログアウトしますか？
      </h1>
    </div>
    <div class='register-btn'>
      <input type="hidden" name="user_id" value="{{$login_user}}">
      <input type="submit" class="register_red_btn" value="ログアウト" name="logout_red_btn">
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