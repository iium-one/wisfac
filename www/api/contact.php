<?php
include_once('./_common.php');

$inquery_table = G5_TABLE_PREFIX."inquiry";
$name = $_POST['inq_name'];
$email = $_POST['inq_mail01'].'@'.$_POST['inq_mail02'];
$area = $_POST['inq_area'];
$company = $_POST['inq_company'];
$department = $_POST['inq_depart'];
$phone = $_POST['inq_phone1'].'-'.$_POST['inq_phone2'].'-'.$_POST['inq_phone3'];
$address = '('.$_POST['inq_post_num'].')' . $_POST['inq_add1'] . $_POST['inq_add2'] . $_POST['inq_add3'];
$subject = $_POST['inq_subj'];
$content = $_POST['inq_content'];
$datetime = date("Y-m-d H:i:s");

$sql_common .= "  inq_name = '{$name}',
                  inq_mail = '{$email}',
                  inq_area = '{$area}',
                  inq_company = '{$company}',
                  inq_depart = '{$department}',
                  inq_tel = '{$phone}',
                  inq_add = '{$address}',
                  inq_subj = '{$subject}',
                  inq_content = '{$content}',
                  inq_date = '".G5_TIME_YMDHIS."'  ";

$sql = "INSERT {$inquery_table} SET {$sql_common}";

sql_query($sql);

alert("문의가 완료되었습니다.", "/sub/contact");
?>