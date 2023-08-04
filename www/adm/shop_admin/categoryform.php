<?php
$sub_menu = '600100';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, "w");

$ca_id = isset($_GET['ca_id']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['ca_id']) : '';
$ca = array(
'ca_skin_dir'=>'',
'ca_mobile_skin_dir'=>'',
'ca_name'=>'',
'ca_order'=>'',
'ca_mb_id'=>'',
'ca_skin_dir'=>'',
'ca_cert_use'=>0,
'ca_adult_use'=>0,
'ca_sell_email'=>'',
'ca_nocoupon'=>0,
'ca_include_head'=>'',
'ca_include_tail'=>'',
'ca_head_html'=>'',
'ca_tail_html'=>'',
'ca_mobile_head_html'=>'',
'ca_mobile_tail_html'=>'',
);

for($i=0;$i<=10;$i++){
    $ca['ca_'.$i.'_subj'] = '';
    $ca['ca_'.$i] = '';
}

$sql_common = " from {$g5['g5_shop_category_table']} ";
if ($is_admin != 'super')
    $sql_common .= " where ca_mb_id = '{$member['mb_id']}' ";

if ($w == "")
{
    if ($is_admin != 'super' && !$ca_id)
        alert("최고관리자만 1단계 분류를 추가할 수 있습니다.");

    $len = strlen($ca_id);
    if ($len == 10)
        alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

    $len2 = $len + 1;

    $sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from {$g5['g5_shop_category_table']}
              where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
    $row = sql_fetch($sql);

    $subid = base_convert($row['max_subid'], 36, 10);
    $subid += 36;
    if ($subid >= 36 * 36)
    {
        //alert("분류를 더 이상 추가할 수 없습니다.");
        // 빈상태로
        $subid = "  ";
    }
    $subid = base_convert($subid, 10, 36);
    $subid = substr("00" . $subid, -2);
    $subid = $ca_id . $subid;

    $sublen = strlen($subid);

    if ($ca_id) // 2단계이상 분류
    {
        $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
        $ca = sql_fetch($sql);
        $html_title = $ca['ca_name'] . " 하위분류추가";
        $ca['ca_name'] = "";
    }
    else // 1단계 분류
    {
        $html_title = "1단계분류추가";
        $ca['ca_use'] = 1;
        $ca['ca_explan_html'] = 1;
        $ca['ca_img_width']  = $default['de_simg_width'];
        $ca['ca_img_height'] = $default['de_simg_height'];
        $ca['ca_mobile_img_width']  = $default['de_simg_width'];
        $ca['ca_mobile_img_height'] = $default['de_simg_height'];
        $ca['ca_list_mod'] = 3;
        $ca['ca_list_row'] = 5;
        $ca['ca_mobile_list_mod'] = 3;
        $ca['ca_mobile_list_row'] = 5;
        $ca['ca_stock_qty'] = 99999;
    }
    $ca['ca_skin'] = "list.10.skin.php";
    $ca['ca_mobile_skin'] = "list.10.skin.php";
}
else if ($w == "u")
{
    $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
    if (! (isset($ca['ca_id']) && $ca['ca_id']))
        alert("자료가 없습니다.");

    $html_title = $ca['ca_name'] . " 수정";
    $ca['ca_name'] = get_text($ca['ca_name']);
}

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');

$pg_anchor ='<ul class="anchor">
<li><a href="#anc_scatefrm_basic">기본정보</a></li>
<li><a href="#anc_scatefrm_detail">상세정보</a></li>';
$pg_anchor .= '</ul>';

