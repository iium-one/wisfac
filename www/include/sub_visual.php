<?php
include_once('./_common.php');

function sub_visual($sub_id){
  $visual_class = $sub_id."_vs";

  switch ($sub_id){
    case 'layouts':
      $sub_vs_txt1 = "Text";
      $sub_vs_txt2 = "Text";
    break;
    case 'product':
      $sub_vs_txt1 = "Product";
      $sub_vs_txt2 = "Introducing our products.";
    break;
  }
?>
<div class="sub_visual <?php echo $visual_class;?>">
  <div class="sub_vs_txt_box">
		<div class="sub_vs_txt1"><?php echo $sub_vs_txt1; ?></div>
		<div class="sub_vs_txt2"><?php echo $sub_vs_txt2; ?></div>
	</div>
</div>
<? } ?>