<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('/assets/css/index.css')}}">
  <title>PHPの学習</title>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="top_page_header">
    <p>サイトタイトル</p>
  </header>
  <div class="main">
    <div>
      <ul class="main_list">
        <li>
          <a href="{{ url('/session') }}" class="login">ログイン</a>
        </li>
        <li>
          <a href="{{ url('/registration_pre') }}" class="sign_up_pre">新規仮登録</a>
        </li>
      </ul>
    </div>
    <div class="total_user">
      <h4>今月の総会員登録者数</h4>
      <p>{{$userCount}}人</p>
		</div>
		<div class="total_item">
      <h4>今月の累計投稿数</h4>
      <p>{{$itemCount}}件</p>
		</div>
  </div>

  <footer class="top_page_footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src=""></script>
</body>
</html>