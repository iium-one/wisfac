<?php 
include_once(G5_PATH.'/jpn/include/sub_top.php');

$prod_ca_idx = $params[0];
$prod_cate_table = G5_TABLE_PREFIX.'shop_category';
$prod_item_table = G5_TABLE_PREFIX.'shop_item';
$prod_cate = sql_fetch(" 
  select 
    ca_name, 
    ca_2_subj, 
    ca_3_subj, 
    ca_4_subj, 
    ca_5_subj, 
    ca_6_subj, 
    ca_7_subj 
  from {$cate_table} 
  where ca_id = '{$prod_ca_idx}' 
");
?>

<div id="product" class="contents">
  <?php sub_top($sb_menus, 'product', $prod_ca_idx); ?>

  <div id="sb-contents">
    <section class="cate-def">
      <h2 class="sound_only">제품 분류 상단 설명</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <p class="cate-def-name">
              <?php echo $prod_cate['ca_name'];?>
            </p>
            <div class="cate-def-expl1">
              <?php echo nl2br($prod_cate['ca_3_subj']);?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php if($prod_cate['ca_4_subj'] || $prod_cate['ca_5_subj']) { ?>
    <section class="cate-func">
      <h2 class="sound_only">제품 분류 상단 설명</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <?php if($prod_cate['ca_4_subj']) { ?>
            <div class="cate-def-expl2">
              <?php echo nl2br($prod_cate['ca_4_subj']);?>
            </div>
            <?php } ?>
            <?php
            if($prod_cate['ca_5_subj']) {

              $ca_5_subj_arr = explode("||", $prod_cate['ca_5_subj']);
              $ca_6_subj_arr = explode("||", $prod_cate['ca_6_subj']);
            ?>
            <div class="match-height dgtxt-wrap cate-func-wrap cd<?php echo count($ca_5_subj_arr);?>">
              <?php
              for($i = 0; $i < count($ca_5_subj_arr); $i++){
              ?>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1"><?php echo $ca_5_subj_arr[$i]; ?></p>
                  <p class="dgtxt-text2"><?php echo $ca_6_subj_arr[$i]; ?></p>
                </div>
              </div>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php
    $prod_item_leng = sql_fetch(" select count(*) as cnt from {$prod_item_table} where ca_id = '{$prod_ca_idx}' and it_use=1 ");
    ?>
    <section class="cate-prod <?php echo $prod_item_leng['cnt'] == 0 ? 'prod_none':'';?>">
      <h2 class="sound_only">제품 목록</h2>
      <div class="container">
        <div class="wrapper">
          <?php if($prod_item_leng['cnt'] != 0) { ?>
          <div class="sec_ct">
            <?php
            if($prod_item_leng['cnt'] <= 2) {
              $prod_item_col = $prod_item_leng['cnt'];
            } else {
              $prod_item_col = 3;
            }
            ?>
            <div class="cate-prod-wrap cd<?php echo $prod_item_col;?>">
            <?php
            $prod_item_sql = " select 
                                it_id, 
                                it_name, 
                                it_img1 
                              from {$prod_item_table} 
                              where ca_id = '{$prod_ca_idx}' and it_use=1 
                              order by it_order asc, it_time asc
                              ";
            $prod_item_result = sql_query($prod_item_sql);
            for($i=0; $prod_item=sql_fetch_array($prod_item_result); $i++){
              $it_img = '<img src="'.G5_DATA_URL.'/item/'.$prod_item['it_img1'].'" >';
            ?>
            <div class="cate-prod-list">
              <div class="cate-prod-list-in">
                <div class="cate-prod-img">
                  <?php echo $it_img; ?>
                </div>
                <p class="cate-prod-name">
                  <?php echo $prod_item['it_name']; ?>
                </p>
                <a href="/jpn/sub/prod_view/<?php echo $prod_item['it_id']; ?>" class="i-arrow-btn01 cate-prod-more">Learn more<span class="icon"></span></a>
              </div>
            </div>
            <?php } ?>
          </div>
          <?php } else { ?>
          <div class="empty_prod">제품 데이터가 없습니다.</div>
          <?php } ?>
        </div>
      </div>
    </section>

    <section class="dg-slogan cate-slogan">
      <h2 class="sound_only">추구하는 인재상</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct dg-slogan_ct">
            <div class="double-dot-open"><img src="/source/img/double-dot-open.png" alt=""></div>
            <p class="dg-slogan-text">
            <?php echo nl2br($prod_cate['ca_7_subj']);?>
            </p>
            <div class="double-dot-close"><img src="/source/img/double-dot-close.png" alt=""></div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>