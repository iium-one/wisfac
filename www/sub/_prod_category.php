<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');
?>

<div id="product" class="contents">
  <?php sub_top($sb_menus, 'product', ''); ?>

  <div id="sb-contents">
    <section class="prod-cate">
      <h2 class="sound_only">제품 분류</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <div class="match-height prod-cate_wrap">
              <?php
              $prod_cate_table = G5_TABLE_PREFIX.'shop_category';
              $prod_cate_sql = " select 
                                  ca_id,
                                  ca_name,
                                  ca_2_subj,
                                  ca_img1,
                                  ca_img2,
                                  ca_img3
                                from {$cate_table} 
                                ";
              $prod_cate_result = sql_query($prod_cate_sql);
              for($i=0; $prod_cate=sql_fetch_array($prod_cate_result); $i++){
              ?>
              <a href="/sub/prod_list/<?php echo $prod_cate['ca_id'];?>" class="prod-cate-item">
                <span class="more"></span>
                <p class="ctg_name"><?php echo $prod_cate['ca_name'];?></p>
                <p class="ctg_expl"><?php echo $prod_cate['ca_2_subj'];?></p>
                <div class="ctg_img">
                  <img src="<?php echo G5_DATA_URL."/category/".$prod_cate['ca_img1'];?>" alt="">
                </div>
                <div class="ctg_bg">
                  <img src="<?php echo G5_DATA_URL."/category/".$prod_cate['ca_img2'];?>" alt="" class="ctg_bg_def">
                  <img src="<?php echo G5_DATA_URL."/category/".$prod_cate['ca_img3'];?>" alt="" class="ctg_bg_over">
                </div>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>