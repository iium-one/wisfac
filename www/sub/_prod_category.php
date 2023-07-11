<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');
?>

<div id="product" class="contents">
  <?php sub_top($sb_menus, 'product', 'aboutus'); ?>

  <div id="sb-contents">
    <section class="prod-cate">
      <h2 class="sound_only">제품 분류</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <?php
            $prod_cate_table = G5_TABLE_PREFIX.'shop_category';
            $prod_cate_sql = " select ca_id, ca_name from {$cate_table} ";
            $prod_cate_result = sql_query($prd_cate_sql);
            for($i=0; $prod_cate=sql_fetch_array($prod_cate_result); $i++){
            ?>
              <?php echo $prod_cate['ca_name'];?>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>