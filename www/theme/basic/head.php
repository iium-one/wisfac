<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) { // Shop
  define('G5_IS_COMMUNITY_PAGE', true);
  include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
  return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<?php
if(defined('_INDEX_')) { // index에서만 실행
  include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<!-- Header { -->
<header id="header">
  <div class="container">
    <div class="wrapper">
      <div id="hd_top-inner">
        <h1 class="hd-logo">
          <a href="/">
            <img src="/source/img/logo.svg" alt="WISFAC Logo">
          </a>
        </h1>
        <nav class="gnb">
          <ul class="gnb-dep1">
            <li>
              <a href="">위스팩소개</a>
              <ul class="gnb-dep2">
                <li>
                  <a href="">회사소개</a>
                </li>
                <li>
                  <a href="">사업소개</a>
                </li>
                <li>
                  <a href="">CEO인사말</a>
                </li>
                <li>
                  <a href="">글로벌 네트워크</a>
                </li>
                <li>
                  <a href="">오시는 길</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="">제품소개</a>
              <ul class="gnb-dep2">
                <li>
                  <a href="">Edge/Surface</a>
                </li>
                <li>
                  <a href="">Air Pocket(IR)</a>
                </li>
                <li>
                  <a href="">Other</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="">고객지원</a>
              <ul class="gnb-dep2">
                <li>
                  <a href="">문의하기</a>
                </li>
                <li>
                  <a href="">회사소식</a>
                </li>
                <li>
                  <a href="">공지사항</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="">인재채용</a>
              <ul class="gnb-dep2">
                <li>
                  <a href="">채용안내</a>
                </li>
                <li>
                  <a href="">인사/복지제도</a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <div class="hd-sub">
          <select class="nc-sel lang-sel">
            <option value="kor">KOR</option>
            <option value="eng">ENG</option>
          </select>
          <button type="button" class="all_menu-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- } Header -->

<!-- 
main: theme > basic > index.php
sub: sub > file_name.php
-->