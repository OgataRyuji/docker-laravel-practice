"use strict";

const reg_nickname = /^[ァ-ヴー]{5,}$/g;
const reg_email = /^[A-Za-z0-9_.-]+@([0-9a-zA-Z][0-9a-zA-Z.-]*[0-9a-zA-Z]*\.)+([a-zA-Z.]*[a-zA-Z])$/g;
const reg_password = /^[0-9a-zA-Z]{10,}$/g;
const register_red_btn = document.querySelector('.register_red_btn');
register_red_btn.disabled = true;

const nickname = document.getElementById('nickname');
const reg_nickname_message = document.querySelector('.reg-nickname-message');
nickname.addEventListener('change', function(){
  if (reg_nickname.test(nickname.value)) {
    reg_nickname_message.innerHTML = '';
    if ((email.value !== '') && (password.value !== '') && (password_confirmation.value !== '')) {
      register_red_btn.disabled = false;
    }
  }else if (!reg_nickname.test(nickname.value)) {
    reg_nickname_message.innerHTML = 'ニックネームの入力が間違っています';
    nickname.value = '';
  }
},false);

const email = document.getElementById('email');
const reg_email_message = document.querySelector('.reg-email-message');
email.addEventListener('change', function(){
  if (reg_email.test(email.value)) {
    reg_email_message.innerHTML = '';
    if ((nickname.value !== '') && (password.value !== '') && (password_confirmation.value !== '')) {
      register_red_btn.disabled = false;
    }
  }else if (!reg_email.test(email.value)) {
    reg_email_message.innerHTML = 'メールアドレスの入力が間違っています';
    email.value = '';
  }
},false);

const password = document.getElementById('password');
const reg_password_message = document.querySelector('.reg-password-message');
password.addEventListener('change', function(){
  password_confirmation.value = '';
  if (reg_password.test(password.value)) {
    reg_password_message.innerHTML = '';
  }else if (!reg_password.test(password.value)) {
    reg_password_message.innerHTML = 'パスワードの入力が間違っています';
    password.value = '';
  }
},false);

const password_confirmation = document.getElementById('password_confirmation');
const compare_password_message = document.querySelector('.compare-password-message');
password_confirmation.addEventListener('change', function(){
  if (password.value === password_confirmation.value) {
    compare_password_message.innerHTML = '';
    if ((nickname.value !== '') && (email.value !== '') && (password.value !== '')) {
      register_red_btn.disabled = false;
    }
  }else if (password.value !== password_confirmation.value) {
    compare_password_message.innerHTML = '入力されたパスワードが同じではありません';
    password_confirmation.value = '';
  }
},false);
