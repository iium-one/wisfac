<?php
$sub_menu = "600100";
include_once('./_common.php');

$g5['title'] = '문의내역 상세보기';

include_once('./admin.head.php');

$inquery_table = G5_TABLE_PREFIX."inquiry";

$row = sql_fetch(" select * from {$inquery_table} where inq_id = '".$_GET['inq_id']."'" );
?>

<!--
<div class="tbl_frm01 tbl_wrap">
  <table>
    <caption>문의내역 상세보기</caption>
    <tbody>
      <tr>
        <?php if ($w == '') { ?>
        <th scope="row" colspan="2">
          * 작성 후 우측 상단의 '확인' 버튼을 눌러서 저장합니다.
        </th>
        <?php } else { ?>
        <th scope="row" colspan="2">
          * 수정 시 기존 데이터 복구가 불가능합니다.
        </th>
        <?php } ?>
      </tr>
    </tbody>
  </table>
</div>
-->
<div class="tbl_frm01 tbl_wrap">
  <table>
    <caption>제품관리 등록 폼</caption>
    <tbody>
      <tr>
        <th scope="row"><label for="title">문의자 성명</label></th>
        <td>
          <?php echo $row['inq_name'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">문의자 이메일</label></th>
        <td>
          <?php echo $row['inq_mail'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">문의자 지역</label></th>
        <td>
          <?php echo $row['inq_area'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">문의처(회사/학교)</label></th>
        <td>
          <?php echo $row['inq_company'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">부서</label></th>
        <td>
          <?php echo $row['inq_depart'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">전화번호</label></th>
        <td>
          <?php echo $row['inq_tel'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">주소</label></th>
        <td>
          <?php echo $row['inq_add'] ?>
        </td>
      </tr>
      <tr>
        <th scope="row"><label for="content">문의 내용</label></th>
        <td>
          <?php echo $row['inq_content'] ?>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="btn_fixed_top">
    <a href="./inquiry_list.php" class="btn btn_02">목록</a>
    <!--
    <input type="submit" value="<?php if ($w == '') { echo '확인'; } else { echo '수정'; } ?>" class="btn_submi btn btn_01" accesskey="s">-->
    
  </div>
</div>



<script>
function fboardform_submit(f)
{
  if($("#title").val() == ''){
    alert("제품명을 입력해주세요.");
    $("#title").focus();
    return false;
  }else{
    return true;
  }
}
</script>

<?php
include_once('./admin.tail.php');