<?php
if (!defined('_INDEX_')) define('_INDEX_', true); //index 상수 설정

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php'); //header 파일 연결
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
                  <p class="main-visual-stxt">미래 세계를 위한 첨단 기술을 개발하는 기업</p>
                  <p class="main-visual-btxt"><span class="highlight">Create advanced technology</span> <br/>for the future world</p>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide main-visual-item item2">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">정확도와 정밀성의 혁신적인 제품과 기술</p>
                  <p class="main-visual-btxt">Innovation in <span class="highlight">Silicon Wafer</span> <br/><span class="highlight">Inspection System</span></p>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide main-visual-item item3">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">글로벌 웨이퍼 검사 장비 기업</p>
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
              전 세계가 주목하고 있는 위스팩의 Wafer 검사 장비들은 자동화 시스템이 잘 갖춰졌으며 <br/>검사/검출의 신기술들이 집약되어 운용의 편리함과 고객의 니즈를 충족하여 전 세계 고객사들로부터 극찬을 받고 있습니다. <br/>
              지금 위스팩의 검사 장비들을 만나보시고 문의해 주세요.
              우리는 언제든 여러분을 만날 준비가 되어있습니다.
            </p>
          </div>
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

  <section class="main-contact">
    <div class="main-contact_box main-contact_lt" data-aos="fade-right" data-aos-duration="1000">
      <div class="main-contact_ct">
        <div class="main-contact_ct_inner">
          <p class="main-contact-title">위스팩 소개</p>
          <p class="main-contact-expl">세계가 인정하는 기술과 제품 <br/><b>위스팩이 궁금</b>하신가요?</p>
          <a href="/sub/aboutus?v=vision" class="i-arrow-btn01">
            회사소개
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
          <p class="main-contact-title">고객문의</p>
          <p class="main-contact-expl">제품에 대해 <b>궁금한 내용</b>이 <br/>있으신가요?</p>
          <a href="/sub/contact" class="i-arrow-btn01">
            문의하기
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
            <h2 class="main_sec-subtitle1">고객지원</h2>
            <h2 class="main_sec-title1"><b>다양한 소식</b>을 확인하세요.</h2>
            <div class="tabs main-boarad-tabs">
              <button type="button" class="tabs-btn on" data-board="notice">공지사항</button>
              <button type="button" class="tabs-btn" data-board="news">회사소식</button>
            </div>
            <a href="/notice" class="i-arrow-btn01">
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
          <a href="/sub/global" class="main-banner_box main-banner-company">
            <div class="main-banner_ct_inner">
              <p class="banner-title">Global WISFAC</p>
              <p class="banner-subtitle"><b>글로벌기업</b> 위스팩을 만나보세요.</p>
              <p class="banner-expl">다년간의 기술 개발을 통해 반도체용 웨이퍼 검사 분야에서 순수 국내기술을 기반으로 <br/>첨단 기술 장비들을 개발하여 생산하는 글로벌 전문기업입니다.</p>
            </div>
            <div class="main-banner-prod">
              <img src="/source/img/main-company-banner-prod.png" alt="">
            </div>
          </a>
          <a href="/sub/business" class="main-banner_box main-banner-business">
            <div class="main-banner_ct_inner">
              <p class="banner-title">사업소개</p>
              <p class="banner-subtitle">위스팩의 <b>개발 제품군</b>을 확인하세요.</p>
              <p class="banner-expl">Si Wafer와 SiC Wafer 등 다양한 Wafer 검사를 위해 순수 국내기술로 개발하여 생산하고 있으며 <br/>다양한 하드웨어 제품군과 이와 관련된 다양한 소프트웨어 제품군을 가지고 있습니다.</p>
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
include_once(G5_THEME_PATH.'/tail.php'); //footer 파일 연결