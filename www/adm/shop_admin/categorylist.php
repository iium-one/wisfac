<?php
$sub_menu = '600100';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '분류관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$where = " where ";
$sql_search = "";

$sfl = in_array($sfl, array('ca_name', 'ca_id', 'ca_mb_id')) ? $sfl : '';

if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if ($save_stx && ($save_stx != $stx))
        $page = 1;
}

$sql_common = " from {$g5['g5_shop_category_table']} ";
if ($is_admin != 'super')
    $sql_search .= " $where ca_mb_id = '{$member['mb_id']}' ";
$sql_common .= $sql_search;


// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst)
{
    $sst  = "ca_id";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

// 출력할 레코드를 얻음
$sql  = " select *
             $sql_common
             $sql_order
             limit $from_record, $rows ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
?>

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

<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required class="required frm_input">
<input type="submit" value="검색" class="btn_submit">

</form>

<!--카테고리 선택 시작-->
<?php $he_size = '15'; ?>
<div class="comcose_box">
    <!-- 1차 카테고리-->
    <div class="comcose_list">
        <select class="comcose_acs" size="<?php echo $he_size ?>" name="ca_id1" onChange="comcose_acs(this)">
            <option style="color:#333;font-weight:bold;padding-bottom:10px;margin-bottom:10px;border-bottom:solid 1px #bbb;" value="" >1차 카테고리</option>
            <?php
            $sql_ca_id1="SELECT ca_id, ca_name, ca_lang FROM {$g5['g5_shop_category_table']} where length(ca_id) = '2' order by ca_id ";
            $result_ca_id1 = sql_query($sql_ca_id1);
            for($i=0; $row_ca_id1 = sql_fetch_array($result_ca_id1); $i++){
            ?>
            <option value=<?php echo $row_ca_id1['ca_id']; ?> <?php if($row_ca_id1['ca_id'] == substr($stx, 0, 2)) echo 'selected'?>>[<?php echo $row_ca_id1['ca_lang']; ?>]<?php echo $row_ca_id1['ca_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- 2차 카테고리-->
    <div class="comcose_list">
        <select class="comcose_acs" size="<?php echo $he_size ?>"  name="ca_id2" onChange="comcose_acs(this)">
            <option style="color:#333;font-weight:bold;padding-bottom:10px;margin-bottom:10px;border-bottom:solid 1px #bbb;" value="" >2차 카테고리</option>
            <?php
            $sql_ca_id2="SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} where length(ca_id) = '4' and substring(ca_id,1,2) = substring('$stx',1,2) order by ca_id ";
            $result_ca_id2 = sql_query($sql_ca_id2);
            for($i=0; $row_ca_id2 = sql_fetch_array($result_ca_id2); $i++){
            ?>
            <option value=<?php echo $row_ca_id2['ca_id']; ?> <?php if($row_ca_id2['ca_id'] == substr($stx, 0, 4)) echo 'selected'?>><?php echo $row_ca_id2['ca_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- 3차 카테고리-->
    <div class="comcose_list">
        <select class="comcose_acs" size="<?php echo $he_size ?>" name="ca_id3" onChange="comcose_acs(this)">
            <option style="color:#333;font-weight:bold;padding-bottom:10px;margin-bottom:10px;border-bottom:solid 1px #bbb;" value="" >3차 카테고리</option>
            <?php
            $sql_ca_id3="SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} where length(ca_id) = '6' and substring(ca_id,1,4) = substring('$stx',1,4) order by ca_id ";
            $result_ca_id3 = sql_query($sql_ca_id3);
            for($i=0; $row_ca_id3 = sql_fetch_array($result_ca_id3); $i++){
            ?>
            <option value=<?php echo $row_ca_id3['ca_id']; ?> <?php if($row_ca_id3['ca_id'] == substr($stx, 0, 6)) echo 'selected'?>><?php echo $row_ca_id3['ca_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <!--4차 카테고리-->
    <div class="comcose_list">
        <select class="comcose_acs" size="<?php echo $he_size ?>" name="ca_id4" onChange="comcose_acs(this)">
            <option style="color:#333;font-weight:bold;padding-bottom:10px;margin-bottom:10px;border-bottom:solid 1px #bbb;" value="" >4차 카테고리</option>
            <?php
            $sql_ca_id4="SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} where length(ca_id) = '8' and substring(ca_id,1,6) = substring('$stx',1,6) order by ca_id ";
            $result_ca_id4 = sql_query($sql_ca_id4);
            for($i=0; $row_ca_id4 = sql_fetch_array($result_ca_id4); $i++){
            ?>
            <option value=<?php echo $row_ca_id4['ca_id']; ?> <?php if($row_ca_id4['ca_id'] == substr($stx, 0, 8)) echo 'selected'?>><?php echo $row_ca_id4['ca_name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <script type="text/javascript">
    function comcose_acs(sel_ca){
    sel_ca= sel_ca.options[sel_ca.selectedIndex].value;
    location.replace("categorylist.php?&sfl=ca_id&stx="+sel_ca);
    }
    </script>
</div>
<!--카테고리 선택 끝-->

<form name="fcategorylist" method="post" action="./categorylistupdate.php" autocomplete="off">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div id="sct" class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" ><?php echo subject_sort_link("ca_id"); ?>분류코드</a></th>
        <th scope="col" id="sct_cate"><?php echo subject_sort_link("ca_name"); ?>분류명</a></th>
        <th scope="col" id="sct_lang">언어</th>
        <th scope="col" id="sct_amount">상품수</th>
        <!--
        <th scope="col" id="sct_hpcert">본인인증</th>
        <th scope="col" id="sct_imgw">이미지 폭</th>
        <th scope="col" id="sct_imgcol">1행이미지수</th>
        <th scope="col" id="sct_mobileimg">모바일<br>1행이미지수</th>
        <th scope="col" id="sct_pcskin">PC스킨지정</th>
        -->
        <th scope="col" >관리</th>
    </tr>
    <!--
    <tr>
        <th scope="col" id="sct_admin"><?php echo subject_sort_link("ca_mb_id"); ?>관리회원아이디</a></th>
        <th scope="col" id="sct_sell"><?php echo subject_sort_link("ca_use"); ?>판매가능</a></th>
        <th scope="col" id="sct_adultcert">성인인증</th>
        <th scope="col" id="sct_imgh">이미지 높이</th>
        <th scope="col" id="sct_imgrow">이미지 행수</th>
        <th scope="col" id="sct_mobilerow">모바일<br>이미지 행수</th>
        <th scope="col" id="sct_mskin">모바일스킨지정</th>
    </tr>
    -->
    </thead>
    <tbody>
    <?php
    $s_add = $s_vie = $s_upd = $s_del = '';
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

        if ($level+2 < 6) $s_add = '<a href="./categoryform.php?ca_id='.$row['ca_id'].'&amp;'.$qstr.'" class="btn btn_03">추가</a> '; // 분류는 5단계까지만 가능
        else $s_add = '';
        $s_upd = '<a href="./categoryform.php?w=u&amp;ca_id='.$row['ca_id'].'&amp;'.$qstr.'" class="btn btn_02"><span class="sound_only">'.get_text($row['ca_name']).' </span>수정</a> ';

        if ($is_admin == 'super')
            $s_del = '<a href="./categoryformupdate.php?w=d&amp;ca_id='.$row['ca_id'].'&amp;'.$qstr.'" onclick="return delete_confirm(this);" class="btn btn_02"><span class="sound_only">'.get_text($row['ca_name']).' </span>삭제</a> ';

        // 해당 분류에 속한 상품의 수
        $sql1 = " select COUNT(*) as cnt from {$g5['g5_shop_item_table']}
                      where ca_id = '{$row['ca_id']}'
                      or ca_id2 = '{$row['ca_id']}'
                      or ca_id3 = '{$row['ca_id']}' ";
        $row1 = sql_fetch($sql1);

        // 스킨 Path
        if(!$row['ca_skin_dir'])
            $g5_shop_skin_path = G5_SHOP_SKIN_PATH;
        else {
            if(preg_match('#^theme/(.+)$#', $row['ca_skin_dir'], $match))
                $g5_shop_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
            else
                $g5_shop_skin_path  = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$row['ca_skin_dir'];
        }

        if(!$row['ca_mobile_skin_dir'])
            $g5_mshop_skin_path = G5_MSHOP_SKIN_PATH;
        else {
            if(preg_match('#^theme/(.+)$#', $row['ca_mobile_skin_dir'], $match))
                $g5_mshop_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
            else
                $g5_mshop_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$row['ca_mobile_skin_dir'];
        }

        $bg = 'bg'.($i%2);
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_code">
            <input type="hidden" name="ca_id[<?php echo $i; ?>]" value="<?php echo $row['ca_id']; ?>">
            <a href="/sub/prod_list/<?php echo $row['ca_id']; ?>" target="_blank"><?php echo $row['ca_id']; ?></a>
        </td>
        <td headers="sct_cate" class="sct_name<?php echo $level; ?>"><?php echo get_text($row['ca_name']); ?></td>
        <td headers="sct_lang"><?php echo get_text($row['ca_lang']); ?></td>
        <td headers="sct_amount" class="td_amount"><a href="./itemlist.php?sca=<?php echo $row['ca_id']; ?>"><?php echo $row1['cnt']; ?></a></td>
        <td class="td_mng td_mng_s">
            <?php echo $s_vie; ?>
            <?php echo $s_upd; ?>
            <?php //echo $s_del; ?>
        </td>
    </tr>
    <?php }
    if ($i == 0) echo "<tr><td colspan=\"9\" class=\"empty_table\">자료가 한 건도 없습니다.</td></tr>\n";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <button type="button" class="btn" onclick="location.href='./category_img_list.php';" style="background:#4a4a51;color:#fff;">분류 이미지 관리</button>

    <?php //if ($is_admin == 'super') {?>
    <!-- <a href="./categoryform.php" id="cate_add" class="btn btn_01">분류 추가</a> -->
    <?php //} ?>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function() {
    $("select.skin_dir").on("change", function() {
        var type = "";
        var dir = $(this).val();
        if(!dir)
            return false;

        var id = $(this).attr("id");
        var $sel = $(this).siblings("select");
        var sval = $sel.find("option:selected").val();

        if(id.search("mobile") > -1)
            type = "mobile";

        $sel.load(
            "./ajax.skinfile.php",
            { dir : dir, type : type, sval: sval }
        );
    });
});
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');