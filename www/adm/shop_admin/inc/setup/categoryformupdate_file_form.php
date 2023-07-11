<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//define('G5_IS_ADMIN', true);
include_once (G5_ADMIN_PATH.'/shop_admin/inc/db/shop_category_table_filed_add.php'); // 분류 이미지관련 필드 추가

?>
<section id="anc_scatefrm_img">
    <h2 class="h2_frm">이미지</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table class="categoryform_file_table">
        <caption>이미지 업로드</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <?php 
			for($i=1; $i<=$_shop_category_file_uplpad_count; $i++) { 
				$ca_img = G5_DATA_PATH.'/category/'.$ca['ca_img'.$i];

				$_g5_shop_category_table_after_filed = ($i == 1) ? 'ca_10' : 'ca_img'.($i -1);
				$result_filed_row = sql_fetch(" SHOW COLUMNS FROM {$g5['g5_shop_category_table']} LIKE 'ca_img".$i."' ");
				if($result_filed_row['Field']) { // 분류 이미지
					$_filed_exits = 'y';
					$ca_img_exists = run_replace('shop_category_image_exists', (is_file($ca_img) && file_exists($ca_img)), $ca, $i);
				} else {
					$_filed_exits = 'n';
					$ca_img_exists = '';
					sql_query(" ALTER TABLE {$g5['g5_shop_category_table']} ADD `ca_img".$i."` VARCHAR(255) NULL DEFAULT '' AFTER `".$_g5_shop_category_table_after_filed."` ", FALSE);
				}
		?>
        <tr class="categoryform_file_tr categoryform_file_tr<?php echo $i; ?>">
            <th scope="row">
				<label for="ca_img<?php echo $i; ?>">이미지 <?php echo $i; ?></label>
				<span class="categoryform_file_span categoryform_file_span<?php echo $i; ?>"><?//php echo $_filed_exits; ?></span>
				<div style="clear:both;width:100%;height:1px;"></div>
				<div id="div_image_privew_ca_img<?php echo $i; ?>" style="cursor:pointer;margin:0;max-width:70px;border:1px solid #000;display:none"></div>
			</th>
            <td>
				<input type="file" name="ca_img<?php echo $i; ?>" id="ca_img<?php echo $i; ?>" accept="image/*" capture="camera" class="frm_input frm_ca_file_filed">
				<?php

				if($ca_img_exists) {
					$thumb = get_ca_thumbnail_extend_category($ca['ca_img'.$i], 25, 25);
					$img_tag = run_replace('shop_category_image_tag', '<img src="'.G5_DATA_URL.'/category/'.$ca['ca_img'.$i].'" class="shop_item_preview_image shop_category_preview_image" >', $ca, $i);
				?>
					<label for="ca_img<?php echo $i; ?>_del"><span class="sound_only">이미지 <?php echo $i; ?> </span>파일삭제</label>
					<input type="checkbox" name="ca_img<?php echo $i; ?>_del" id="ca_img<?php echo $i; ?>_del" value="1">
					<span class="sca_wimg_limg<?php echo $i; ?>"><?php echo $thumb; ?> <span class="sca_wimg_lbtn<?php echo $i; ?>"></span></span>
					<div id="limg<?php echo $i; ?>" class="banner_or_img">
						<?php echo $img_tag; ?>
						<button type="button" class="sca_wimg_close">닫기</button>
					</div>
					<script>
					$(function() {
						$('<button type="button" id="ca_limg<?php echo $i; ?>_view" class="btn_frmline sca_wimg_view">이미지<?php echo $i; ?> 확인</button>').appendTo('.sca_wimg_lbtn<?php echo $i; ?>');
					});
					</script>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</section>
<script>
$(function() {
	var anchor_scatefrm_img = window.location.hash;
	if( anchor_scatefrm_img == '#anc_scatefrm_img') {
		var anchor_scatefrm_offset = $('#anc_scatefrm_img').offset(); //선택한 태그의 위치를 반환
	    $('html').animate({scrollTop : anchor_scatefrm_offset.top}, 1000);
	}

    $(".sca_wimg_view").bind("click", function() {
        var sca_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sca_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        var $img = $("#"+sca_wimg_id[1]).children("img");
        var width = $img.width();
        var height = $img.height();
        if(width > 700) {
            var img_width = 700;
            var img_height = Math.round((img_width * height) / width);

            $img.width(img_width).height(img_height);
        }
    });
    $(".sca_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
        var $button = $("#ca_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });

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