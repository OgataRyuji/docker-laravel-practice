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
    <form class='form_wrap' action="{{url('/edit_user')}}" method="POST">
    @csrf
    @foreach($user as $user)
      <div class='form_header'>
        <h1 class='form-header-text'>
          会員情報変更
        </h1>
      </div>
      <div class="edit-message">
        <p class="reg-nickname-message"></p>
        <p class="reg-password-message"></p>
        <p class="compare-password-message"></p>
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
          <label class="form-text">ニックネーム</label>
          <span class="indispensable">必須</span>
        </div>
        <input type="text" class="input-default" id="edit-nickname" name="nickname" autofocus="true" value="{{$user->nickname}}">
        <p class='info-text'>※ニックネームはカタカナを使用して5文字以上に設定してください</p>
      </div>
      <div class="form-group">
        <div class='form-text-wrap'>
          <label class="form-text">パスワード</label>
          <span class="indispensable">必須</span>
        </div>
        <input type="text" class="input-default" id="edit-password" name="password" placeholder="">
        <p class='info-text'>※パスワードは英字と数字を使用して10文字以上に設定してください</p>
      </div>
      <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">パスワード(確認)</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="edit-password-confirmation" name="edit-password-confirmation" placeholder="同じパスワードを入力して下さい">
    </div>
      <div class='register-btn'>
        <input type="submit" class="register_red_btn" value="変更" name="edit-red-btn">
        <input type="hidden" name="token" value="<?php //echo htmlspecialchars($_SESSION['token']) ?>">
        <input type="hidden" name='user_id' value="{{$_GET['user_id']}}">
      </div>
    @endforeach
    </form>
    <footer class="registration_page_footer">
      <p>
        Copyright Website 2022.
      </p>
    </footer>
    <script src="{{ asset('/assets/js/user_edit.js') }}"></script>
  </body>
</html>
