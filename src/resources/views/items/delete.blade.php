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
  <form class='form-wrap' action="/delete" method="post">
  @csrf
  @foreach($item as $item)
    <div class='form-header'>
      <h1 class='form-header-text'>
        削除する
      </h1>
    </div>
    <p class="new-message"></p>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">記事タイトル</label>
      </div>
      <input type="text" class="input-default" id="article-title" name="article-title" value="{{$item->item_title}}" readonly>
    </div>
    <div class="form-group">
      <div class='form-text-wrap'>
        <label class="form-text">記事内容</label>
      </div>
      <textarea id="article-explain" name="article-explain" cols="30" rows="10" class="input-default-textarea" readonly>{{$item->item_explain}}</textarea>
    </div>
    <div class='send-btn'>
      <input type="submit" class="send-blue-btn" value="DELETE" name="delete-blue-btn">
      <input type="hidden" name="item_id" value="{{$_GET['item_id']}}">
      <input type="hidden" name="delete-item-id" value="<?php //echo $itemId;?>">
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
