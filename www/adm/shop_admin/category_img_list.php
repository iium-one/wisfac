<?php
$sub_menu = '600105';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '분류 이미지 관리';

include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once (G5_ADMIN_PATH.'/shop_admin/inc/db/shop_category_table_filed_add.php'); // 분류 이미지관련 필드 추가

//$bcount = $bcount ? $bcount : $config['cf_page_rows'];
$bcount = $bcount ? $bcount : 50;

$sst = $sst ? $sst :  "ca_id"; // 정렬 필드
$sod = $sod ? $sod :  "ASC"; // 정렬 조건

$sql_table_common = " FROM {$g5['g5_shop_category_table']}  ";

$sql_common = " ";
$sql_common .= " WHERE LENGTH(ca_id) > 0 ";

if($stx) {
	if($sfl == "ca_id") {
		$sql_common .=" AND ".$sfl." = '".$stx."'";
	} else {
		$sql_common .=" AND ".$sfl." LIKE '%".$stx."%'";
	}
}

for($_img_idx=1; $_img_idx<=$_shop_category_file_uplpad_count; $_img_idx++) {
	$sch_ca_img_filed = 'sch_ca_img'.$_img_idx;
	if($_REQUEST[$sch_ca_img_filed]) {
		$sql_common .=" AND LENGTH(ca_img".$_img_idx.") > 4";
	}
}

// 테이블의 전체 레코드수만 얻음
$sql = " SELECT COUNT(*) AS cnt " .$sql_table_common. $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];


//$bcount = $bcount ? $bcount : 100;
$rows = $bcount;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$sql_order = " ORDER BY $sst $sod";

// 출력할 레코드를 얻음
$sql  = " SELECT *";
$sql  .= "";
$sql  .= $sql_table_common;
$sql  .= $sql_common;
$sql  .= $sql_order;
$sql  .= " LIMIT $from_record, $rows ";


$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$colspan = 3;

$colspan = $colspan + $_shop_category_file_uplpad_count; /// 분류 이미지 업로드 수

if($_category_office_intranet_admin == 'y') :
	$colspan = $colspan + 1;
endif;

