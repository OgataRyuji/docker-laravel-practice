"use strict";

const article_title = document.getElementById('article-title');
const article_explain = document.getElementById('article-explain');
const new_message = document.querySelector('.new-message');
const send_blue_btn = document.querySelector('.send-blue-btn');
send_blue_btn.disabled = true;
article_title.addEventListener('change', function(){
  check_null();
},false);

article_explain.addEventListener('change', function(){
  check_null()
},false);

function check_null(){
  if ((article_title.value !== '') && (article_explain.value !== '')) {
    send_blue_btn.disabled = false;
    new_message.innerHTML = '';
  }else{
    send_blue_btn.disabled = true;
    new_message.innerHTML = '記事タイトルもしくは記事内容が空欄です';
  }
}