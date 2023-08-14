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

include G5_PATH.'/eng/include/menus.php';

add_stylesheet('<link rel="stylesheet" href="/source/css/contents_eng.css">', 0);
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
          <a href="/eng">
            <img src="/source/img/logo.svg" alt="WISFAC Logo">
          </a>
        </h1>
        <nav class="gnb">
          <ul class="gnb-dep1">
            <?php foreach ($sb_menus as $menu) { ?>
            <li>
              <a href="<?php echo $menu['link'];?>"><?php echo $menu['name'];?></a>
              <ul class="gnb-dep2">
                <?php foreach ($menu['sb_2menus'] as $menu2) { ?>
                <li>
                  <a href="<?php echo $menu2['link'];?>"><?php echo $menu2['name'];?></a>
                </li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </nav>
        <div class="hd-sub">
          <select class="nc-sel lang-sel" onchange="window.open(value,'_self');">
            <option value="/">KOR</option>
            <option value="/eng" selected>ENG</option>
            <option value="/jpn">JPN</option>
            <option value="/chi">CHI</option>
          </select>
          <button type="button" class="all_menu-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <button type="button" class="mobile_menu-btn">
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

<!-- All Menu { -->
<div id="all_menu">
  <div class="container">
    <div class="wrapper">
      <div class="all_menu_ct">
        <?php foreach ($sb_menus as $menu) { ?>
        <nav class="all_menu-nav">
          <ul class="all_menu-dep1">
            <li>
              <a href="<?php echo $menu['link'];?>"><?php echo $menu['name'];?></a>
              <ul class="all_menu-dep2">
                <?php foreach ($menu['sb_2menus'] as $menu2) { ?>
                <li>
                  <a href="<?php echo $menu2['link'];?>"><?php echo $menu2['name'];?></a>
                  <ul class="all_menu-dep3">
                    <?php foreach ($menu2['sb_3menus'] as $menu3) { ?>
                    <li>
                      <a href="<?php echo $menu3['link'];?>"><?php echo $menu3['name'];?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </nav>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- } All Menu -->

<!-- Mobile Menu { -->
<div id="mobile_menu">
  <div class="container">
    <div class="wrapper">
      <div id="mobile_menu_ct" class="mobile_menu_ct">
        <?php foreach ($sb_menus as $menu) { ?>
        <nav class="mobile_menu-nav">
          <ul class="mobile_menu-dep1">
            <li>
              <a href="javascript:void(0);"><?php echo $menu['name'];?></a>
              <ul class="mobile_menu-dep2">
                <?php foreach ($menu['sb_2menus'] as $menu2) { ?>
                <li>
                  <a href="<?php echo $menu2['link'];?>"><?php echo $menu2['name'];?></a>
                  <ul class="mobile_menu-dep3">
                    <?php foreach ($menu2['sb_3menus'] as $menu3) { ?>
                    <li>
                      <a href="<?php echo $menu3['link'];?>"><?php echo $menu3['name'];?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </nav>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- } AMobilell Menu -->

<!-- 
main: theme > basic > index.php
sub: sub > file_name.php
-->