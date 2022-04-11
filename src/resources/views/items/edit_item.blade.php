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
  <link rel="stylesheet" href="{{asset('/assets/css/item.css')}}">
  <title>PHPの学習</title>
</head>
<body>
  <!-- 下記に課題を書く -->
  <header class="new_page_header">
    <p>サイトタイトル</p>
  </header>
  <form class='form-wrap' action="{{url('/edit_item')}}" method="post">
	@csrf
  @foreach($item as $item)
    <div class='form-header'>
      <h1 class='form-header-text'>
        編集する
      </h1>
    </div>
    <p class="new-message"></p>
    @if ($errors->any())
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
      @endif
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">記事タイトル</label>
        <span class="indispensable">必須</span>
      </div>
      <input type="text" class="input-default" id="article-title" name="item_title" autofocus="true" value='{{$item->item_title}}'>
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">記事内容</label>
        <span class="indispensable">必須</span>
      </div>
      <textarea id="article-explain" name="item_explain" cols="30" rows="10" class="input-default-textarea">{{$item->item_explain}}</textarea>
    </div>
    <div class='send-btn'>
      <input type="submit" class="send-blue-btn" value="SEND" name="edit-blue-btn">
      <input type="hidden" name="edit_item_id" value="{{$_GET['item_id']}}">
			<input type="hidden" name="item_id" value="{{$_GET['item_id']}}">
      <input type="hidden" name="token" value="<?php //echo htmlspecialchars($_SESSION['token']) ?>">
    </div>
    @endforeach
  </form>
  <footer class="new_page_footer">
    <p>
      Copyright Website 2022.
    </p>
  </footer>
  <script src=""></script>
</body>
</html>
