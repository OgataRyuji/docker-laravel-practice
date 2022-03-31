"use strict";

const reg_email = /^[A-Za-z0-9_.-]+@([0-9a-zA-Z][0-9a-zA-Z.-]*[0-9a-zA-Z]*\.)+([a-zA-Z.]*[a-zA-Z])$/g;
const reg_password = /^[0-9a-zA-Z]{10,}$/g;
const login_btn = document.querySelector('.register_red_btn');
login_btn.disabled = true;

const email = document.getElementById('email');
const reg_email_message = document.querySelector('.reg-email-message');
email.addEventListener('change', function(){
  if (reg_email.test(email.value)) {
    reg_email_message.innerHTML = '';
    if (password.value !== '') {
      login_btn.disabled = false;
    }
  }else if (!reg_email.test(email.value)) {
    reg_email_message.innerHTML = 'メールアドレスの入力が間違っています';
    email.value = '';
  }
},false);

const password = document.getElementById('password');
const reg_password_message = document.querySelector('.reg-password-message');
password.addEventListener('change', function(){
  if (reg_password.test(password.value)) {
    reg_password_message.innerHTML = '';
    if (email.value !== '') {
      login_btn.disabled = false;
    }
  }else if (!reg_password.test(password.value)) {
    reg_password_message.innerHTML = 'パスワードの入力が間違っています';
    password.value = '';
  }
},false);