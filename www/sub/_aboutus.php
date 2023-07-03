<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');
?>

<div id="aboutus" class="contents">
  <?php sub_top($sb_menus, 'introduce', 'aboutus'); ?>

  <div id="sb-contents">
    <section class="aboutus-intro">
      <h2 class="sound_only">회사소개 내용 영역</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <div class="sb_top-title">
              <p class="sb_top-title-text1">전 세계 <span class="highlight"><b>반도체용 웨이퍼 검사 장비</b></span> 시장을 선도하는 <br/><b>글로벌 기업, 위스팩</b> 입니다.</p>
              <p class="sb_top-title-text2">기술집약형 세계 일류 기업을 목표로 2018년에 설립된 위스팩은 웨이퍼 <b>검사 장비 기술 국산화를 위해 다년간의 기술 개발</b>을 하고 있으며, <br/><b>반도체용 웨이퍼 검사 분야에서 순수 국내기술을 기반으로 첨단 기술을 적용한 Wafer Inspection 장비들을 개발하여 생산</b>하는 <b>글로벌 전문기업으로 성장</b>하고 있습니다.</p>
            </div>
            <div class="match-height aboutus-slo">
              <div class="aboutus-slo-item">
                <p class="aboutus-slo-text1">기술혁신</p>
                <p class="aboutus-slo-text2">특허 취득, 첨단 기술 집약, Ai적용</p>
              </div>
              <div class="aboutus-slo-item">
                <p class="aboutus-slo-text1">제품다양화</p>
                <p class="aboutus-slo-text2">다양한 Wafer Inspection에 맞춘 장비 생산</p>
              </div>
              <div class="aboutus-slo-item">
                <p class="aboutus-slo-text1">글로벌 기업성장</p>
                <p class="aboutus-slo-text2">아시아를 넘어 유럽, 미주 고객사 확보</p>
              </div>
              <div class="aboutus-slo-item">
                <p class="aboutus-slo-text1">기업인재</p>
                <p class="aboutus-slo-text2">체계적인 인재 선발과 육성을 통해 기업 역량 강화</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="aboutus-tab">
      <h2 class="sound_only">비전, 조직도 탭버튼 영역</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <p class="aboutus-tab-text1">
              Wisdom Factory of New Technology, <br/>
              <span class="highlight2"><b>WISFAC</b></span>
            </p>
            <div class="tabs tabs2 aboutus-pg-tabs">
              <button type="button" class="tabs-btn <?php echo !isset($_GET['v']) || $_GET['v']=='vision'?'on':'';?>" data-id="ct_vision">비전</button>
              <button type="button" class="tabs-btn <?php echo $_GET['v']=='organization'?'on':'';?>" data-id="ct_organization">조직도</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="ct_vision" class="aboutus-tab-ct <?php echo !isset($_GET['v']) || $_GET['v']=='vision'?'on':'';?>">
      <h2 class="sound_only">비전 컨텐츠 영역</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <p>We are always ready to help you.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="ct_organization" class="aboutus-tab-ct <?php echo $_GET['v']=='organization'?'on':'';?>">
      <h2 class="sound_only">조직도 컨텐츠 영역</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <p>CEO대표이사</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>