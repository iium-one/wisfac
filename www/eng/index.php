<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/common.php';
if (!defined('_INDEX_')) define('_INDEX_', true); //index 상수 설정

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
 include_once(G5_THEME_PATH.'/head_eng.php'); //header 파일 연결
?>

<!-- Contents { -->
<div id="main" class="contents">
  <section class="main-visual">
    <h2 class="sound_only">메인 비주얼 영역</h2>
    <div class="main-visual-container">
      <div class="main-visual-wrapper">
        <div class="swiper-wrapper main-visual-slider">
          <div class="swiper-slide main-visual-item item1">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">Companies Developing Advanced Technologies for the Future World</p>
                  <p class="main-visual-btxt"><span class="highlight">Create advanced technology</span> <br/>for the future world</p>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide main-visual-item item2">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">Innovative products and technologies with accuracy and precision</p>
                  <p class="main-visual-btxt">Innovation in <span class="highlight">Silicon Wafer</span> <br/><span class="highlight">Inspection System</span></p>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide main-visual-item item3">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">Global Wafer Inspection Equipment Company</p>
                  <p class="main-visual-btxt"><span class="highlight">Wisdom Factory</span> <br/>of new technology</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="main-visual-control">
          <div class="container">
            <div class="wrapper">
              <div class="main-visual-control_inner">
                <div class="swiper-pagination"></div>
                <div class="main-visual-time">
                  <div class="bar">
                    <span></span>
                  </div>
                </div>
                <button type="button" class="main-visual-stop">
                  <img src="/source/img/stop.png" alt="">
                </button>
                <button type="button" class="main-visual-play">
                  <img src="/source/img/play.png" alt="">
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="main-product" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
      <div class="wrapper">
        <div class="main-product_ct">
          <div class="main_sec-top">
            <h2 class="main_sec-title1">WISFAC <span class="highlight">Product</span></h2>
            <p class="main_sec-expl1">
              wisfac's Wafer inspection equipment that the world is paying attention to is well-equipped with automated systems. <br/>
              The integration of inspection / detection technologies is highly praised by customers around the world for their ease of operation and customer needs. <br/>
              Please check out wisfac's inspection equipment now and ask. We are ready to meet you at any time.
            </p>
          </div>
          <div class="match-height prod-cate_wrap">
            <?php
            $prod_cate_table = G5_TABLE_PREFIX.'shop_category';
            $prod_cate_where = 'ca_lang = "ENG"';
            $prod_cate_sql = " select 
                                ca_id,
                                ca_name,
                                ca_2_subj,
                                ca_img1,
                                ca_img2,
                                ca_img3
                                from {$cate_table}
                                where {$prod_cate_where}
                              ";
            $prod_cate_result = sql_query($prod_cate_sql);
            for($i=0; $prod_cate=sql_fetch_array($prod_cate_result); $i++){
            ?>
            <a href="/eng/sub/prod_list/<?php echo $prod_cate['ca_id'];?>" class="prod-cate-item">
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

  <section class="main-contact">
    <div class="main-contact_box main-contact_lt" data-aos="fade-right" data-aos-duration="1000">
      <div class="main-contact_ct">
        <div class="main-contact_ct_inner">
          <p class="main-contact-title">Introducing Wisfac</p>
          <p class="main-contact-expl">World recognized technologies and products. Are you curious about <b>wisfac?</b></p>
          <a href="/eng/sub/aboutus?v=vision" class="i-arrow-btn01">
            Company
            <span class="icon">
              <img src="/source/img/arrow-right-white.png" alt="회사소개 링크이동">
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="main-contact_box main-contact_rt" data-aos="fade-left" data-aos-duration="1000">
      <div class="main-contact_ct">
        <div class="main-contact_ct_inner">
          <p class="main-contact-title">Customer Inquiry</p>
          <p class="main-contact-expl"><b>Do you have any questions</b> <br/>about the product?</p>
          <a href="/eng/sub/contact" class="i-arrow-btn01">
            Inquiry
            <span class="icon">
              <img src="/source/img/arrow-right-white.png" alt="고객문의 링크이동">
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="main-board" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
      <div class="wrapper">
        <div class="main-board_ct">
          <div class="main_sec-top">
            <h2 class="main_sec-subtitle1">Customer Support</h2>
            <h2 class="main_sec-title1">Check out <b>various news</b></h2>
            <div class="tabs main-boarad-tabs">
              <button type="button" class="tabs-btn on" data-board="notice_eng">Notice</button>
              <button type="button" class="tabs-btn" data-board="news_eng">News</button>
            </div>
            <a href="/notice_eng" class="i-arrow-btn01">
              Learn more
              <span class="icon"></span>
            </a>
          </div>
          <div class="main-board_wrap">

            <div class="main-board_box main-board_lt">
              <div class="main-board-wrapper">
                <div class="swiper-wrapper main-board-slider">
                  <!-- fetch -->
                </div>
              </div>
            </div>
            <div class="main-board_box main-board_rt">

            </div>

            <button class="swiper-button-prev">
              <img src="/source/img/arrow-left-gray.png" alt="">
            </button>
            <button class="swiper-button-next">
              <img src="/source/img/arrow-right-gray.png" alt="">
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="main-banner" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
      <div class="wrapper">
        <div class="main-banner_ct">
          <div class="main_sec-top">
            <h2 class="sound_only">회사소개, 사업소개 배너</h2>
          </div>
          <a href="/eng/sub/global" class="main-banner_box main-banner-company">
            <div class="main-banner_ct_inner">
              <p class="banner-title">Global WISFAC</p>
              <p class="banner-subtitle">Meet wisfac, a <b>global company</b></p>
              <p class="banner-expl">Based on pure domestic technology in the field of wafer inspection for semiconductors through many years of technology development, It is a global specialized company thet develops and produces high-tech equipment</p>
            </div>
            <div class="main-banner-prod">
              <img src="/source/img/main-company-banner-prod.png" alt="">
            </div>
          </a>
          <a href="/eng/sub/business" class="main-banner_box main-banner-business">
            <div class="main-banner_ct_inner">
              <p class="banner-title">Business introduction</p>
              <p class="banner-subtitle">Check out wisfac's <br/><b>Developed product</b></p>
              <p class="banner-expl">It is developed and produced with pure domestic technology for various Wafer tests such as SI Wafer and SIC Wafer. We have a wide range of hardware products and a wide range of related software products.</p>
            </div>
            <div class="main-banner-prod">
              <img src="/source/img/main-business-banner-prod.png" alt="">
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- } Contents -->

<script>

</script>

<?php
include_once(G5_THEME_PATH.'/tail_eng.php'); //footer 파일 연결