<?php
  use Illuminate\Support\Facades\Session;
  $login_user = (integer)Session::get('user_id');
  if ($login_user !== 16) {
    header('Location: /');
  }
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
  <header class="admin_page_header">
    <p>サイトタイトル</p>
    <a href="/index?user_id={{$login_user}}">アイテム一覧ページ</a>
  </header>
  <form class="form_wrap" action="/admin_top" method="GET">
    <div class="form_header">
      <h1 class="form_header_text">
        管理者トップページ
      </h1>
    </div>
    <div class='register-btn'>
      <a href="/admin_user?user_id={{$login_user}}" class="admin_btn admin_user_btn">ユーザーデータ管理画面</a>
    </div>
    <div class='register-btn'>
      <a href="/admin_item?user_id={{$login_user}}" class="admin_btn admin_item_btn">投稿データ管理画面</a>
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