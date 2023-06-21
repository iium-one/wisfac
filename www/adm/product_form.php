<?php
$sub_menu = "600100";
include_once('./_common.php');

if ($w == '') {
  $g5['title'] = '제품관리 등록';
} else if ($w == 'u') {
  $g5['title'] = '제품관리 수정';
}
include_once('./admin.head.php');

$pt = sql_fetch(" select * from iu_product where idx = '".$_GET['idx']."'" );
$idx = $pt['idx'];
$pt_title = $pt['title'];
$pt_content = $pt['content'];
$pt_spec = $pt['spec'];
$pt_link = $pt['link'];
?>

<div class="tbl_frm01 tbl_wrap">
  <table>
    <caption>제품관리 저장 방법</caption>
    <tbody>
      <tr>
        <?php if ($w == '') { ?>
        <th scope="row" colspan="2">
          * 작성 후 우측 상단의 '확인' 버튼을 눌러서 저장합니다.
        </th>
        <?php } else { ?>
        <th scope="row" colspan="2">
          * 수정 후 우측 상단의 '수정' 버튼을 눌러서 저장합니다.
        </th>
        <?php } ?>
      </tr>
    </tbody>
  </table>
</div>

<form name="fboardform" id="fboardform" action="./product_form_update.php" onsubmit="return fboardform_submit(this)" method="post" enctype="multipart/form-data">
  <input type="hidden" name="w" value="<?php echo $w ?>">
  <input type="hidden" name="idx" value="<?php echo $idx ?>">
  <div class="tbl_frm01 tbl_wrap">
    <table>
      <caption>제품관리 등록 폼</caption>
      <tbody>
        <tr>
          <th scope="row"><label for="title">제품명</label></th>
          <td>
            <input type="text" name="title" value="<?php echo $pt_title ?>" id="title" class="frm_input" size="80">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="content">제품설명</label></th>
          <td>
            <textarea name="content" id="content" ><?php echo $pt_content ?></textarea>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="spec0">제품사양</label></th>
          <td>
            
            <ul class="add_func_wrap">
              <?php
              if($w = ''){
              ?>
              <li class="add_func_li">
                <input type="text" name="spec[]" value="<?php echo $pt_spec ?>" id="spec0" class="frm_input" size="80">
                <button type="button" class="plus_btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <button type="button" class="minus_btn"><i class="fa fa-minus" aria-hidden="true"></i></button>
              </li>
              <?php
              }else{
                $pt_spec_array = explode("||", $pt_spec);
                for($i = 0; $i < count($pt_spec_array); $i++){
              ?>
              <li class="add_func_li">
                <input type="text" name="spec[]" value="<?php echo $pt_spec_array[$i] ?>" id="spec<?php echo $i;?>" class="frm_input" size="80">
                <button type="button" class="plus_btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <button type="button" class="minus_btn"><i class="fa fa-minus" aria-hidden="true"></i></button>
              </li>
              <?php
                }
              }
              ?>
            </ul>
            

            <script>
            $(document).ready(function(){
              //입력필드 추가, 삭제
              var $addWrap = $(".add_func_wrap"), //입력필드 전체 박스
                  $addList = '', //반복 생성되는 선택자
                  addList_id = 'spec', //id에 공통적으로 사용된 이름(생성,삭제시 뒤에 index처리)
                  addLay = '', //HTML 복사 저장
                  $addLay_last = '', //복사 생성된 리스트
                  addLay_index, //리스트 index
                  addMax_length = 5; //최대 생성 개수
                  addCurrent_length = 1; //현재 생성된 개수

              //추가
              $addWrap.on("click", ".plus_btn", function(){
                $addList = $(this).closest('.add_func_li');
                addLay = $addList.clone();
                addCurrent_length = $('.add_func_li').length;

                if(addCurrent_length >= addMax_length){
                  alert("최대 "+addMax_length+"개 까지 추가할 수 있습니다.");
                }else{
                  $(this).parents(".add_func_wrap").append(addLay);
                  $addLay_last = $addWrap.find(".add_func_li").last(); //복사 생성된 리스트
                  $addLay_last.find("input[type='text']").val(''); //복사 생성된 input 입력값 초기화

                  $addWrap.find(".add_func_li").each(function(index){ //id 재조정
                    addLay_index = index;

                    $(this).find("input[type='text']").attr("id",addList_id+addLay_index);
                  });
                }
              });

              //삭제
              $addWrap.on("click", ".minus_btn", function(){
                $addList = $(this).closest('.add_func_li');
                $addList.remove();
              });
            });
            </script>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="link">관련링크</label></th>
          <td>
            <input type="text" name="link" value="<?php echo $pt_link ?>" id="link" class="frm_input" size="80">
          </td>
        </tr>
        <?php for($i=1; $i<=5; $i++) { ?>
        <tr>
          <th scope="row"><label for="file<?php echo $i;?>">제품 파일<?php echo $i;?></label></th>
          <td>
            <input type="file" name="file<?php echo $i;?>" id="file<?php echo $i;?>" class="frm_input">
            <?php 
            $file = sql_fetch(" select * from iu_product_file where in_idx = '{$pt['idx']}' and in_no = '{$i}' ");
            if($file['idx']) { 
            ?>
            <div class="files_box">
              <ul class="files_box_ul">
                <li class="files_chkbox">
                  <input type="checkbox" name="file<?php echo $i;?>_del" id="file<?php echo $i;?>_del" value="1">
                  <label for="file<?php echo $i;?>_del"><span class="sound_only">파일 <?php echo $i;?> </span>파일삭제</label>
                </li>
                <li class="files_preview">
                  <?php if (preg_match('/\.(gif|jpe?g|png)$/i', $file['origin_name'])){ ?>
                    <img src="<?php echo G5_DATA_URL.'/product/'.$file['file_name'];?>" width="25" height="25" alt="">
                    <?php echo $file['origin_name']; ?>
                  <?php }else{ ?>
                    <?php echo $file['origin_name']; ?>
                  <?php } ?>
                </li>
              </ul>
            </div>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="btn_fixed_top">
      <a href="./product_list.php" class="btn btn_02">목록</a>
      <input type="submit" value="<?php if ($w == '') { echo '확인'; } else { echo '수정'; } ?>" class="btn_submi btn btn_01" accesskey="s">
      
    </div>
  </div>
</form>



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