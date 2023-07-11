<?php
$sub_menu = '400205';
include_once('./_common.php');


auth_check_menu($auth, $sub_menu, "w");

@mkdir(G5_DATA_PATH."/category", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/category", G5_DIR_PERMISSION);

$ca_img_dir = G5_DATA_PATH.'/category';
$ca_img_arr = array();

//check_admin_token();

for ($k=0; $k<count($_POST['ca_id']); $k++) {

	$ca_id = sql_real_escape_string($_POST['ca_id'][$k]);

	// 파일정보
	$sql = " select * from {$g5['g5_shop_category_table']} WHERE ca_id = '$ca_id' ";
	$file = sql_fetch($sql);

	$ca_img_sql_common = "";
	for($i=1;$i<=$_shop_category_file_uplpad_count;$i++) {
			$ca_img_filed = 'ca_img'.$i;
			$ca_img_del_filed = $ca_img_filed.'_del';

			$ca_img_arr[$ca_img_filed] = $file[$ca_img_filed] ? $file[$ca_img_filed] : '';
			$ca_img_arr[$ca_img_del_filed] = ! empty($_POST[$ca_img_del_filed][$k]) ? 1 : 0;

			// 파일삭제
			if ($ca_img_arr[$ca_img_del_filed]) :
				$file_img = $ca_img_dir.'/'.clean_relative_paths($ca_img_arr[$ca_img_filed]);
				@unlink($file_img);
				delete_ca_thumbnail_extend_category(dirname($file_img), basename($file_img));
				$ca_img_arr[$ca_img_filed] = '';
			endif;

			// 이미지업로드
			if ($_FILES[$ca_img_filed]['name'][$k]) :
				if($ca_img_arr[$ca_img_filed]) :
					$file_img = $ca_img_dir.'/'.clean_relative_paths($ca_img_arr[$ca_img_filed]);
					@unlink($file_img);
					delete_ca_thumbnail_extend_category(dirname($file_img), basename($file_img));
				endif;
				$ca_img_arr[$ca_img_filed] = ca_img_upload_extend_category($_FILES[$ca_img_filed]['tmp_name'][$k], $_FILES[$ca_img_filed]['name'][$k], $ca_img_dir.'/'.$ca_id);
			endif;

		$ca_img_sql_common .= " {$ca_img_filed} = '{$ca_img_arr[$ca_img_filed]}',";
	}

	$ca_img_sql_common = trim($ca_img_sql_common); // 앞뒤 공백 제거
	$ca_img_sql_common = substr($ca_img_sql_common, 0, -1); // 제일 마지막 문자열 제거

	$sql = " update {$g5['g5_shop_category_table']} set {$ca_img_sql_common} where ca_id = '$ca_id' ";
	sql_query($sql);
	//echo $sql; exit;

}

    goto_url("./category_img_list.php?$qstr");
?>
