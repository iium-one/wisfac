'use strict'

import { mcScrollbar } from './common';

const hd = document.querySelector('#header');
const hdLogo = document.querySelector('.hd-logo img');
const hdAllMenuBtn = document.querySelector('.all_menu-btn');
const allMenu = document.querySelector('#all_menu');
const hdMobileMenuBtn = document.querySelector('.mobile_menu-btn');
const mobileMenu = document.querySelector('#mobile_menu');
const mobileMenu_depth1 = mobileMenu.querySelectorAll('.mobile_menu-dep1');
// const mobileMenu_depth2 = mobileMenu_depth1.querySelector('.mobile_menu-dep2');
// const mobileMenu_depth3 = mobileMenu_depth2.querySelector('.mobile_menu-dep3');

hdAllMenuBtn.addEventListener('click', function() {
  if( hdAllMenuBtn.classList.contains('act') ) {
    hd.classList.remove('act')
    hdAllMenuBtn.classList.remove('act')
    hdLogo.setAttribute('src', '/source/img/logo.svg');
    allMenu.classList.remove('act')
    $(".all_menu-nav").removeClass('act');
  } else {
    hd.classList.add('act')
    hdAllMenuBtn.classList.add('act')
    hdLogo.setAttribute('src', '/source/img/logo-white.svg');
    allMenu.classList.add('act')
    $(".all_menu-nav").matchHeight().addClass('act');
  }
});

hdMobileMenuBtn.addEventListener('click', function() {
  if( hdMobileMenuBtn.classList.contains('act') ) {
    hd.classList.remove('act')
    hdMobileMenuBtn.classList.remove('act')
    hdLogo.setAttribute('src', '/source/img/logo.svg');
    mobileMenu.classList.remove('act')
    $(".all_menu-nav").removeClass('act');
  } else {
    hd.classList.add('act')
    hdMobileMenuBtn.classList.add('act')
    hdLogo.setAttribute('src', '/source/img/logo-white.svg');
    mobileMenu.classList.add('act')
    $(".all_menu-nav").matchHeight().addClass('act');
  }
});

for(let mo_depth1 of mobileMenu_depth1) {
  mo_depth1.addEventListener('click', function() {
    const mobileMenu_depth2 = mo_depth1.querySelector('.mobile_menu-dep2');

    if(mobileMenu_depth2.style.display == 'block') {
      mo_depth1.classList.remove('act');
      mobileMenu_depth2.style.cssText  = 'display: none';
    } else {
      mo_depth1.classList.add('act');
      mobileMenu_depth2.style.cssText  = 'display: block';
    }
  });
}