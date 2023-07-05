<?php
include_once('./_common.php');

$inquery_table = G5_TABLE_PREFIX."inquiry";

$inqId = $_POST['inqId'];
$val = $_POST['value'];

$sql = 'UPDATE {$inquery_table} SET inq_check = 1 where inq_id = '.$inqId.' ';

sql_query($sql);

?>