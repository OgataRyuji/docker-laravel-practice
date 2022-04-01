<?php
  use Illuminate\Support\Facades\Session;
  $login_user = (integer)Session::get('user_id');
  $post_user = (integer)$_GET['post_user'];
  $user_id = $_GET['user_id'];
  $item_id = $_GET['item_id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/detail.css')}}">
  <title>PHPの学習</title>
  <style>
    
  </style>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="items-index-page-header">
    <div class="title-box">
      <p class="items-page-title">サイトタイトル</p>
    </div>
    <div class="link-box">
      <a href="../users/edit.php" class="change-user-info">ユーザー情報変更</a>
      <a href="../users/logout.php?user_id=<?php //echo $id;?>" class="logout-btn">ログアウト</a>
    </div>
  </header>
  <div class="main">
    <div class="contents">
      <?php //echo $member; ?>
      @foreach($item as $item)
      <div class="content-post" name="content-post">
        <div class="content-title">
          <h2>{{$item->item_title}}</h2>
          <p>投稿ユーザー：{{$item->user->nickname}}</p>
          <p>投稿日：{{$item->created_at}}</p>
        </div>
        <div class="content-explain">
          <p>{{$item->item_explain}}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="btn-box">
      @if($login_user === $post_user)
        <a href="/edit_item?user_id={{$login_user}}&item_id={{$item_id}}&post_user={{$post_user}}" class="edit-page-btn">編集</a>
        <a href="/delete?user_id={{$login_user}}&item_id={{$item_id}}&post_user={{$post_user}}" class="delete-btn">削除</a>
      @endif
    </div>
  </div>
  <div class="comment-area">
    <div class="comments">
      <?php //echo $member2; ?>
    </div>
    <form action="detail.php" method="POST" class="input-comment-form">
      <input type="text" class="input-comment" name="input-comment">
      <input type="submit" class="send-comment-btn" name="send-comment-btn" value="コメント">
      <input type="hidden" name="comment-item-id" value="<?php //echo $_GET['item_id'];?>">
      <input type="hidden" name="token" value="<?php //echo htmlspecialchars($_SESSION['token']) ?>">
    </form>
  </div>
  <footer class="mypage-footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src=""></script>
</body>
</html>