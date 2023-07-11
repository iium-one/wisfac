<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 


for($_idx=1; $_idx<=$_shop_category_file_uplpad_count; $_idx++) {
	
	$_g5_shop_category_table_after_filed = ($_idx == 1) ? 'ca_10' : 'ca_img'.($_idx -1);

	$result_filed_row = sql_fetch(" SHOW COLUMNS FROM {$g5['g5_shop_category_table']} LIKE 'ca_img".$_idx."' ");
	if(!$result_filed_row['Field']) { // 분류 이미지
		sql_query(" ALTER TABLE {$g5['g5_shop_category_table']} ADD `ca_img".$_idx."` VARCHAR(255) NULL DEFAULT '' AFTER `".$_g5_shop_category_table_after_filed."` ", FALSE);
	}
}

?>