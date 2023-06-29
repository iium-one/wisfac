<?php
include_once('./_common.php');

$inqId = $_POST['inqId'];
$val = $_POST['value'];

$sql = 'UPDATE iium_inquiry SET inq_check = 1 where inq_id = '.$inqId.' ';

sql_query($sql);

?>