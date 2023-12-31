<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" id="meta_viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10">

<!-- 검색 메타태그 { 
<meta name="subject" content="WISFAC">
<meta name="title" content="이음소프트-디지털 디자인 스퀘어">
<meta name="description" content="홈페이지 설명">
<meta name="keywords" content="키워드1,키워드2" />

<meta property="og:type" content="website">
<meta property="og:title" content="이음소프트">
<meta property="og:description" content="홈페이지 설명">
<meta property="og:image" content="/images/logo.png">
<meta property="og:url" content="http://www.iium.co.kr">

<link rel="canonical" href="http://www.iium.co.kr">
<link rel="shortcut icon" href="/source/img/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/source/img/favicon.ico" type="image/x-icon" />
} 검색 메타태그 -->

<?php
if (G5_IS_MOBILE) {
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
} else {
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.PHP_EOL;
}
echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
<title><?php echo $g5_head_title; ?></title>

<?php
$shop_css = '';
if (defined('_SHOP_')) $shop_css = '_shop';
echo '<link rel="stylesheet" href="'.run_replace('head_css_url', G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').$shop_css.'.css?ver='.G5_CSS_VER, G5_THEME_URL).'">'.PHP_EOL;
?>
<!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
<?php if (defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
var g5_theme_shop_url = "<?php echo G5_THEME_SHOP_URL; ?>";
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
<?php } ?>
<?php if(defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>
</script>


<link rel="apple-touch-icon" sizes="180x180" href="/source/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/source/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/source/img/favicon/favicon-16x16.png">
<link rel="manifest" href="/source/img/favicon/site.webmanifest">

<?php
/* JS 파일 연결 */
add_javascript('<script src="'.G5_JS_URL.'/jquery-1.12.4.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery-migrate-1.4.1.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/common.js?ver='.G5_JS_VER.'"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/wrest.js?ver='.G5_JS_VER.'"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/placeholders.min.js"></script>', 0);
/*Plug-in, Library {*/
add_javascript('<script src="/source/plugin/prefixfree.min.js" defer></script>', 0);
add_javascript('<script src="/source/plugin/scrollbar/jquery.mCustomScrollbar.js" defer></script>', 0);
add_javascript('<script src="/source/plugin/jquery.matchHeight.js" defer></script>', 0);
add_javascript('<script src="/source/plugin/aos/aos.js" defer></script>', 0);
add_javascript('<script src="/source/plugin/scrollbar/lenis.js" defer></script>', 0);
add_javascript('<script src="/source/plugin/niceselect/jquery.nice-select.min.js" defer></script>', 0);
add_javascript('<script src="/source/plugin/swiper/swiper-bundle.min.js" defer></script>', 0);
/*} Plug-in, Library */
add_javascript('<script type="module" src="/source/js/common.js" defer></script>', 0);
add_javascript('<script type="module" src="/source/js/header.js" defer></script>', 0);
add_javascript('<script type="module" src="/source/js/contents.js" defer></script>', 0);


/* CSS 파일 연결 */
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/font-awesome/css/font-awesome.min.css">', 0);
/*Plug-in, Library {*/
add_stylesheet('<link rel="stylesheet" href="/source/plugin/aos/aos.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/plugin/scrollbar/jquery.mCustomScrollbar.min.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/plugin/niceselect/nice-select.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/plugin/swiper/swiper-bundle.min.css">', 0);
/*} Plug-in, Library */
add_stylesheet('<link rel="stylesheet" href="/source/css/fonts.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/css/common.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/css/header.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/css/footer.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/source/css/contents.css">', 0);


if(G5_IS_MOBILE) {
    add_javascript('<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>', 1); // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>


</head>
<?php $lang = explode("/", trim(preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']), '/'))[0]; ?>
<body id="<?php echo $lang; ?>" <?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}