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
            <p class="vision_text1">We are always ready to help you.</p>
            <p class="vision_text2">
            위스팩은 <b>인재와 핵심기술 확보에 집중하여 역량을 극대화</b>함으로서 <br/>
            제품 차별화와 신제품 개발에 더욱 박차를 가해 세계 <b>최고의 기술력을 보유한 기술 집약적인 기업으로 성장</b>하고 있습니다. <br/>
            초일류 기업으로 세계시장의 <b>새로운 문화를 창조하며 고객의 이익을 최우선으로 하는 글로벌 최고의 전문기업</b>이 되겠습니다.
            </p>
            <div class="match-height vision-slo">
              <div class="vision-slo-item item1">
                <p class="vision-slo-text1">첨단 기술의 위스팩</p>
                <p class="vision-slo-text2">하드웨어 및 소프트웨어 기술을 통합하여 <br/>첨단 검사 장비 최고 수준의 기술을 <br/>겸비한 기업</p>
              </div>
              <div class="vision-slo-item item2">
                <p class="vision-slo-text1">고객 가치창조</p>
                <p class="vision-slo-text2">무한한 책임감으로 고객의 가치를 <br/>최고로 높이는 기업</p>
              </div>
              <div class="vision-slo-item item3">
                <p class="vision-slo-text1">IBS HA의 위스팩</p>
                <p class="vision-slo-text2">인텔리전트 빌딩 시스템 및 홀 오토케이션의 <br/>최고 기술 및 제품을 개발하여 미래사회의 <br/>새로운 문화를 창조하는 기업</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="ct_organization" class="aboutus-tab-ct <?php echo $_GET['v']=='organization'?'on':'';?>">
      <h2 class="sound_only">조직도 컨텐츠 영역</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <div class="organ_wrap">
              <ul class="organ-1dp">
                <li>
                  <span>CEO대표이사</span>
                  <ul class="organ-2dp">
                    <li>
                      <span>CTO부사장</span>
                      <ul class="organ-3dp">
                        <li>
                          <span>기술연구소</span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon software">
                                  <img src="/source/img/organ-icon-software.png" alt="">
                                </span>
                                소프트웨어 개발부
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon hardware">
                                  <img src="/source/img/organ-icon-hardware.png" alt="">
                                </span>
                                하드웨어 개발부
                              </span>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span>경영기획실장</span>
                      <ul class="organ-3dp">
                        <li>
                          <span class="none"></span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon planning">
                                  <img src="/source/img/organ-icon-planning.png" alt="">
                                </span>
                                기획본부
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon production">
                                  <img src="/source/img/organ-icon-production.png" alt="">
                                </span>
                                생산기술부
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon sales">
                                  <img src="/source/img/organ-icon-sales.png" alt="">
                                </span>
                                영업부
                              </span>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>