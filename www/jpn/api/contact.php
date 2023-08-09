<?php
include_once('./_common.php');

$inquery_table = G5_TABLE_PREFIX."inquiry_jpn";
$name = $_POST['inq_name'];
$email = $_POST['inq_mail01'].'@'.$_POST['inq_mail02'];
$area = $_POST['inq_area'];
$company = $_POST['inq_company'];
$department = $_POST['inq_depart'];
$phone = $_POST['inq_phone'];
$address = $_POST['inq_add'];
$subject = $_POST['inq_subj'];
$content = $_POST['inq_content'];
$inq_password = get_encrypt_string($_POST['inq_pw']);
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
                  inq_pw = '{$inq_password}',
                  inq_date = '".G5_TIME_YMDHIS."'  ";

$sql = "INSERT {$inquery_table} SET {$sql_common}";

sql_query($sql);

alert("お問い合わせが完了しました。", "/jpn/sub/contact");
?>