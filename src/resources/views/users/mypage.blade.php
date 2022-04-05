<?php
  use Illuminate\Support\Facades\Session;
  $login_user = (integer)Session::get('user_id');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/show_item.css')}}">
  <title>PHPの学習</title>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="items-index-page-header">
    <div class="title-box">
      <p class="items-page-title">サイトタイトル</p>
    </div>
    <div class="link-box">
      <?php //if($id === '1'){?>
        <a href="../admin/admin_top.php?user_id=<?php //echo $id;?>" class="owner_btn">管理者ページ</a>
      <?php //}?>
      <a href="/edit_user?user_id={{$login_user}}" class="change-user-info">ユーザー情報変更</a>
      <a href="/logout?user_id={{$login_user}}" class="mypage-logout-btn">ログアウト</a>
    </div>
  </header>
  <div class="main">
    <div class="contents">
      @foreach($items as $item)
        <a href="/detail?user_id={{$login_user}}&item_id={{$item->id}}&post_user={{$item->user_id}}">
          <div class="content-post">
            <div class="content-title">
              <h2>{{ $item->item_title }}</h2>
              <p>{{ $item->user->nickname }}</p>
            </div>
            <div class="content-explain">
              <p>{{ $item->item_explain }}</p>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
  <footer class="items-index-page-footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src=""></script>
</body>
</html>