$_div_img_width = 70;
?>
<style>
table.table_category_img_list{}
table.table_category_img_list td{position:relative;}
table.table_category_img_list td.td_ca_img .category_filebox label {display:inline-block;padding:.5em .75em;font-size:inherit;font-weight:700;line-height:normal;vertical-align:middle;border-radius:.35em;width:92%;max-width:92%;
color:#000;background-color:#cce6ff;cursor:pointer;border:1px solid #77bbff;border-bottom-color:#0080ff;}
table.table_category_img_list td.td_ca_img .category_filebox label:before {content:"\f093";font-family:"FontAwesome";color:#0080ff; margin-right:10px;}
table.table_category_img_list td.td_ca_img .category_filebox label:hover , .category_filebox label:hover:before {background-color:#3f81e7;color:#fff;}
table.table_category_img_list td.td_ca_img .category_filebox label:active, .category_filebox label:active:before {background-color:#1a60ca;color:#fff;}
table.table_category_img_list td.td_ca_img .category_filebox input[type="file"] { position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0;}
table.table_category_img_list td.td_ca_img .category_filebox.wf100p label {width:100%;max-width:100%;}
table.table_category_img_list td.td_ca_img .category_filebox.wf99p label {width:99%;max-width:99%;}
table.table_category_img_list td.td_ca_img .category_filebox.wf90p label {width:90%;max-width:90%;}
table.table_category_img_list td.td_ca_img .category_filebox.wf80p label {width:80%;max-width:80%;}
table.table_category_img_list td.td_ca_img .category_filebox.wf70p label {width:70%;max-width:70%;}
table.table_category_img_list td.td_ca_img .category_filebox.wf60p label {width:60%;max-width:60%;}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall; ?>
    <span class="btn_ov01"><span class="ov_txt">생성된  분류 수</span><span class="ov_num">  <?php echo number_format($total_count); ?>개</span></span>
</div>

<form name="flist" class="local_sch01 local_sch">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="save_stx" value="<?php echo $stx; ?>">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="ca_name"<?php echo get_selected($sfl, "ca_name", true); ?>>분류명</option>
    <option value="ca_id"<?php echo get_selected($sfl, "ca_id", true); ?>>분류코드</option>
    <option value="ca_mb_id"<?php echo get_selected($sfl, "ca_mb_id", true); ?>>회원아이디</option>
</select>

<label for="stx" class="sound_only">검색어</label>
<input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" class="frm_input">
<input type="submit" value="검색" class="btn_submit">


	&nbsp;&nbsp;
	<? 
		for($_img_idx=1; $_img_idx<=$_shop_category_file_uplpad_count; $_img_idx++) :
			$sch_ca_img_filed = 'sch_ca_img'.$_img_idx;
	?>
		&nbsp;
		
		<input type="checkbox" name="<?=$sch_ca_img_filed; ?>" id="<?=$sch_ca_img_filed; ?>" value="1" onclick="this.form.submit();"<?=( isset($_REQUEST[$sch_ca_img_filed]) && $_REQUEST[$sch_ca_img_filed] ) ? ' checked="checked"' : ''; ?>"> <label for="<?=$sch_ca_img_filed; ?>">이미지 <?=$_img_idx; ?></label>
	<? endfor; ?>



</form>

<form name="fcategorylist" method="post" action="./category_img_list_update.php" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div id="sct" class="tbl_head01 tbl_wrap">
    <table class="table_category_img_list">
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col"><?php echo subject_sort_link("ca_id"); ?>분류코드</a></th>
        <th scope="col" id="sct_cate"><?php echo subject_sort_link("ca_name"); ?>분류명</a></th>

		<?php
			for($_img_idx=1; $_img_idx<=$_shop_category_file_uplpad_count; $_img_idx++) {
		?>
			<th scope="col" nowrap><?php echo subject_sort_link("ca_img".$_img_idx); ?>이미지<?php echo $_img_idx; ?></a></th>
		<?php } ?>

        <th scope="col">관리</th>
    </tr>

    </thead>
    <tbody>
    <?php
    $s_upd = '';
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $level = strlen($row['ca_id']) / 2 - 1;
        $p_ca_name = '';

        if ($level > 0) {
            $class = 'class="name_lbl"'; // 2단 이상 분류의 label 에 스타일 부여 - 지운아빠 2013-04-02
            // 상위단계의 분류명
            $p_ca_id = substr($row['ca_id'], 0, $level*2);
            $sql = " select ca_name from {$g5['g5_shop_category_table']} where ca_id = '$p_ca_id' ";
            $temp = sql_fetch($sql);
            $p_ca_name = $temp['ca_name'].'의하위';
        } else {
            $class = '';
        }

        $s_level = '<div><label for="ca_name_'.$i.'" '.$class.'><span class="sound_only">'.$p_ca_name.''.($level+1).'단 분류</span></label></div>';
        $s_level_input_size = 25 - $level *2; // 하위 분류일 수록 입력칸 넓이 작아짐 - 지운아빠 2013-04-02


        $s_upd = '<a href="./categoryform.php?w=u&amp;ca_id='.$row['ca_id'].'#anc_scatefrm_img" class="btn btn_02"><span class="sound_only">'.get_text($row['ca_name']).' </span>수정</a> ';


        $bg = 'bg'.($i%2);
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_code">
			<?php echo $row['ca_id']; ?>
            <input type="hidden" name="ca_id[<?php echo $i; ?>]" value="<?php echo $row['ca_id']; ?>">
        </td>

        <td headers="sct_cate" class="sct_name<?php echo $level; ?>">
			<?php echo $s_level; ?> <?php echo "[".$row['ca_lang']."]".get_text($row['ca_name']); ?>
		</td>

	<?php 
		for($_img_idx=1; $_img_idx<=$_shop_category_file_uplpad_count; $_img_idx++) {
			$ca_img_filed = 'ca_img'.$_img_idx;
			$ca_img_del_filed = $ca_img_filed.'_del';
	?>
		<td class="td_ca_img" align="center">
			<div id="div_image_privew_<?php echo $ca_img_filed; ?>_<?php echo $i; ?>" style="cursor:pointer;margin:0 auto;max-width:70px;border:1px solid #000;display:none"></div>
			<div style="clear:both;width:100%;height:1px;"></div>
			<div class="category_filebox wf100p" style="margin:5px;">
				<label for="<?php echo $ca_img_filed; ?>_<?php echo $i; ?>">이미지 <?=$_img_idx; ?></label>

				<input type="file" name="<?php echo $ca_img_filed; ?>[<?php echo $i; ?>]" id="<?php echo $ca_img_filed; ?>_<?php echo $i; ?>" accept="image/*" capture="camera" class="frm_input frm_ca_file_filed">
			</div>

			<?php
				$ca_img = G5_DATA_PATH.'/category/'.$row[$ca_img_filed];
				$ca_img_exists = run_replace('shop_category_image_exists', (is_file($ca_img) && file_exists($ca_img)), $row, $_img_idx);

				if($ca_img_exists) {
					$thumb = get_ca_thumbnail_extend_category($row[$ca_img_filed], 50, 40);
					$img_tag = run_replace('shop_category_image_tag', '<img src="'.G5_DATA_URL.'/category/'.$row[$ca_img_filed].'" class="shop_item_preview_image shop_category_preview_image" >', $row, $_img_idx);
			?>
				<div class="category_space5"></div>
				<label for="<?=$ca_img_del_filed; ?>_<?php echo $i; ?>"><span class="sound_only">이미지 <?=$_img_idx; ?> </span>파일삭제</label>
				<input type="checkbox" name="<?=$ca_img_del_filed; ?>[<?php echo $i; ?>]" id="c<?=$ca_img_del_filed; ?>_<?php echo $i; ?>" value="1">
				<span class="sca_categoryform_wimg_limg sca_categoryform_wimg_limg<?=$_img_idx; ?> sca_wimg_limg<?=$_img_idx; ?>"><?=$thumb; ?></span>
			<?php  } ?>

		</td>
	<?php } ?>

        <td class="td_mng td_mng_s">
            <?php echo $s_upd; ?>
        </td>
    </tr>
 
    <?php }
    if ($i == 0) echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 한 건도 없습니다.</td></tr>\n";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <button type="button" class="btn" onclick="location.href='./categorylist.php';" style="background:#4a4a51;color:#fff;">분류 관리</button>

    <input type="submit" value="일괄수정" class="btn_02 btn">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
jQuery(function($){
	$(".frm_ca_file_filed").on("change", function(event) {

		var file = event.target.files[0];
		var sId = $(this).attr('id');
		var ext = $(this).val().split('.').pop().toLowerCase();
		$("#div_image_privew_"+sId).hide();

		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			alert('gif,png,jpg,jpeg 파일만 업로드 할수 있습니다.');
			return;
		}

		var reader = new FileReader(); 
		reader.onload = function(e) {
			$("#div_image_privew_"+sId).show();
			$("#div_image_privew_"+sId).html('<img src="'+e.target.result+'" width="70" alt="" />');
		}

		reader.readAsDataURL(file);
	});
});
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
