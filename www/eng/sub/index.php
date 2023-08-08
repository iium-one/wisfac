<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/common.php';

$rq_uri0 = explode("?", $_SERVER['REQUEST_URI']);
$rq_uri = explode("/", $rq_uri0[0]);
$rq_uri = array_values(array_filter($rq_uri));

// GET 파라미터
parse_str($rq_uri0[1], $getParams);
$_GET = array_merge($_GET, $getParams);
unset($_GET['uri']);
$_GET['qstrUri'] = http_build_query($_GET);
include_once G5_THEME_PATH . '/head_eng.php';

$URI['rt'] = $rq_uri[2];
$URI['pram'] = "";
for ($i = 3; $i < count($rq_uri); $i++) {
  $URI['pram'] .= "/{" . ($i - 3) . "}";
}

$route = new Route($member, $g5, $config, $mb);
if (file_exists("./_{$URI['rt']}.php")) {
  $route->add("/{$URI['rt']}{$URI['pram']}", "./_{$URI['rt']}.php");
} else {
  $route->notFound("../../_404.php");
}

/*
  파라미터 넘길때 /a/b/1/3/5
  파라미터 받을때 $params[0],$params[1],$params[2],.......... 이렇게 받아서 처리 해야함

  그래서 사용할때는 $idx = $params[0]; 이렇게 처리해서 사용
*/

include_once G5_THEME_PATH . '/tail_eng.php';
