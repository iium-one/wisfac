<?php
$sub_menu = "600100";
include_once('./_common.php');

$g5['title'] = '제품관리';
include_once('./admin.head.php');

$colspan = 2;

$sfl = $_REQUEST['sfl'];
$stx = $_REQUEST['stx'];

$sql_common = " from iu_product ";
$sql_search = " where (1) ";

if ($stx) {
  $sql_search .= " and ( ";
  $sql_search .= " ($sfl like '%$stx%') ";
  $sql_search .= " ) ";
}

$sst = "w_date";
$sod = "desc";
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_where} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);
if ($page < 1) { $page = 1; }
$from_record = ($page - 1) * $rows;

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
?>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
  <label for="sfl" class="sound_only">검색대상</label>
  <select name="sfl" id="sfl">
      <option value="title"<?php echo get_selected($sfl, "title"); ?>>제품명</option>
  </select>
  <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
  <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
  <input type="submit" value="검색" class="btn_submit">
  <a href="./product_list.php" class="ov_listall">전체보기</a>
  <span class="btn_ov01"><span class="ov_txt">목록</span><span class="ov_num"> <?php echo $total_count;?>건</span></span>
</form>
<div class="tbl_head01 tbl_wrap">
  <table>
    <caption>제품관리 목록</caption>
    <thead>
      <tr>
        <th scope="col">제품명</th>
        <th scope="col">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for($i=0; $row=sql_fetch_array($result); $i++){
        $bg = 'bg'.($i%2);
      ?>
      <tr class="<?php echo $bg; ?>">
        <td><?php echo $row['title'];?></td>
        <td class="td_mng td_mng_m">
          <a href="./product_form.php?w=u&amp;idx=<?php echo $row['idx'];?>" class="btn btn_03">수정</a>
          <form name="product_delete" id="product_delete" action="./product_form_update.php" onsubmit="return fboardform_submit(this)" method="post" style="display: inline-block;">
            <input type="hidden" name="w" value="d">
            <input type="hidden" name="idx" value="<?php echo $row['idx'];?>">
            <button type="submit" class="btn_01 btn">삭제</button>
          </form>
        </td>
      </tr>
      <?php
      }
      if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
      ?>
    </tbody>
  </table>
  
  <div class="btn_fixed_top">
    <!-- <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn_02 btn"> -->
    <a href="./product_form.php" id="bo_add" class="btn_01 btn">제품 추가</a>
  </div>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>



<script>
function fboardform_submit(f)
{
  var result = confirm('삭제된 데이터는 복구할 수 없습니다.\n그래도 삭제하시겠습니까?');
  if(result) {
    return true;
  } else {
    return false;
  }
}
</script>

<?php
include_once('./admin.tail.php');