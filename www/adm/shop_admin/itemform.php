<?php
$sub_menu = '600200';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

auth_check_menu($auth, $sub_menu, "w");

$html_title = "제품 ";

$it = array(
'it_id'=>'',
'it_skin'=>'',
'it_mobile_skin'=>'',
'it_name'=>'',
'it_basic'=>'',
'it_order'=>0,
'it_type1'=>0,
'it_type2'=>0,
'it_type3'=>0,
'it_type4'=>0,
'it_type5'=>0,
'it_brand'=>'',
'it_model'=>'',
'it_tel_inq'=>0,
'it_use'=>0,
'it_nocoupon'=>0,
'ec_mall_pid'=>'',
'it_mobile_explan'=>'',
'it_sell_email'=>'',
'it_shop_memo'=>'',
'it_info_gubun'=>'',
'it_explan'=>'',
'it_point_type'=>0,
'it_cust_price'=>0,
'it_option_subject'=>'',
'it_price'=>0,
'it_point'=>0,
'it_supply_point'=>0,
'it_soldout'=>0,
'it_stock_sms'=>0,
'it_stock_qty'=>0,
'it_noti_qty'=>0,
'it_buy_min_qty'=>0,
'it_buy_max_qty'=>0,
'it_notax'=>0,
'it_supply_subject'=>'',
'it_sc_type'=>0,
'it_sc_method'=>0,
'it_sc_price'=>0,
'it_sc_minimum'=>0,
'it_sc_qty'=>0,
'it_img1'=>'',
'it_img2'=>'',
'it_img3'=>'',
'it_img4'=>'',
'it_img5'=>'',
'it_img6'=>'',
'it_img7'=>'',
'it_img8'=>'',
'it_img9'=>'',
'it_img10'=>'',
'it_head_html'=>'',
'it_tail_html'=>'',
'it_mobile_head_html'=>'',
'it_mobile_tail_html'=>'',
);

for($i=0;$i<=10;$i++){
    $it['it_'.$i.'_subj'] = '';
    $it['it_'.$i] = '';
}

if ($w == "")
{
    $html_title .= "입력";

    // 옵션은 쿠키에 저장된 값을 보여줌. 다음 입력을 위한것임
    //$it[ca_id] = _COOKIE[ck_ca_id];
    $it['ca_id'] = get_cookie("ck_ca_id");
    $it['ca_id2'] = get_cookie("ck_ca_id2");
    $it['ca_id3'] = get_cookie("ck_ca_id3");
    if (!$it['ca_id'])
    {
        $sql = " select ca_id from {$g5['g5_shop_category_table']} order by ca_order, ca_id limit 1 ";
        $row = sql_fetch($sql);
        if (! (isset($row['ca_id']) && $row['ca_id']))
            alert("등록된 분류가 없습니다. 우선 분류를 등록하여 주십시오.", './categorylist.php');
        $it['ca_id'] = $row['ca_id'];
    }
    //$it[it_maker]  = stripslashes($_COOKIE[ck_maker]);
    //$it[it_origin] = stripslashes($_COOKIE[ck_origin]);
    $it['it_maker']  = stripslashes(get_cookie("ck_maker"));
    $it['it_origin'] = stripslashes(get_cookie("ck_origin"));
}
else if ($w == "u")
{
    $html_title .= "수정";

    if ($is_admin != 'super')
    {
        $sql = " select it_id from {$g5['g5_shop_item_table']} a, {$g5['g5_shop_category_table']} b
                  where a.it_id = '$it_id'
                    and a.ca_id = b.ca_id
                    and b.ca_mb_id = '{$member['mb_id']}' ";
        $row = sql_fetch($sql);
        if (!$row['it_id'])
            alert("\'{$member['mb_id']}\' 님께서 수정 할 권한이 없는 제품입니다.");
    }

    $it = get_shop_item($it_id);

    if(!$it)
        alert('제품정보가 존재하지 않습니다.');

    if (! (isset($ca_id) && $ca_id))
        $ca_id = $it['ca_id'];

    $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
}
else
{
    alert();
}

$qstr  = $qstr.'&amp;sca='.$sca.'&amp;page='.$page;

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');

