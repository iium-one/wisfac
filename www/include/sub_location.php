<?php
include_once('./_common.php');

function sub_location($sub_id, $sub_active){
  switch ($sub_id){
    case "sub1":
      /*
      $sub_idca2_tab 변수 형식: 
      서브 파일 경로|서브명
      (제일 마지막은 끝에 쉼표 생략)
      */
      $sub_idca2_tab .= "#|Sub-Menu-1,";
      $sub_idca2_tab .= "#|Sub-Menu-2";
      break;
  }
  
  $sub_idca2_tab001 = explode(",",$sub_idca2_tab);
?>

<div class="sub_location">
  <div class="wrapper">
    <ul class="i-col-<?php echo count($sub_idca2_tab001); ?> sub_location_ul">
      <?php
      for($i=0; $i < count($sub_idca2_tab001); $i++){
        $sub_idca2_tab002 = explode("|",$sub_idca2_tab001[$i]);
      ?>
      <li class="<?php echo $sub_active==$i?'active':'';?>">
        <a href="<?php echo $sub_idca2_tab002[0];?>">
          <p><?php echo $sub_idca2_tab002[1];?></p>
        </a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<? } ?>

