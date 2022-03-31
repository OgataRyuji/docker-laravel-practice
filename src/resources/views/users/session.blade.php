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
  <form class='form_wrap' action="/session" method="POST">
  @csrf
    <div class='form_header'>
      <h1 class='form_header_text'>
        会員情報入力
      </h1>
    </div>
    <div class="login-message">

      <p class="reg-email-message"></p>
      <p class="reg-password-message"></p>
      @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">メールアドレス</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="email" name="email" placeholder="PC・携帯どちらでも可" autofocus="true">
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">パスワード</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="password" name="password" placeholder="">
    </div>
    <div class='register-btn'>
      <input type="hidden" name="token" value="<?php //echo $_SESSION['token']; ?>">
      <input type="submit" class="register_red_btn" value="ログイン" name="login-red-btn">
    </div>
  </form>
  <footer class="registration_page_footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src="{{ asset('/assets/js/session.js') }}"></script>
</body>
</html>