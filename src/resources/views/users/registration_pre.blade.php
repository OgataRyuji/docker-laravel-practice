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
  <form class="form_wrap" action="/registration_pre" method="POST">
    <div class="form_header">
      <h1 class="form_header_text">
        会員情報入力(仮登録)
      </h1>
    </div>
    <div class="registration-message">
      <p class="reg-email-message"></p>
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
      @csrf
      <input type="text" class="input-default" id="email" name="email" placeholder="PC・携帯どちらでも可" autofocus="true">
    </div>
    <div class='register-btn'>
      <input type="submit" class="register_red_btn" value="会員登録" name="register_red_btn">
      <input type="hidden" name="token" value="<?php //echo htmlspecialchars($_SESSION['token']) ?>">
    </div>
  </form>
  <footer class="registration_page_footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src="{{ asset('/assets/js/registration_pre.js') }}"></script>
</body>
</html>