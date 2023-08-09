<?php
include_once('./_common.php');

$inqId = $_POST['inqId'];
$val = $_POST['value'];
$lang_code = $_POST['lang'];

if(!isset($lang_code) || $lang_code == '' || $lang_code == 'kor') {
  $inquery_table = G5_TABLE_PREFIX."inquiry";
} else {
  $inquery_table = G5_TABLE_PREFIX."inquiry_".$lang_code;
}



$sql = " UPDATE {$inquery_table} SET inq_check = 1 where inq_id = '{$inqId}' ";
sql_query($sql);

?>