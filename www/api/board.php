<?php
include_once('./_common.php');

//게시판 목록 조회 API
$board_name = $g5['write_prefix'].$_GET['bo'];

$sql = " SELECT 
          wr_id, wr_subject, wr_content, wr_datetime
          FROM {$board_name} ";
$result = sql_query($sql);

$data = array();
for($i=0; $row=sql_fetch_array($result); $i++){
  $data[] = $row;
}

echo json_encode($data);
?>