// 분류리스트
$category_select = '';
$script = '';
$sql = " select * from {$g5['g5_shop_category_table']} ";
if ($is_admin != 'super')
    $sql .= " where ca_mb_id = '{$member['mb_id']}' ";
$sql .= " order by ca_order, ca_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $len = strlen($row['ca_id']) / 2 - 1;

    $nbsp = "";
    for ($i=0; $i<$len; $i++)
        $nbsp .= "&nbsp;&nbsp;&nbsp;";

    $category_select .= "<option value=\"{$row['ca_id']}\">$nbsp{$row['ca_name']}</option>\n";

    $script .= "ca_use['{$row['ca_id']}'] = {$row['ca_use']};\n";
    $script .= "ca_stock_qty['{$row['ca_id']}'] = {$row['ca_stock_qty']};\n";
    //$script .= "ca_explan_html['$row[ca_id]'] = $row[ca_explan_html];\n";
    $script .= "ca_sell_email['{$row['ca_id']}'] = '{$row['ca_sell_email']}';\n";
}

// 재입고알림 설정 필드 추가
if(!sql_query(" select it_stock_sms from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_stock_sms` tinyint(4) NOT NULL DEFAULT '0' AFTER `it_stock_qty` ", true);
}

// 추가옵션 포인트 설정 필드 추가
if(!sql_query(" select it_supply_point from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_supply_point` int(11) NOT NULL DEFAULT '0' AFTER `it_point_type` ", true);
}

// 제품메모 필드 추가
if(!sql_query(" select it_shop_memo from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_shop_memo` text NOT NULL AFTER `it_use_avg` ", true);
}

// 지식쇼핑 PID 필드추가
// 제품메모 필드 추가
if(!sql_query(" select ec_mall_pid from {$g5['g5_shop_item_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `ec_mall_pid` varchar(255) NOT NULL AFTER `it_shop_memo` ", true);
}

$pg_anchor ='<ul class="anchor">
<li><a href="#anc_sitfrm_cate">제품분류</a></li>
<li><a href="#anc_sitfrm_ini">기본정보</a></li>
<li><a href="#img-sec1">대표이미지</a></li>
<li><a href="#img-sec2">롤링이미지</a></li>
<li><a href="#img-sec3">상세이미지</a></li>
<li><a href="#etc-settings">기타설정</a></li>
</ul>
';


// 쿠폰적용안함 설정 필드 추가
if(!sql_query(" select it_nocoupon from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_nocoupon` tinyint(4) NOT NULL DEFAULT '0' AFTER `it_use` ", true);
}

