<?php
$sub_menu = "600100";
include_once('./_common.php');

$g5['title'] = '문의내역';
include_once('./admin.head.php');

$colspan = 5;

$inquery_table = G5_TABLE_PREFIX."inquiry";

$sfl = $_REQUEST['sfl'];
$stx = $_REQUEST['stx'];

$sql_common = " from {$inquery_table} ";
$sql_search = " where (1) ";

if ($stx) {
  $sql_search .= " and ( ";
  $sql_search .= " ($sfl like '%$stx%') ";
  $sql_search .= " ) ";
}

$sst = "inq_date";
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
      <option value="inq_name"<?php echo get_selected($sfl, "inq_name"); ?>>이름</option>
  </select>
  <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
  <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
  <input type="submit" value="검색" class="btn_submit">
  <a href="./inquiry_list.php" class="ov_listall">전체보기</a>
  <span class="btn_ov01"><span class="ov_txt">목록</span><span class="ov_num"> <?php echo $total_count;?>건</span></span>
</form>
<div class="tbl_head01 tbl_wrap">
  <table>
    <caption>제품관리 목록</caption>
    <thead>
      <tr>
        <th scope="col">문의명</th>
        <th scope="col">문의처</th>
        <th scope="col">문의자 연락처</th>
        <th scope="col">문의날짜</th>
        <th scope="col">관리</th>
        <th scope="col">상세</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for($i=0; $row=sql_fetch_array($result); $i++){
        $bg = 'bg'.($i%2);
      ?>
      <tr class="<?php echo $bg; ?> <?php echo $row['inq_check'] == '1' ? 'done':''; ?>">
        <td>
          <p class="title">
            <span><?php echo $row['inq_name'].'님의 문의';?></span>
            <?php echo $row['inq_check'] == '0'?'<span class="new-icon">N</span>':''; ?>
          </p>
        </td>
        <td><?php echo $row['inq_company']; ?></td>
        <td><?php echo $row['inq_tel']; ?></td>
        <td><?php echo $row['inq_date']; ?></td>
        <td class="inq_check"><?php echo $row['inq_check'] == '0'?'-':'읽음'; ?></td>
        <td class="td_mng td_mng_m">
          <a href="./inquiry_form.php?inq_id=<?php echo $row['inq_id'];?>" class="btn btn_03" onclick="inq_check(<?php echo $row['inq_id'];?>)">보기</a>
          <!--
          <form name="product_delete" id="product_delete" action="./product_form_update.php" onsubmit="return fboardform_submit(this)" method="post" style="display: inline-block;">
            <input type="hidden" name="inq_id" value="<?php echo $row['inq_id'];?>">
            <button type="submit" class="btn_01 btn">삭제</button>
          </form>
          -->
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
    <!--<a href="./product_form.php" id="bo_add" class="btn_01 btn">제품 추가</a>-->
  </div>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<style>
  .tbl_head01 tbody tr:nth-child(even) {background-color: #fff!important;}
  .tbl_head01 tbody tr.done {background-color: #efefef!important;}
  .tbl_head01 tbody tr .title {display: inline-block; position: relative;}
  .tbl_head01 tbody tr .title > * {display: inline-block; vertical-align: middle;}
  .tbl_head01 tbody tr .new-icon {font-weight: 900; color: #fff; font-size: 10px; background-color: #3f51b5; width: 16px; height: 16px; border-radius: 4px; display: inline-block; vertical-align: middle; line-height: 14px; animation: opac 1s linear infinite;}

  @keyframes opac {
    0% {
      opacity: 1;
    }
    50% {
      opacity: 0.3;
    }
    100% {
      opacity: 1;
    }
  }
</style>

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

// function inq_check(selectElement, inqId){
//   var selectedValue = $(selectElement).val();
  
//   $.ajax({
//     url: './inquiry_check.php',
//     method: 'POST',
//     data: { inqId: inqId, value: selectedValue },
//     success: function(response) {
//       if(selectedValue == '2'){
//         alert('확인처리 되었습니다.');
//       }else{
//         alert('미확인 상태로 변경됩니다.');
//       }
//       window.location.reload();
//     }
//   });
// }

function inq_check(inqId){
  $.ajax({
    url: './inquiry_check.php',
    method: 'POST',
    data: { inqId: inqId },
    success: function(response) {
      //window.location.reload();
    }
  });
}
</script>

<?php
include_once('./admin.tail.php');