// 쿠폰 적용 불가 설정 필드 추가
if(!sql_query(" select ca_nocoupon from {$g5['g5_shop_category_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_category_table']}`
                    ADD `ca_nocoupon` tinyint(4) NOT NULL DEFAULT '0' AFTER `ca_adult_use` ", true);
}

// 스킨 디렉토리 필드 추가
if(!sql_query(" select ca_skin_dir from {$g5['g5_shop_category_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_category_table']}`
                    ADD `ca_skin_dir` varchar(255) NOT NULL DEFAULT '' AFTER `ca_name`,
                    ADD `ca_mobile_skin_dir` varchar(255) NOT NULL DEFAULT '' AFTER `ca_skin_dir` ", true);
}

// 분류 출력순서 필드 추가
if(!sql_query(" select ca_order from {$g5['g5_shop_category_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_category_table']}`
                    ADD `ca_order` int(11) NOT NULL DEFAULT '0' AFTER `ca_name` ", true);
    sql_query(" ALTER TABLE `{$g5['g5_shop_category_table']}` ADD INDEX(`ca_order`) ", true);
}

// 모바일 상품 출력줄수 필드 추가
if(!sql_query(" select ca_mobile_list_row from {$g5['g5_shop_category_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_category_table']}`
                    ADD `ca_mobile_list_row` int(11) NOT NULL DEFAULT '0' AFTER `ca_mobile_list_mod` ", true);
}

// 스킨 Path
if(!$ca['ca_skin_dir'])
    $g5_shop_skin_path = G5_SHOP_SKIN_PATH;
else {
    if(preg_match('#^theme/(.+)$#', $ca['ca_skin_dir'], $match))
        $g5_shop_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $g5_shop_skin_path  = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_skin_dir'];
}

if(!$ca['ca_mobile_skin_dir'])
    $g5_mshop_skin_path = G5_MSHOP_SKIN_PATH;
else {
    if(preg_match('#^theme/(.+)$#', $ca['ca_mobile_skin_dir'], $match))
        $g5_mshop_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $g5_mshop_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_mobile_skin_dir'];
}
?>

<form name="fcategoryform" action="./categoryformupdate.php" onsubmit="return fcategoryformcheck(this);" method="post" enctype="multipart/form-data">

<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="ca_explan_html" value="<?php echo $ca['ca_explan_html']; ?>">

<section id="anc_scatefrm_basic">
    <h2 class="h2_frm">기본 정보</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>분류 추가 기본 정보</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="ca_id">분류코드</label></th>
            <td>
            <?php if ($w == "") { ?>
                <?php echo help("자동으로 보여지는 분류코드를 사용하시길 권해드리지만 직접 입력한 값으로도 사용할 수 있습니다.\n분류코드는 나중에 수정이 되지 않으므로 신중하게 결정하여 사용하십시오.\n\n분류코드는 2자리씩 10자리를 사용하여 5단계를 표현할 수 있습니다.\n0~z까지 입력이 가능하며 한 분류당 최대 1296가지를 표현할 수 있습니다.\n그러므로 총 3656158440062976가지의 분류를 사용할 수 있습니다."); ?>
                <input type="text" name="ca_id" value="<?php echo $subid; ?>" id="ca_id" required class="required frm_input" size="<?php echo $sublen; ?>" maxlength="<?php echo $sublen; ?>">
            <?php } else { ?>
                <input type="hidden" name="ca_id" value="<?php echo $ca['ca_id']; ?>">
                <span class="frm_ca_id"><?php echo $ca['ca_id']; ?></span>
                <a href="/sub/prod_list/<?php echo $ca['ca_id']; ?>" class="btn_frmline" target="_blank">미리보기</a>
            <?php } ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_lang">언어</label></th>
            <td>
                <select name="ca_lang" id="ca_lang" require>
                    <option value="">선택</option>
                    <option value="KOR" <?php echo $ca['ca_lang'] == 'KOR'?'selected':''; ?>>KOR</option>
                    <option value="ENG" <?php echo $ca['ca_lang'] == 'ENG'?'selected':''; ?>>ENG</option>
                    <option value="JPN" <?php echo $ca['ca_lang'] == 'JPN'?'selected':''; ?>>JPN</option>
                    <option value="CHI" <?php echo $ca['ca_lang'] == 'CHI'?'selected':''; ?>>CHI</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_name">분류명</label></th>
            <td><input type="text" name="ca_name" value="<?php echo $ca['ca_name']; ?>" id="ca_name" size="38" required class="required frm_input"></td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_1_subj">메뉴 표시명</label></th>
            <td><input type="text" name="ca_1_subj" value="<?php echo $ca['ca_1_subj']; ?>" id="ca_1_subj" size="38" required class="required frm_input"></td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_2_subj">한줄소개</label></th>
            <td><input type="text" name="ca_2_subj" value="<?php echo $ca['ca_2_subj']; ?>" id="ca_2_subj" size="100" required class="required frm_input"></td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_order">출력순서</label></th>
            <td>
                <?php echo help("숫자가 작을 수록 상위에 출력됩니다. 음수 입력도 가능하며 입력 가능 범위는 -2147483648 부터 2147483647 까지입니다.\n<b>입력하지 않으면 자동으로 출력됩니다.</b>"); ?>
                <input type="text" name="ca_order" value="<?php echo $ca['ca_order']; ?>" id="ca_order" class="frm_input" size="12">
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<section id="anc_scatefrm_detail">
    <h2 class="h2_frm">상세 정보</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>분류 추가 상세 정보</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="ca_3_subj">추가설명</label></th>
            <td><textarea name="ca_3_subj" id="ca_3_subj" class="mini_txtar"><?php echo html_purifier($ca['ca_3_subj']); ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_4_subj">상세설명</label></th>
            <td><textarea name="ca_4_subj" id="ca_4_subj" class="mini_txtar"><?php echo html_purifier($ca['ca_4_subj']); ?></textarea></td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_4_subj">주요기능</label></th>
            <td>
              <div class="major-func_wrap">
                <div class="major-func">
                  <?php
                  $ca_5_subj_arr = explode("||", $ca['ca_5_subj']);
                  $ca_6_subj_arr = explode("||", $ca['ca_6_subj']);

                  for($i = 0; $i < count($ca_5_subj_arr); $i++){
                  ?>
                  <div class="major-func-li">
                    <input type="text" name="ca_5_subj[]" value="<?php echo $ca_5_subj_arr[$i]; ?>" size="40" class="frm_input inpt-s">
                    <input type="text" name="ca_6_subj[]" value="<?php echo $ca_6_subj_arr[$i]; ?>" size="80" class="frm_input inpt-m">
                    <button type="button" class="func_btn delete"><i class="fa fa-minus" aria-hidden="true"></i></button>
                  </div>
                  <?php } ?>
                </div>
                <button type="button" class="func_btn add"><i class="fa fa-plus" aria-hidden="true"></i> Add field</button>
              </div>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_7_subj">슬로건 문구</label></th>
            <td><textarea name="ca_7_subj" id="ca_7_subj" class="mini_txtar"><?php echo html_purifier($ca['ca_7_subj']); ?></textarea></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<div class="btn_fixed_top">
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
    <a href="./categorylist.php?<?php echo $qstr; ?>" class="btn_02 btn">목록</a>

    <button type="button" class="btn" onclick="location.href='./category_img_list.php';" style="background:#4a4a51;color:#fff;">분류 이미지 관리</button>
</div>
</form>

<script>
$(document).ready(function(){
  const $majorFuncWrap = $(".major-func_wrap");
  const $majorFunc = $(".major-func");
  const majorFunc_add = ".func_btn.add";
  const majorFunc_del = ".func_btn.delete";

  const majorFunc_list = `<div class="major-func-li">
    <input type="text" name="ca_5_subj[]" value="" size="40" class="frm_input inpt-s">
    <input type="text" name="ca_6_subj[]" value="" size="80" class="frm_input inpt-m">
    <button type="button" class="func_btn delete"><i class="fa fa-minus" aria-hidden="true"></i></button>
  </div>`;

  $majorFuncWrap.on('click', majorFunc_add, function(){
    let majorFunc_list_leng = $majorFunc.find(".major-func-li").length;

    if(majorFunc_list_leng <= 2) {
      $majorFunc.append(majorFunc_list);
    } else {
      alert("최대 3개까지 추가할 수 있습니다.")
    }
  })

  $majorFuncWrap.on('click', majorFunc_del, function(){
    let majorFunc_list_cur = $(this).closest(".major-func-li");

    majorFunc_list_cur.remove();
  })
});

<?php if ($w == 'u') { ?>
$(".banner_or_img").addClass("sit_wimg");
$(function() {
    $(".sit_wimg_view").bind("click", function() {
        var sit_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sit_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        var $img = $("#"+sit_wimg_id[1]).children("img");
        var width = $img.width();
        var height = $img.height();
        if(width > 700) {
            var img_width = 700;
            var img_height = Math.round((img_width * height) / width);

            $img.width(img_width).height(img_height);
        }
    });
    $(".sit_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
        var $button = $("#ca_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });
});
<?php } ?>

function fcategoryformcheck(f)
{
    if (f.w.value == "") {
        var error = "";
        $.ajax({
            url: "./ajax.ca_id.php",
            type: "POST",
            data: {
                "ca_id": f.ca_id.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                error = data.error;
            }
        });

        if (error) {
            alert(error);
            return false;
        }
    }

    <?php echo get_editor_js('ca_head_html'); ?>
    <?php echo get_editor_js('ca_tail_html'); ?>
    <?php echo get_editor_js('ca_mobile_head_html'); ?>
    <?php echo get_editor_js('ca_mobile_tail_html'); ?>

    return true;
}

var captcha_chk = false;

function use_captcha_check(){
    $.ajax({
        type: "POST",
        url: g5_admin_url+"/ajax.use_captcha.php",
        data: { admin_use_captcha: "1" },
        cache: false,
        async: false,
        dataType: "json",
        success: function(data) {
        }
    });
}

function frm_check_file(){
    var ca_include_head = "<?php echo $ca['ca_include_head']; ?>";
    var ca_include_tail = "<?php echo $ca['ca_include_tail']; ?>";
    var head = jQuery.trim(jQuery("#ca_include_head").val());
    var tail = jQuery.trim(jQuery("#ca_include_tail").val());

    if(ca_include_head !== head || ca_include_tail !== tail){
        // 캡챠를 사용합니다.
        jQuery("#admin_captcha_box").show();
        captcha_chk = true;

        use_captcha_check();

        return false;
    } else {
        jQuery("#admin_captcha_box").hide();
    }

    return true;
}

jQuery(function($){
    if( window.self !== window.top ){   // frame 또는 iframe을 사용할 경우 체크
        $("#ca_include_head, #ca_include_tail").on("change paste keyup", function(e) {
            frm_check_file();
        });

        use_captcha_check();
    }

    $(".shop_category").on("click", function() {
        if(!confirm("현재 테마의 스킨, 이미지 사이즈 등의 설정을 적용하시겠습니까?"))
            return false;

        $.ajax({
            type: "POST",
            url: "../theme_config_load.php",
            cache: false,
            async: false,
            data: { type: 'shop_category' },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                $.each(data, function(key, val) {
                    if(key == "error")
                        return true;

                    $("#"+key).val(val);
                });
            }
        });
    });
});

/*document.fcategoryform.ca_name.focus(); 포커스 해제*/
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');