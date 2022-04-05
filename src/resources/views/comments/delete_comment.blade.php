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
    <form class='form-wrap' action="{{url('/delete_comment')}}" method="POST">
    @csrf
    @foreach($comment as $comment)
      <div class='form-header'>
        <h1 class='form-header-text'>
          コメント削除
        </h1>
      </div>
      <div class="edit-message">
        <p class="reg-comment-message"></p>
      </div>
      <div class="form-group">
        <div class='form-text-wrap'>
          <label class="form-text">コメント</label>
        </div>
        <input type="text" class="input-default" id="edit-comment" name="edit-comment" readonly value="{{$comment->text}}">
      </div>
      <div class='edit-btn'>
        <input type="submit" class="edit-red-btn" value="削除" name="delete-comment-btn">
        <input type="hidden" name="item_id" value="{{$_GET['item_id']}}">
        <input type="hidden" name="post_user" value="{{$_GET['post_user']}}">
        <input type="hidden" name="comment_id" value="{{$_GET['comment_id']}}">
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