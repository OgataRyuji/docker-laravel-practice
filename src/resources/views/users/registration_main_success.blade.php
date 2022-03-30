<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHPの学習</title>
  <style>
    html{
      background-color: #f5f5f5;
    }
    body{
      margin: 0;
    }
    .registration_page_header{
      background-color: white;
    }
    .registration_page_header p{
      margin: 0;
      height: 60px;
      text-align: center;
      padding-top: 5%;
      font-size: 30px;
      font-weight: bold;
    }
    .form_wrap{
      border: 1px solid black;
      text-align: center;
      width: 80%;
      margin-top: 10%;
      margin-right: 10%;
      margin-left: 10%;
      background-color: white;
    }
    .form_header{
      border-bottom: 1px solid silver;
    }
    .register-btn{
      margin: 20px;
      height: 40px;
    }
    .register_red_btn{
      height: 100%;
      width: 200px;
      background-color: red;
      color: white;
      border: none;
      cursor:pointer
    }
    .registration_page_footer p{
      height: 40px;
      margin: 0;
      text-align: center;
      padding-top: 10px;
      color: silver;
    }
  </style>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="registration_page_header">
    <p>サイトタイトル</p>
  </header>
  <form class="form_wrap" action="session.php" method="POST">
    <div class="form_header">
      <h1 class="form_header_text">
        本会員登録完了
      </h1>
    </div>
    <div class='register-btn'>
      <input type="submit" class="register_red_btn" value="ログインページへ" name="register_red_btn">
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