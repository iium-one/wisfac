<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/common.php';
if (!defined('_INDEX_')) define('_INDEX_', true); //index 상수 설정

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
 include_once(G5_THEME_PATH.'/head_chi.php'); //header 파일 연결
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
                  <p class="main-visual-stxt">一家开发面向未来世界的尖端技术的公司</p>
                  <p class="main-visual-btxt"><span class="highlight">Create advanced technology</span> <br/>for the future world</p>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide main-visual-item item2">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">有准确度和精度的创新产品和技术</p>
                  <p class="main-visual-btxt">Innovation in <span class="highlight">Silicon Wafer</span> <br/><span class="highlight">Inspection System</span></p>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide main-visual-item item3">
            <div class="container main-visual_ct">
              <div class="wrapper">
                <div class="main-visual_ct_inner">
                  <p class="main-visual-stxt">全球晶片检测设备公司</p>
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
              全世界瞩目的WISFAC的Wafer检查设备具备了完善的自动化系统。 <br/>
              集检验/检测新技术于一身，满足操作便利和客户需求,受到全球客户高度赞扬。<br/>
              现在请看完WISFAC的检查设备后再咨询。 我们随时准备与大家见面。
            </p>
          </div>
          <div class="match-height prod-cate_wrap">
            <?php
            $prod_cate_table = G5_TABLE_PREFIX.'shop_category';
            $prod_cate_where = 'ca_lang = "CHI"';
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
          <p class="main-contact-title">介绍WISFAC</p>
          <p class="main-contact-expl">想知道世界认可的技术和产品<br><b>WISFAC吗？</b></p>
          <a href="/sub/aboutus?v=vision" class="i-arrow-btn01">
            介绍公司
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
          <p class="main-contact-title">客户咨询</p>
          <p class="main-contact-expl">您对产品有什么疑问吗？</p>
          <a href="/sub/contact" class="i-arrow-btn01">
            询问
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
            <h2 class="main_sec-subtitle1">客户支援</h2>
            <h2 class="main_sec-title1">请确认各种消息。</h2>
            <div class="tabs main-boarad-tabs">
              <button type="button" class="tabs-btn on" data-board="notice">公告事项</button>
              <button type="button" class="tabs-btn" data-board="news">公司消息</button>
            </div>
            <a href="/notice" class="i-arrow-btn01">
              学习更多
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
              <p class="banner-title">跨国 WISFAC</p>
              <p class="banner-subtitle"><b>请见见跨国企业</b>WISFAC。</p>
              <p class="banner-expl">通过多年的技术开发，在半导体用晶片检查领域，<br/>以纯粹的国内技术为基础是一家开发生产高新技术装备的国际化专业企业。</p>
            </div>
            <div class="main-banner-prod">
              <img src="/source/img/main-company-banner-prod.png" alt="">
            </div>
          </a>
          <a href="/sub/business" class="main-banner_box main-banner-business">
            <div class="main-banner_ct_inner">
              <p class="banner-title">事业介绍</p>
              <p class="banner-subtitle">请确认WISFAC<b>的开发产品群。</b></p>
              <p class="banner-expl">为了进行Si Wafer和SiC Wafer等多种Wafer检查，用纯国内技术开发并生产。<br/>拥有多种硬件产品群和与此相关的多种软件产品群。</p>
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
include_once(G5_THEME_PATH.'/tail_chi.php'); //footer 파일 연결