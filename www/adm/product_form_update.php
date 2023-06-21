<?php
$sub_menu = "600100";
include_once('./_common.php');

$w = $_POST['w'];
$idx = $_POST['idx'];
$pt_title = $_POST['title'];
$pt_content = $_POST['content'];
$pt_spec = $_POST['spec'];
$pt_spec_array = implode("||",$pt_spec);
$pt_link = $_POST['link'];

$upload_max_filesize = ini_get('upload_max_filesize'); //기본 100M
$file_dir = G5_DATA_PATH.'/product'; //파일 업로드 경로
$table = 'iu_product';
$data_table = 'iu_product_file';

// 서버에 설정된 값보다 큰파일을 업로드 한다면
if (empty($_POST)) {
  alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\n내용 제한 용량=".ini_get('post_max_size')." , 파일 제한 용량=".$upload_max_filesize, $redirect_url);
}

// 파일정보
for($i=0;$i<=5;$i++){
  ${'file'.$i} = '';
  ${'file'.$i.'_del'} = ! empty($_POST['file'.$i.'_del']) ? 1 : 0;

  // 파일삭제
  if (${'file'.$i.'_del'} == 1) {
    $file_row = sql_fetch(" select file_name from {$data_table} where in_idx = '{$idx}' and in_no = '{$i}' ");
    ${'file'.$i} = $file_dir.'/'.$file_row['file_name'];
    @unlink(${'file'.$i});
    ${'file'.$i} = '';
    sql_query(" delete from {$data_table} where in_idx = '{$idx}' and in_no = '{$i}' ");
  }
}


if($w == '' || $w == 'd'){
  $redirect_url = "./product_list.php?{$qstr}";
}else if($w == 'u'){
  $redirect_url = "./product_form.php?w=u&amp;idx={$idx}";
}else{
  $redirect_url = "./product_list.php?{$qstr}";
}

$sql_common = " title = '{$pt_title}', 
                  content = '{$pt_content}', 
                  spec = '{$pt_spec_array}', 
                  link = '{$pt_link}', 
                  file = '{$file}' 
                  ";
                  
if($w == ''){ //등록
  $sql_common .= " , w_date = '".G5_TIME_YMDHIS."' ";
  $sql_common .= " , u_date = '".G5_TIME_YMDHIS."' ";

  $sql = " insert {$table}
            set {$sql_common}
          ";
  sql_query($sql);
  $idx = sql_insert_id();
}else if($w == 'u'){ //수정
  $sql_common .= " , u_date = '".G5_TIME_YMDHIS."' ";

  $sql = " update {$table} set {$sql_common} where idx = '{$idx}' ";
  sql_query($sql);
}else if($w == 'd'){ //삭제
  $sql = " delete from {$table} where idx = '{$idx}' ";
  sql_query($sql);

  //해당 글의 파일 삭제
  $file_sql = " select file_name from {$data_table} where in_idx = '{$idx}' ";
  $file_res = sql_query($file_sql);
  for($i=0; $file_row=sql_fetch_array($file_res); $i++){
    ${'file'.$i} = $file_dir.'/'.$file_row['file_name'];
    @unlink(${'file'.$i});
  }
  sql_query(" delete from {$data_table} where in_idx = '{$idx}' ");
}

for($i=1;$i<=5;$i++){
  // 이미지업로드
  if ($_FILES['file'.$i]['name']) {
    // 에러코드가 발생한다면
    if ($_FILES['file'.$i]['error'] == 1) {
      alert("파일의 용량이 서버에 설정(".$upload_max_filesize.")된 값보다 크므로 업로드 할 수 없습니다.", $redirect_url);
    }
    else if ($_FILES['file'.$i]['error'] != 0) {
      alert("파일이 정상적으로 업로드 되지 않았습니다.\n서버의 업로드 제한 용량은 ".$upload_max_filesize."입니다.", $redirect_url);
    }

    $file_row = sql_fetch(" select file_name from {$data_table} where in_idx = '{$idx}' and in_no = '{$i}' ");
    if($w == 'u' && $file_row['file_name']) { //수정시 첨부파일 값이 있다면 기존 파일 삭제
        ${'file'.$i} = $file_dir.'/'.$file_row['file_name'];
        @unlink(${'file'.$i});
        sql_query(" delete from {$data_table} where in_idx = '{$idx}' and in_no = '{$i}' ");
    }
    ${'file'.$i} = img_upload($_FILES['file'.$i]['tmp_name'], $_FILES['file'.$i]['name'], $file_dir, $data_table, $idx, $i);
  }
}

// 파일의 개수를 게시물에 업데이트 한다.
$row = sql_fetch(" select count(*) as cnt from {$data_table} where in_idx = '{$idx}' ");
sql_query(" update {$table} set file = '{$row['cnt']}' where idx = '{$idx}' ");


goto_url($redirect_url);