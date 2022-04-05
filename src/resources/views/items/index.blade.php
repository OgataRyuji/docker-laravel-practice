<?php
  use Illuminate\Support\Facades\Session;
  $login_user = Session::get('user_id');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('/assets/css/show_item.css')}}">
  <title>PHPの学習</title>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="items-index-page-header">
    <div class="title-box">
      <p class="items-page-title">サイトタイトル</p>
    </div>
    <div class="link-box">
      <a href="/mypage?user_id={{$login_user}}" class="go-mypage">マイページ</a>
      <a href="/item_new" class="go-new-item">投稿する</a>
      <a href="/logout?user_id={{$login_user}}" class="logout-btn">ログアウト</a>
    </div>
  </header>
  <div class="main">
    <h2 class="form-title">検索</h2>
    <form action="../items/serch.php" method="GET" class="serch-form">
      <label for="">記事タイトル：</label>
      <input type="text" name="serch_item_title"><br>
      <label for="">記事内容：</label>
      <input type="text" name="serch_item_explain"><br>
      <input type="submit" name="serch-submit" value="記事を検索する">
      <input type="hidden" name="token" value="<?php //echo htmlspecialchars($_SESSION['token']) ?>">
    </form>
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

  <p class="form-to"><?php //echo $count['cnt']; ?>件中 <?php //echo $from_record; ?> - <?php //echo $to_record;?> 件目を表示</p>
  <div class="pagination">
    <?php //if($page >= 2): ?>
      <a href="index.php?page=<?php //echo($page - 1);?>" class="page-feed">&laquo;</a>
    <?php //else : ;?>
      <span class="first-last-page">&laquo;</span>
    <?php //endif; ?>
    <?php //for($i = 1; $i <= $max_page; $i++) : ?>
      <?php //if($i >= $page - $range && $i <= $page + $range) : ?>
        <?php //if($i === $page) : ?>
          <span class="now-page-number"><?php //echo $i; ?></span>
        <?php //else: ?>
          <a href="?page=<?php //echo $i; ?>" class="page-number"><?php //echo $i; ?></a>
        <?php //endif; ?>
      <?php //endif; ?>
    <?php //endfor; ?>
    <?php //if($page < $max_page) : ?>
      <a href="index.php?page=<?php //echo($page + 1); ?>" class="page-feed">&raquo;</a>
    <?php //else : ?>
      <span class="forst-last-page">&raquo;</span>
    <?php //endif; ?>
  </div>
  <footer class="items-index-page-footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src=""></script>
</body>
</html>
