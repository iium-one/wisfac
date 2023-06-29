'use strict'

const hd = document.querySelector('#header');
const hdLogo = document.querySelector('.hd-logo img');
const hdAllMenuBtn = document.querySelector('.all_menu-btn');
const allMenu = document.querySelector('#all_menu');

hdAllMenuBtn.addEventListener('click', function() {
  if( hdAllMenuBtn.classList.contains('act') ) {
    hd.classList.remove('act')
    hdAllMenuBtn.classList.remove('act')
    hdLogo.setAttribute('src', '/source/img/logo.svg');
    allMenu.classList.remove('act')
  } else {
    hd.classList.add('act')
    hdAllMenuBtn.classList.add('act')
    hdLogo.setAttribute('src', '/source/img/logo-white.svg');
    allMenu.classList.add('act')
    $(".all_menu-nav").matchHeight();
  }
});