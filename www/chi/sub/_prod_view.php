<?php 
include_once('/home/wespec/www/chi/include/sub_top.php');

$prod_it_idx = $params[0];
$prod_cate_table = G5_TABLE_PREFIX.'shop_category';
$prod_item_table = G5_TABLE_PREFIX.'shop_item';
$prod_item = sql_fetch(" 
  select 
    a.ca_id, 
    a.it_name, 
    a.it_basic, 
    a.it_1_subj, 
    a.it_2_subj, 
    a.it_3_subj, 
    a.it_4_subj, 
    a.it_img1, 
    a.it_img2, 
    a.it_img3, 
    a.it_img4, 
    a.it_img5, 
    a.it_img6, 
    a.it_img7, 
    a.it_img8, 
    a.it_img9, 
    a.it_1, 
    a.it_2, 
    a.it_3, 
    a.it_4, 
    a.it_5, 
    a.it_6, 
    a.it_7, 
    a.it_8, 
    a.it_9, 
    b.ca_id, 
    b.ca_name, 
    b.ca_1_subj 
  from {$prod_item_table} a left join {$prod_cate_table} b on (a.ca_id=b.ca_id) 
  where it_id = '{$prod_it_idx}' 
");

$sql = " select b.ca_id, b.it_id, b.it_name, b.it_price from {$g5['g5_shop_item_relation_table']} a left join {$g5['g5_shop_item_table']} b on (a.it_id2=b.it_id) where a.it_id = '$it_id' order by ir_no asc ";

// 제품 롤링 이미지
$it_roll_img_cnt = 0;
for($i=1; $i<=5; $i++) {
  $it_roll_img_num = $i + 1;

  if(!$prod_item['it_img'.$it_roll_img_num])
    continue;

  ${'it_roll_img'.$i} = '<img src="'.G5_DATA_URL.'/item/'.$prod_item['it_img'.$it_roll_img_num].'" >';
  $it_roll_img_cnt++;
}

// 제품 상세 이미지
$it_detail_img_cnt = 0;
for($i=1; $i<=4; $i++) {
  $it_detail_img_num = $i + 6;

  if(!$prod_item['it_img'.$it_detail_img_num])
    continue;

  ${'it_detail_img'.$i} = '<img src="'.G5_DATA_URL.'/item/'.$prod_item['it_img'.$it_detail_img_num].'" >';
  $it_detail_img_cnt++;
}
?>

<div id="product" class="contents view">
  <?php sub_top($sb_menus, 'product', $prod_item['ca_id']); ?>

  <div id="sb-contents">
    <div class="container">
      <div class="wrapper">
        <a href="/chi/sub/prod_list/<?php echo $prod_item['ca_id'];?>" class="prod_detail_back"><img src="/source/img/arrow-left-gray.png" alt=""><?php echo $prod_item['ca_1_subj'];?> 整体视图</a>
      </div>
    </div>
    <section class="prod-def">
      <h2 class="sound_only">제품 상세</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <p class="prod-name"><?php echo $prod_item['it_name'];?></p>
            <br/>
            <div class="prod-expl1">
              <?php echo nl2br($prod_item['it_basic']);?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php if($it_roll_img_cnt > 0 || $it_1_subj_arr) { ?>
    <section class="prod-spec">
      <h2 class="sound_only">제품 이미지 및 사양</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <?php if($it_roll_img_cnt > 0) { ?>
            <div class="prod-img_roll <?php echo $it_roll_img_cnt > 1? 'pb':''; ?>">
              <div class="match-height swiper-wrapper prod-img_roll_wrap">
                <?php 
                for($i=1; $i<=5; $i++) {
                  if(!${'it_roll_img'.$i})
                    continue;
                ?>
                <div class="swiper-slide prod-img_roll-slide">
                  <div class="prod-img_roll_imgwrap">
                    <?php echo ${'it_roll_img'.$i}; ?>
                  </div>
                  <?php if($prod_item['it_'.$i]) { ?>
                  <p class="prod-img_roll-text"><?php echo $prod_item['it_'.$i]; ?></p>
                  <?php } ?>
                </div>
                <?php
                }
                ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
            <?php } ?>
            <?php if($prod_item['it_1_subj']) { ?>
            <div class="prod-spec_wrap">
              <table class="prod-spec-tb">
                <tbody>
                  <?php
                  //제품 사양(표)
                  $it_1_subj_arr = explode("||", $prod_item['it_1_subj']); //th
                  $it_2_subj_arr = explode("||", $prod_item['it_2_subj']); //td

                  for($i = 0; $i < count($it_1_subj_arr); $i++){
                  ?>
                  <tr>
                    <?php
                    $it_2_subj_2arr = explode("|", $it_2_subj_arr[$i]);
                    ?>
                    <th <?php echo count($it_2_subj_2arr) > 1 ? 'rowspan="'.count($it_2_subj_2arr).'"':'';?>><?php echo $it_1_subj_arr[$i];?></th>
                    <td><?php echo $it_2_subj_2arr[0];?></td>
                  </tr>
                  <?php for($k = 1; $k < count($it_2_subj_2arr); $k++){ ?>
                  <tr>
                    <td><?php echo $it_2_subj_2arr[$k];?></td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php if($it_detail_img_cnt > 0 || ($prod_item['it_3_subj'] && $prod_item['it_4_subj'])) { ?>
    <section class="prod-detail">
      <h2 class="sound_only">제품 상세 이미지 및 추가설명</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <?php if($it_detail_img_cnt > 0) { ?>
            <p class="prod-detail-tit">Detail view</p>
            <div class="prod-detail_wrap">
              <?php 
              $detail_num = 0;
              for($i=1; $i<=5; $i++) {
                $detail_num = $i + 5;

                if(!${'it_detail_img'.$i})
                  continue;
              ?>
              <div class="prod-detail-img">
                <div class="prod-detail-img-in <?php echo $prod_item['it_'.$detail_num] ? 'bdr0':'';?>">
                  <?php echo ${'it_detail_img'.$i}; ?>
                </div>
                <?php if($prod_item['it_'.$detail_num]) { ?>
                <p class="prod-detail-img-text"><?php echo $prod_item['it_'.$detail_num]; ?></p>
                <?php } ?>
              </div>
              <?php
              }
              ?>
            </div>
            <?php } ?>

            <?php if($prod_item['it_3_subj'] && $prod_item['it_4_subj']) { ?>
            <div class="prod-detail-add_info">
              <p class="prod-detail-add_info-tit"><?php echo $prod_item['it_3_subj'];?></p>
              <div class="prod-detail-add_info_box">
                <?php
                $it_4_subj_arr = explode("||", $prod_item['it_4_subj']);

                for($i = 0; $i < count($it_4_subj_arr); $i++){
                ?>
                <p class="prod-detail-add_info-txt"><?php echo $it_4_subj_arr[$i];?></p>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
  </div>
</div>