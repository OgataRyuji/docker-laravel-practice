"use strict";

const reg_email = /^[A-Za-z0-9_.-]+@([0-9a-zA-Z][0-9a-zA-Z.-]*[0-9a-zA-Z]*\.)+([a-zA-Z.]*[a-zA-Z])$/g;
const register_red_btn = document.querySelector('.register_red_btn');
register_red_btn.disabled = true;

const email = document.getElementById('email');
const reg_email_message = document.querySelector('.reg-email-message');
email.addEventListener('change', function(){
  if (reg_email.test(email.value)) {
    reg_email_message.innerHTML = '';
    register_red_btn.disabled = false;
  }else if (!reg_email.test(email.value)) {
    reg_email_message.innerHTML = 'メールアドレスの入力が間違っています';
    email.value = '';
  }
},false);