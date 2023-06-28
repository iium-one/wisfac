'use strict'

import { formatDate } from './modules/format-date';
import { tabAddOnClass } from './common';

// [plugin-lenis] scroll animation
const lenis = new Lenis()
function raf(time) {
  lenis.raf(time)
  requestAnimationFrame(raf)
}
requestAnimationFrame(raf)

// [plugin-Swiper] main visual
const mainVisualTimebar = (state) => {
  if (state == 'init') {
    $(".main-visual-time .bar span").stop().css({"width":"0"});
  } else if (state == 'ing') {
    $(".main-visual-time .bar span").stop().animate({width: "100%"}, 4000);
  } else {
    $(".main-visual-time .bar span").stop().css({"width":"0"});
  }
}

const mainVisualSwiper = new Swiper('.main-visual-wrapper', {
  draggable: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false
  },
  pagination: {
    el: ".main-visual-wrapper .swiper-pagination",
    type: "fraction",
  },
  on: {
    init: function () {
      mainVisualTimebar('ing')
    },
    slideChangeTransitionEnd: function () {
      mainVisualTimebar('init')
      mainVisualTimebar('ing')
    },
  },
});

const mainVisualStopBtn = document.querySelector(".main-visual-stop");

mainVisualStopBtn.addEventListener("click", function(){
  mainVisualTimebar('init')
  mainVisualSwiper.autoplay.stop();
})

const mainVisualPlayBtn = document.querySelector(".main-visual-play");

mainVisualPlayBtn.addEventListener("click", function(){
  mainVisualSwiper.autoplay.start();
  mainVisualTimebar('ing')
})

//main board
const mainBoardSwiper = new Swiper('.main-board-wrapper', {
  draggable: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false
  },
  navigation: {
    nextEl: ".main-board_wrap .swiper-button-next",
    prevEl: ".main-board_wrap .swiper-button-prev",
  },
});

//메인 게시글 불러오기
const mainBoardRender = (board, posts) => {
  const mainBoardWrap = document.querySelector(".main-board-slider");
  let mainBoardHtml = "";

  posts?.map((post, index)=>{
    mainBoardHtml += `<div class="swiper-slide main-board-item item${index+1}">
      <div class="main-board_ct_inner">
        <a href="/${board}/${post.wr_id}" class="board-subj">${post.wr_subject}</a>
        <p class="board-expl">${post.wr_content}</p>
        <p class="board-date">${formatDate(post.wr_datetime,'.')}</p>
      </div>
    </div>
    `;
  });
  mainBoardWrap.innerHTML = mainBoardHtml;
}

const mainBoardData = async(board) =>{
  let response = await fetch(`/api/board.php?bo=${board}`)
  let data = await response.json()

  mainBoardRender(board, data)
}

mainBoardData('notice'); //초기 데이터

// 메인 게시글 영역 탭 버튼 클릭 이벤트 처리
const mainBoardTabButtons = document.querySelectorAll('.main-boarad-tabs .tabs-btn');
mainBoardTabButtons.forEach(button => {
  button.addEventListener('click', function() {
    let board = button.getAttribute("data-board");

    tabAddOnClass(this, mainBoardData(board));
    mainBoardSwiper.slideTo(0, 0, false);
  });
});

$(document).ready(function(){
  // [plugin-NiceSelect]
  if($(".nc-sel").length > 0){
    const $ncSelect = $(".nc-sel");

    $ncSelect.each(function(){
      $(this).niceSelect();
    })
  }

  // [plugin-AOS]
  AOS.init();
}); //End Document