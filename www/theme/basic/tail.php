<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) { // Shop
  include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
  return;
}
?>

<!-- Footer { -->
<footer id="footer">
  <div class="container">
    <div class="wrapper2">
      <div class="ft_info">
        <a href="/" class="ft-logo">
          <img src="/source/img/logo-gray.svg" alt="WISFAC 로고, 메인으로 이동">
        </a>
        <div class="ft_info-text">
          <span class="full">[34000] 대전 유성구 국제과학로 17 (신동 659-2)</span>
          <span>Tel. 042-936-6505</span>
          <!-- <span>Fax. 042-234-5678</span> -->
          <!-- <span>E-mail.abcd@naver.com</span> -->
        </div>
      </div>
      <div class="ft_util">
        <div class="fnb">
          <a href="">이용약관</a>
          <a href="">개인정보 처리방침</a>
        </div>
        <p class="ft-copyright">Copyright 2023 WISFAC. All Rights Reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- } Footer -->

<?php
if ($config['cf_analytics']) { // 관리자 방문자분석 스크립트 실행
    echo $config['cf_analytics'];
}
?>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");