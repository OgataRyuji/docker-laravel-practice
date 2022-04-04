"use strict";

const editNickname = document.getElementById('edit-nickname');
const regNickname = /^[ァ-ヴー]{5,}$/g;
const regNicknameMessage = document.querySelector('.reg-nickname-message');
const editRedBtn = document.querySelector('.register_red_btn');
editRedBtn.disabled = true;
editNickname.addEventListener('change', function(){
  if (regNickname.test(editNickname.value)) {
    regNicknameMessage.innerHTML = '';
    if (editPassword.value !== '' && editPasswordConfirmation !== '') {
      editRedBtn.disabled = false;
    }
  }else{
    regNicknameMessage.innerHTML = 'ニックネームの入力が間違っています';
    editNickname.value = '';
    editRedBtn.disabled = true;
  }
},false);

const editPassword = document.getElementById('edit-password');
const regPassword = /^[0-9a-zA-Z]{10,}$/g;
const regPasswordMessage = document.querySelector('.reg-password-message');
editPassword.addEventListener('change', function(){
  editPasswordConfirmation.value = '';
  if (regPassword.test(editPassword.value)) {
    regPasswordMessage.innerHTML = '';
  }else{
    regPasswordMessage.innerHTML = 'パスワードの入力が間違っています';
    editPassword.value = '';
  }
},false);

const editPasswordConfirmation = document.getElementById('edit-password-confirmation');
const comparePasswordMessage = document.querySelector('.compare-password-message');
editPasswordConfirmation.addEventListener('change', function(){
  if (editPassword.value === editPasswordConfirmation.value){
    comparePasswordMessage.innerHTML = '';
    if ((editNickname.value !== '') && (editPasswordConfirmation.value !== '') ) {
      editRedBtn.disabled = false;
    }
  }else if (editPassword.value !== editPasswordConfirmation.value){
    comparePasswordMessage.innerHTML = '入力されたパスワードが同じではありません';
    editPasswordConfirmation.value = '';
    editPassword.value = '';
  }
},false);