// 스킨필드 추가
if(!sql_query(" select it_skin from {$g5['g5_shop_item_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_table']}`
                    ADD `it_skin` varchar(255) NOT NULL DEFAULT '' AFTER `ca_id3`,
                    ADD `it_mobile_skin` varchar(255) NOT NULL DEFAULT '' AFTER `it_skin` ", true);
}
?>

<form name="fitemform" action="./itemformupdate.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">

<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod"  value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx"  value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<section id="anc_sitfrm_cate">
    <h2 class="h2_frm">제품분류</h2>
    <?php echo $pg_anchor; ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>제품분류 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="ca_id">기본분류</label></th>
            <td>
                <?php if ($w == "") echo help("기본분류를 선택하면, 판매/재고/HTML사용/판매자 E-mail 등을, 선택한 분류의 기본값으로 설정합니다."); ?>
                <select name="ca_id" id="ca_id" onchange="categorychange(this.form)">
                    <option value="">선택하세요</option>
                    <?php echo conv_selected_option($category_select, $it['ca_id']); ?>
                </select>
                <script>
                    var ca_use = new Array();
                    var ca_stock_qty = new Array();
                    //var ca_explan_html = new Array();
                    var ca_sell_email = new Array();
                    var ca_opt1_subject = new Array();
                    var ca_opt2_subject = new Array();
                    var ca_opt3_subject = new Array();
                    var ca_opt4_subject = new Array();
                    var ca_opt5_subject = new Array();
                    var ca_opt6_subject = new Array();
                    <?php echo "\n$script"; ?>
                </script>
            </td>
        </tr>
        <!--
        <?php for ($i=2; $i<=3; $i++) { ?>
        <tr>
            <th scope="row"><label for="ca_id<?php echo $i; ?>"><?php echo $i; ?>차 분류</label></th>
            <td>
                <?php echo help($i.'차 분류는 기본 분류의 하위 분류 개념이 아니므로 기본 분류 선택시 해당 제품이 포함될 최하위 분류만 선택하시면 됩니다.'); ?>
                <select name="ca_id<?php echo $i; ?>" id="ca_id<?php echo $i; ?>">
                    <option value="">선택하세요</option>
                    <?php echo conv_selected_option($category_select, $it['ca_id'.$i]); ?>
                </select>
            </td>
        </tr>
        <?php } ?>
        -->
        </tbody>
        </table>
    </div>
</section>

<section id="anc_sitfrm_ini">
    <h2 class="h2_frm">기본정보</h2>
    <?php echo $pg_anchor; ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>기본정보 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
        <tbody>
        <tr>
            <th scope="row">제품코드</th>
            <td>
                <?php if ($w == '') { // 추가 ?>
                    <?php echo help("제품의 코드는 10자리 숫자로 자동생성합니다. <b>직접 제품코드를 입력할 수도 있습니다.</b>\n제품코드는 영문자, 숫자, - 만 입력 가능합니다."); ?>
                    <input type="text" name="it_id" value="<?php echo time(); ?>" id="it_id" required class="frm_input required" size="20" maxlength="20">
                <?php } else { ?>
                    <input type="hidden" name="it_id" value="<?php echo $it['it_id']; ?>">
                    <span class="frm_ca_id"><?php echo $it['it_id']; ?></span>
                    <a href="/sub/prod_view/<?php echo $it_id; ?>" class="btn_frmline" target="_blank">제품확인</a>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_name">제품명</label></th>
            <td>
                <input type="text" name="it_name" value="<?php echo get_text(cut_str($it['it_name'], 250, "")); ?>" id="it_name" required class="frm_input required" size="95">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_basic">기본설명</label></th>
            <td>
                <textarea name="it_basic" id="it_basic" required class="mini_txtar required"><?php echo html_purifier($it['it_basic']); ?></textarea>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_1_subj">제품사양(표)</label></th>
            <td>
              <div class="item-spec_wrap">
                <div class="item-spec">
                  <?php
                  $it_1_subj_arr = explode("||", $it['it_1_subj']);
                  $it_2_subj_arr = explode("||", $it['it_2_subj']);

                  for($i = 0; $i < count($it_1_subj_arr); $i++){
                  ?>
                  <div class="item-spec-li">
                    <div class="item-spec-li-dp1">
                      <input type="text" name="it_1_subj[]" value="<?php echo $it_1_subj_arr[$i]; ?>" size="40" class="frm_input inpt-s">
                      <input type="hidden" name="it_2_subj[]" value="<?php echo $it_2_subj_arr[$i]; ?>">
                    </div>
                    <div class="item-spec-li-dp2">
                      <?php
                      $it_2_subj_2arr = explode("|", $it_2_subj_arr[$i]);

                      for($k = 0; $k < count($it_2_subj_2arr); $k++){
                      ?>
                      <div class="item-spec-li-dp2-box">
                        <input type="text" name="it-spec-<?php echo $i;?>_2" value="<?php echo $it_2_subj_2arr[$k]; ?>" size="65" class="frm_input inpt-m item-spec-dp2-expl">
                        <?php if($k == 0) { ?>
                        <button type="button" class="item-spec_btn col-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <?php } ?>
                        <button type="button" class="item-spec_btn delete <?php echo $k == 0?'all':'';?>"><i class="fa fa-minus" aria-hidden="true"></i></button>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <button type="button" class="item-spec_btn add"><i class="fa fa-plus" aria-hidden="true"></i> Add field</button>
              </div>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_3_subj">추가설명</label></th>
            <td>
              타이틀 : <input type="text" name="it_3_subj" value="<?php echo $it['it_3_subj']; ?>" size="80" class="frm_input">
              <div style="margin-top: 10px; padding: 20px; background-color: #fafafa">
                <div class="item-add_wrap">
                  <div class="item-add">
                    <?php
                    $it_4_subj_arr = explode("||", $it['it_4_subj']);

                    for($i = 0; $i < count($it_4_subj_arr); $i++){
                    ?>
                    <div class="item-add-li">
                      <input type="text" name="it_4_subj[]" value="<?php echo $it_4_subj_arr[$i]; ?>" size="80" class="frm_input inpt-m">
                      <button type="button" class="item-add_btn delete"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </div>
                    <?php } ?>
                  </div>
                  <button type="button" class="item-add_btn add"><i class="fa fa-plus" aria-hidden="true"></i> Add field</button>
                </div>
              </div>
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>


<script>
$(document).ready(function(){
  const $itemSpecWrap = $(".item-spec_wrap");
  const $itemSpec = $(".item-spec");
  const itemSpec_add = ".item-spec_btn.add";
  const itemSpec_del = ".item-spec_btn.delete";
  const itemSpec_colAdd = ".item-spec_btn.col-add";

  $itemSpecWrap.on('click', itemSpec_add, function(){
    let itemSpec_list_leng = $itemSpec.find(".item-spec-li").length;

    if(itemSpec_list_leng <= 9) {
      let itemSpec_list = `<div class="item-spec-li">
        <div class="item-spec-li-dp1">
          <input type="text" name="it_1_subj[]" value="" size="40" class="frm_input inpt-s">
          <input type="hidden" name="it_2_subj[]" value="">
        </div>
        <div class="item-spec-li-dp2">
          <input type="text" name="it-spec-${itemSpec_list_leng}_2" value="" size="65" class="frm_input inpt-m item-spec-dp2-expl">
          <button type="button" class="item-spec_btn col-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
          <button type="button" class="item-spec_btn delete all"><i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
      </div>`;

      $itemSpec.append(itemSpec_list);
    } else {
      alert("최대 10개까지 추가할 수 있습니다.")
    }
  })

  $itemSpecWrap.on('click', itemSpec_del, function(){
    let itemSpec_2dp = $(this).closest(".item-spec-li-dp2").find(".item-spec-li-dp2-box");
    let itemSpec_2dp_leng = itemSpec_2dp.length;
    let itemSpec_2dp_index = $(this).closest(".item-spec-li-dp2-box").index();
    let itemSpec_list_cur = "";
    
    if($(this).hasClass("all")){
      itemSpec_list_cur = $(this).closest(".item-spec-li");
    } else {
      itemSpec_list_cur = $(this).closest(".item-spec-li-dp2-box");
    }

    let itemSpec_2dp_input = $(this).closest(".item-spec-li-dp2-box").find(".item-spec-dp2-expl");
    let targetInput = itemSpec_2dp_input.attr('name');
    let itemSpec_dp2_leng = $(`input[name=${targetInput}]`).length;
    let itemSpec_dp2_val = "";
    for(i=0; i<itemSpec_dp2_leng; i++) {
      if(i == 0){
        if (i == itemSpec_2dp_index) {
          itemSpec_dp2_val += "";
        } else {
          itemSpec_dp2_val += $(`input[name=${targetInput}`).eq(i).val();
        }
      } else if (i == itemSpec_2dp_index) {
        itemSpec_dp2_val += "";
      } else {
        itemSpec_dp2_val += "|"+$(`input[name=${targetInput}`).eq(i).val();
      }
    }

    if(itemSpec_dp2_val.charAt(0) == "|") {
      itemSpec_dp2_val = itemSpec_dp2_val.substring(1)
    }

    $(this).closest(".item-spec-li").find("input[name^=it_2_subj]").val(itemSpec_dp2_val);

    itemSpec_list_cur.remove();
  })

  $itemSpecWrap.on('click', itemSpec_colAdd, function(){
    let itemSpec_list_index = $(this).closest(".item-spec-li").index();
    let itemSpec_col_list = `<div class="item-spec-li-dp2-box">
        <input type="text" name="it-spec-${itemSpec_list_index}_2" value="" size="65" class="frm_input inpt-m item-spec-dp2-expl">
        <button type="button" class="item-spec_btn delete"><i class="fa fa-minus" aria-hidden="true"></i></button>
      </div>`;

    $(this).closest(".item-spec-li-dp2").append(itemSpec_col_list);
  })

  $itemSpecWrap.on('keyup', ".item-spec-dp2-expl", function(){
    let targetInput = $(this).attr('name');
    let itemSpec_dp2_leng = $(`input[name=${targetInput}]`).length;
    let itemSpec_dp2_val = "";
    
    for(i=0; i<itemSpec_dp2_leng; i++) {
      if(i == 0){
        itemSpec_dp2_val += $(`input[name=${targetInput}`).eq(i).val();
      } else {
        itemSpec_dp2_val += "|"+$(`input[name=${targetInput}`).eq(i).val();
      }
    }

    $(this).closest(".item-spec-li").find("input[name^=it_2_subj]").val(itemSpec_dp2_val);
  });


  const $itemAddWrap = $(".item-add_wrap");
  const $itemAdd = $(".item-add");
  const itemAdd_add = ".item-add_btn.add";
  const itemAdd_del = ".item-add_btn.delete";

  const itemAdd_list = `<div class="item-add-li">
    <input type="text" name="it_4_subj[]" value="" size="80" class="frm_input inpt-m">
    <button type="button" class="item-add_btn delete"><i class="fa fa-minus" aria-hidden="true"></i></button>
  </div>`;

  $itemAddWrap.on('click', itemAdd_add, function(){
    let itemAdd_list_leng = $itemAdd.find(".item-add-li").length;

    if(itemAdd_list_leng <= 9) {
      $itemAdd.append(itemAdd_list);
    } else {
      alert("최대 10개까지 추가할 수 있습니다.")
    }
  })

  $itemAddWrap.on('click', itemAdd_del, function(){
    let itemAdd_list_cur = $(this).closest(".item-add-li");

    itemAdd_list_cur.remove();
  })
});

$(function(){
    $(document).on("change", "#it_info_gubun", function() {
        var gubun = $(this).val();
        $.post(
            "<?php echo G5_ADMIN_URL; ?>/shop_admin/iteminfo.php",
            { it_id: "<?php echo $it['it_id']; ?>", gubun: gubun },
            function(data) {
                $("#sit_compact_fields").empty().html(data);
            }
        );
    });
});
</script>

<section id="img-sec1">
    <h2 class="h2_frm">대표 이미지</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>이미지 업로드</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="it_img1">대표 이미지</label></th>
            <td>
                <input type="file" name="it_img1" id="it_img1">
                <?php
                $it_img = G5_DATA_PATH.'/item/'.$it['it_img1'];
                $it_img_exists = run_replace('shop_item_image_exists', (is_file($it_img) && file_exists($it_img)), $it, 1);

                if($it_img_exists) {
                    $thumb = get_it_thumbnail($it['it_img1'], 25, 25);
                    $img_tag = run_replace('shop_item_image_tag', '<img src="'.G5_DATA_URL.'/item/'.$it['it_img1'].'" class="shop_item_preview_image" >', $it, 1);
                ?>
                <label for="it_img1_del"><span class="sound_only">이미지 1 </span>파일삭제</label>
                <input type="checkbox" name="it_img1_del" id="it_img1_del" value="1">
                <span class="sit_wimg_limg1"><?php echo $thumb; ?></span>
                <div id="limg1" class="banner_or_img">
                    <?php echo $img_tag; ?>
                    <button type="button" class="sit_wimg_close">닫기</button>
                </div>
                <script>
                $('<button type="button" id="it_limg1_view" class="btn_frmline sit_wimg_view">이미지1 확인</button>').appendTo('.sit_wimg_limg1');
                </script>
                <?php } ?>
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<section id="img-sec2">
    <h2 class="h2_frm">롤링 이미지</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>이미지 업로드</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <?php 
        for($i=2; $i<=6; $i++) { 
          $it_roll_num = $i - 1;
        ?>
        <tr>
            <th scope="row"><label for="it_img<?php echo $i; ?>">이미지 <?php echo ($i - 1); ?></label><br/>/ 이미지 설명</th>
            <td>
                <input type="file" name="it_img<?php echo $i; ?>" id="it_img<?php echo $i; ?>">
                <?php
                $it_img = G5_DATA_PATH.'/item/'.$it['it_img'.$i];
                $it_img_exists = run_replace('shop_item_image_exists', (is_file($it_img) && file_exists($it_img)), $it, $i);

                if($it_img_exists) {
                    $thumb = get_it_thumbnail($it['it_img'.$i], 25, 25);
                    $img_tag = run_replace('shop_item_image_tag', '<img src="'.G5_DATA_URL.'/item/'.$it['it_img'.$i].'" class="shop_item_preview_image" >', $it, $i);
                ?>
                <label for="it_img<?php echo $i; ?>_del"><span class="sound_only">이미지 <?php echo $i; ?> </span>파일삭제</label>
                <input type="checkbox" name="it_img<?php echo $i; ?>_del" id="it_img<?php echo $i; ?>_del" value="1">
                <span class="sit_wimg_limg<?php echo $i; ?>"><?php echo $thumb; ?></span>
                <?php } ?>

                <div style="margin: 10px 0;">
                  <input type="text" name="it_<?php echo $it_roll_num;?>" value="<?php echo $it['it_'.$it_roll_num];?>" class="frm_input" size="80">
                </div>

                <?php if($it_img_exists) { ?>
                <div id="limg<?php echo $i; ?>" class="banner_or_img">
                    <?php echo $img_tag; ?>
                    <button type="button" class="sit_wimg_close">닫기</button>
                </div>
                <script>
                $('<button type="button" id="it_limg<?php echo $i; ?>_view" class="btn_frmline sit_wimg_view">이미지<?php echo $i; ?> 확인</button>').appendTo('.sit_wimg_limg<?php echo $i; ?>');
                </script>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</section>

<section id="img-sec2">
    <h2 class="h2_frm">상세 이미지</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>이미지 업로드</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <?php 
        for($i=7; $i<=10; $i++) { 
          $it_detail_num = $i - 1;
        ?>
        <tr>
            <th scope="row"><label for="it_img<?php echo $i; ?>">이미지 <?php echo ($i - 6); ?><br/>/ 이미지 설명</label></th>
            <td>
                <input type="file" name="it_img<?php echo $i; ?>" id="it_img<?php echo $i; ?>">
                <?php
                $it_img = G5_DATA_PATH.'/item/'.$it['it_img'.$i];
                $it_img_exists = run_replace('shop_item_image_exists', (is_file($it_img) && file_exists($it_img)), $it, $i);

                if($it_img_exists) {
                    $thumb = get_it_thumbnail($it['it_img'.$i], 25, 25);
                    $img_tag = run_replace('shop_item_image_tag', '<img src="'.G5_DATA_URL.'/item/'.$it['it_img'.$i].'" class="shop_item_preview_image" >', $it, $i);
                ?>
                <label for="it_img<?php echo $i; ?>_del"><span class="sound_only">이미지 <?php echo $i; ?> </span>파일삭제</label>
                <input type="checkbox" name="it_img<?php echo $i; ?>_del" id="it_img<?php echo $i; ?>_del" value="1">
                <span class="sit_wimg_limg<?php echo $i; ?>"><?php echo $thumb; ?></span>
                <?php } ?>

                <div style="margin: 10px 0;">
                  <input type="text" name="it_<?php echo $it_detail_num;?>" value="<?php echo $it['it_'.$it_detail_num];?>" class="frm_input" size="80">
                </div>

                <?php if($it_img_exists) { ?>
                <div id="limg<?php echo $i; ?>" class="banner_or_img">
                    <?php echo $img_tag; ?>
                    <button type="button" class="sit_wimg_close">닫기</button>
                </div>
                <script>
                $('<button type="button" id="it_limg<?php echo $i; ?>_view" class="btn_frmline sit_wimg_view">이미지<?php echo $i; ?> 확인</button>').appendTo('.sit_wimg_limg<?php echo $i; ?>');
                </script>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</section>

<section id="etc-settings">
    <h2 class="h2_frm">기타설정</h2>
    <?php echo $pg_anchor; ?>
    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>기타설정 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="it_order">출력순서</label></th>
            <td>
                <?php echo help("숫자가 작을 수록 상위에 출력됩니다. 음수 입력도 가능하며 입력 가능 범위는 -2147483648 부터 2147483647 까지입니다.\n<b>입력하지 않으면 자동으로 출력됩니다.</b>"); ?>
                <input type="text" name="it_order" value="<?php echo $it['it_order']; ?>" id="it_order" class="frm_input" size="12">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="it_use">노출여부</label></th>
            <td>
                <?php echo help("제품 노출 여부를 선택합니다."); ?>
                <input type="checkbox" name="it_use" value="1" id="it_use" <?php echo ($it['it_use']) ? "checked" : ""; ?>> 예
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<div class="btn_fixed_top">
    <a href="./itemlist.php?<?php echo $qstr; ?>" class="btn btn_02">목록</a>
    <a href="<?php echo shop_item_url($it_id); ?>" class="btn_02  btn">제품보기</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
</div>
</form>


<script>
var f = document.fitemform;

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
        var $button = $("#it_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });
});
<?php } ?>

function fitemformcheck(f)
{
    if (!f.ca_id.value) {
        alert("기본분류를 선택하십시오.");
        f.ca_id.focus();
        return false;
    }

    if (f.w.value == "") {
        var error = "";
        $.ajax({
            url: "./ajax.it_id.php",
            type: "POST",
            data: {
                "it_id": f.it_id.value
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

    if(f.it_point_type.value == "1" || f.it_point_type.value == "2") {
        var point = parseInt(f.it_point.value);
        if(point < 0 || point > 99) {
            alert("포인트 비율을 0과 99 사이의 값으로 입력해 주십시오.");
            f.it_point.focus();
            f.it_point.select();
            return false;
        }
    }

    if(parseInt(f.it_sc_type.value) > 1) {
        if(!f.it_sc_price.value || f.it_sc_price.value == "0") {
            alert("기본배송비를 입력해 주십시오.");
            return false;
        }

        if(f.it_sc_type.value == "2" && (!f.it_sc_minimum.value || f.it_sc_minimum.value == "0")) {
            alert("배송비 상세조건의 주문금액을 입력해 주십시오.");
            return false;
        }

        if(f.it_sc_type.value == "4" && (!f.it_sc_qty.value || f.it_sc_qty.value == "0")) {
            alert("배송비 상세조건의 주문수량을 입력해 주십시오.");
            return false;
        }
    }

    // 관련제품처리
    var item = new Array();
    var re_item = it_id = "";

    $("#reg_relation input[name='re_it_id[]']").each(function() {
        it_id = $(this).val();
        if(it_id == "")
            return true;

        item.push(it_id);
    });

    if(item.length > 0)
        re_item = item.join();

    $("input[name=it_list]").val(re_item);

    // 이벤트처리
    var evnt = new Array();
    var ev = ev_id = "";

    $("#reg_event_list input[name='ev_id[]']").each(function() {
        ev_id = $(this).val();
        if(ev_id == "")
            return true;

        evnt.push(ev_id);
    });

    if(evnt.length > 0)
        ev = evnt.join();

    $("input[name=ev_list]").val(ev);

    <?php echo get_editor_js('it_explan'); ?>
    <?php echo get_editor_js('it_mobile_explan'); ?>
    <?php echo get_editor_js('it_head_html'); ?>
    <?php echo get_editor_js('it_tail_html'); ?>
    <?php echo get_editor_js('it_mobile_head_html'); ?>
    <?php echo get_editor_js('it_mobile_tail_html'); ?>

    return true;
}

function categorychange(f)
{
    var idx = f.ca_id.value;

    if (f.w.value == "" && idx)
    {
        f.it_use.checked = ca_use[idx] ? true : false;
        f.it_stock_qty.value = ca_stock_qty[idx];
        f.it_sell_email.value = ca_sell_email[idx];
    }
}

categorychange(document.fitemform);
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');