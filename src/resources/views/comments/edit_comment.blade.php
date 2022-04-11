<?php
  use Illuminate\Support\Facades\Session;
  $login_user = Session::get('user_id');
  if ($login_user < 1) {
    header('Location: /');
  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/assets/css/comment.css')}}">
    <title>PHPの学習</title>
  </head>
  <body>
    <!-- 下記に課題を書く -->
    <header class="edit_page_header">
      <p>サイトタイトル</p>
    </header>
    <form class='form-wrap' action="{{url('/edit_comment')}}" method="POST">
    @csrf
    @foreach($comment as $comment)
      <div class='form-header'>
        <h1 class='form-header-text'>
          コメント変更
        </h1>
      </div>
      <div class="edit-message">
        <p class="reg-comment-message"></p>
      </div>
      <div class="form-group">
        <div class='form-text-wrap'>
          <label class="form-text">コメント</label>
          <span class="indispensable">必須</span>
        </div>
        <input type="text" class="input-default" id="edit-comment" name="edit_comment" autofocus="true" value="{{$comment->text}}">
      </div>
      <div class='edit-btn'>
        <input type="submit" class="edit-red-btn" value="変更" name="edit-comment-btn">
        <input type="hidden" name="item_id" value="{{$_GET['item_id']}}">
        <input type="hidden" name="post_user" value="{{$_GET['post_user']}}">
        <input type="hidden" name="comment_id" value="{{$_GET['comment_id']}}">
        <input type="hidden" name="token" value="<?php //echo htmlspecialchars($_SESSION['token']) ?>">
      </div>
      @endforeach
    </form>
    <footer class="edit_page_footer">
      <p>
        Copyright Website 2022.
      </p>
    </footer>
    <script src=""></script>
  </body>
</html>
