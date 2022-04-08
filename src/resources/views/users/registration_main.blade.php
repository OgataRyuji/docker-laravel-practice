<?php
  use App\Models\Pre_user;
  use Illuminate\Support\Facades\Cookie;

  $user_id = $_GET['user_id'];
  //Cookie::queue('user_id', $id);
  //$user_id = (int)Cookie::get('user_id');
  $user_email = Pre_user::where('id', $user_id)->value('email');
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
  <form class="form_wrap" action="/registration_main" method="POST">
  @csrf
    <div class="form_header">
      <h1 class="form_header_text">
        会員情報入力(本登録)
      </h1>
    </div>
    <div class="registration-message">
      <p class="reg-nickname-message"></p>
      <p class="reg-email-message"></p>
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
      <input type="text" class="input-default" id="nickname" name="nickname" placeholder="例) ウェブタロウ" maxlength="40" autofocus="true">
      <p class='info-text'>※ニックネームはカタカナを使用して5文字以上に設定してください</p>
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">メールアドレス</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="email" name="email" value="{{$user_email}}" readonly>
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">パスワード</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="password" name="password" placeholder="10文字以上の半角英数字">
      <p class='info-text'>※パスワードは英字と数字を使用して10文字以上に設定してください</p>
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">パスワード(確認)</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="password_confirmation" name="password_confirmation" placeholder="同じパスワードを入力して下さい">
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
  <script src="{{ asset('/assets/js/registration_main.js') }}"></script>
</body>
</html>