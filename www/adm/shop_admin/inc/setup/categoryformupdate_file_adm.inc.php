<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//define('G5_IS_ADMIN', true);

@mkdir(G5_DATA_PATH."/category", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/category", G5_DIR_PERMISSION);

$ca_img_arr = array();

if( $_categoryformupdate_file_adm_inc_mode == 'w') {
	if ($w == "" || $w == "u") {
			$ca_img1 = $ca_img2 = $ca_img3 = $ca_img4 = $ca_img5 = '';
			// 파일정보
			if($w == "u") {
				$sql = " select * from {$g5['g5_shop_category_table']} WHERE ca_id = '$ca_id' ";
				$file = sql_fetch($sql);

				$ca_img1    = $file['ca_img1'];
				$ca_img2    = $file['ca_img2'];
				$ca_img3    = $file['ca_img3'];
				$ca_img4    = $file['ca_img4'];
				$ca_img5    = $file['ca_img5'];
			}

			$ca_img_dir = G5_DATA_PATH.'/category';

			for($i=0;$i<=$_shop_category_file_uplpad_count;$i++){
				${'ca_img'.$i.'_del'} = ! empty($_POST['ca_img'.$i.'_del']) ? 1 : 0;
			}

			// 파일삭제
			if ($ca_img1_del) {
				$file_img1 = $ca_img_dir.'/'.clean_relative_paths($ca_img1);
				@unlink($file_img1);
				delete_ca_thumbnail_extend_category(dirname($file_img1), basename($file_img1));
				$ca_img1 = '';
			}
			if ($ca_img2_del) {
				$file_img2 = $ca_img_dir.'/'.clean_relative_paths($ca_img2);
				@unlink($file_img2);
				delete_ca_thumbnail_extend_category(dirname($file_img2), basename($file_img2));
				$ca_img2 = '';
			}
			if ($ca_img3_del) {
				$file_img3 = $ca_img_dir.'/'.clean_relative_paths($ca_img3);
				@unlink($file_img3);
				delete_ca_thumbnail_extend_category(dirname($file_img3), basename($file_img3));
				$ca_img3 = '';
			}
			if ($ca_img4_del) {
				$file_img4 = $ca_img_dir.'/'.clean_relative_paths($ca_img4);
				@unlink($file_img4);
				delete_ca_thumbnail_extend_category(dirname($file_img4), basename($file_img4));
				$ca_img4 = '';
			}
			if ($ca_img5_del) {
				$file_img5 = $ca_img_dir.'/'.clean_relative_paths($ca_img5);
				@unlink($file_img5);
				delete_ca_thumbnail_extend_category(dirname($file_img5), basename($file_img5));
				$ca_img5 = '';
			}
			// 이미지업로드
			if ($_FILES['ca_img1']['name']) {
				if($w == 'u' && $ca_img1) {
					$file_img1 = $ca_img_dir.'/'.clean_relative_paths($ca_img1);
					@unlink($file_img1);
					delete_ca_thumbnail_extend_category(dirname($file_img1), basename($file_img1));
				}
				$ca_img1 = ca_img_upload_extend_category($_FILES['ca_img1']['tmp_name'], $_FILES['ca_img1']['name'], $ca_img_dir.'/'.$ca_id);
			}
			if ($_FILES['ca_img2']['name']) {
				if($w == 'u' && $ca_img2) {
					$file_img2 = $ca_img_dir.'/'.clean_relative_paths($ca_img2);
					@unlink($file_img2);
					delete_ca_thumbnail_extend_category(dirname($file_img2), basename($file_img2));
				}
				$ca_img2 = ca_img_upload_extend_category($_FILES['ca_img2']['tmp_name'], $_FILES['ca_img2']['name'], $ca_img_dir.'/'.$ca_id);
			}
			if ($_FILES['ca_img3']['name']) {
				if($w == 'u' && $ca_img3) {
					$file_img3 = $ca_img_dir.'/'.clean_relative_paths($ca_img3);
					@unlink($file_img3);
					delete_ca_thumbnail_extend_category(dirname($file_img3), basename($file_img3));
				}
				$ca_img3 = ca_img_upload_extend_category($_FILES['ca_img3']['tmp_name'], $_FILES['ca_img3']['name'], $ca_img_dir.'/'.$ca_id);
			}
			if ($_FILES['ca_img4']['name']) {
				if($w == 'u' && $ca_img4) {
					$file_img4 = $ca_img_dir.'/'.clean_relative_paths($ca_img4);
					@unlink($file_img4);
					delete_ca_thumbnail_extend_category(dirname($file_img4), basename($file_img4));
				}
				$ca_img4 = ca_img_upload_extend_category($_FILES['ca_img4']['tmp_name'], $_FILES['ca_img4']['name'], $ca_img_dir.'/'.$ca_id);
			}
			if ($_FILES['ca_img5']['name']) {
				if($w == 'u' && $ca_img5) {
					$file_img5 = $ca_img_dir.'/'.clean_relative_paths($ca_img5);
					@unlink($file_img5);
					delete_ca_thumbnail_extend_category(dirname($file_img5), basename($file_img5));
				}
				$ca_img5 = ca_img_upload_extend_category($_FILES['ca_img5']['tmp_name'], $_FILES['ca_img5']['name'], $ca_img_dir.'/'.$ca_id);
			}


			$sql = " update {$g5['g5_shop_category_table']}
						set ca_img1             = '$ca_img1',
							ca_img2             = '$ca_img2',
							ca_img3             = '$ca_img3',
							ca_img4             = '$ca_img4',
							ca_img5             = '$ca_img5'
					  where ca_id = '$ca_id' ";
			sql_query($sql);
	}
}

if( $_categoryformupdate_file_adm_inc_mode == 'd') {
	if ($w == "d") {
		//run_event('shop_admin_delete_category_file', $ca_id);
		shop_category_file_delete_extend_category($ca_id);
	}
}
?>