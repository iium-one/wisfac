<?php 
include_once(G5_PATH.'/eng/include/sub_top.php');
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
              <p class="sb_top-title-text1">Leading the global market for <span class="highlight"><b>wafer inspection equipment for semiconductors</b></span> <b>wisfac, a global company</b></p>
              <p class="sb_top-title-text2">Founded in 2018 with the goal of becoming a world-class technology-intensive company, Wisfac has been <b>developing technologies for many years to localize wafer inspection equipment technology. </b><b>In the field of wafer inspection for semiconductors, We are growing into a global specialized company that develops and produces Wafer Inspection equipment based on pure domestic technology.</b></p>
            </div>
            <div class="match-height dgtxt-wrap aboutus-slo cd4">
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">Technological innovation</p>
                  <p class="dgtxt-text2">Patent acquisition, High-tech concentration, Ai application</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">Product diversification</p>
                  <p class="dgtxt-text2">Production of equipment tailored to various Wafer inspections</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">Global Corporate Growth</p>
                  <p class="dgtxt-text2">Beyond Asia, Secures customers in the Americas and Europe</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">Corporate talent</p>
                  <p class="dgtxt-text2">Strengthen corporate capabilities through systematic selection and development of human resources</p>
                </div>
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
              <?php
              $sb_menu3_selected = '';
              foreach ($sb_menus as $menu) {
                if ($menu['id'] === 'introduce') {
                  foreach ($menu['sb_2menus'] as $menu2) {
                    if ($menu2['id'] === 'aboutus') {
                      foreach ($menu2['sb_3menus'] as $menu3) {
                        $sb_menu3_selected = !isset($_GET['v']) || $_GET['v']==$menu3['id']?'on':'';

                        echo '<button type="button" class="tabs-btn '.$sb_menu3_selected.'" data-id="ct_'.$menu3['id'].'">'.$menu3['name'].'</button>';
                      }
                      break;
                    }
                  }
                  break;
                }
              }
              ?>
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
            Wisfac <b>maximizes it's capabilities by focusing on securing talent and core skills.</b> By further accelerating product differentiation and new product development, <b>we are growing into a technology-intensive company with the best technology in the world.</b> As a top-tier company, we will <b>create a new culture</b> in the global market and become <b>the world's best professional company</b> that puts <b>customer interests first.</b>
            </p>
            <div class="match-height vision-slo">
              <div class="vision-slo-item item1">
                <p class="vision-slo-text1">A high-tech Wisfac</p>
                <p class="vision-slo-text2">Integrating hardware and software technologies, A company with the highest level of technology for state-of-the-art inspection equipment</p>
              </div>
              <div class="vision-slo-item item2">
                <p class="vision-slo-text1">Creating Customer Value</p>
                <p class="vision-slo-text2">Companies that maximize customer value with unlimited responsibility </p>
              </div>
              <div class="vision-slo-item item3">
                <p class="vision-slo-text1">Wisfac of IBS HA</p>
                <p class="vision-slo-text2">Intelligent Building Systems and Hall Automation Developing the best technologies and produts in the futuer society a company that creates a new culture</p>
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
                  <span>CEO</span>
                  <ul class="organ-2dp">
                    <li>
                      <span>Vice President of CTO</span>
                      <ul class="organ-3dp">
                        <li>
                          <span>A technical research institute</span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon software">
                                  <img src="/source/img/organ-icon-software.png" alt="">
                                </span>
                                Software Development
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon hardware">
                                  <img src="/source/img/organ-icon-hardware.png" alt="">
                                </span>
                                Hardware Development
                              </span>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span>Director of Management Planning</span>
                      <ul class="organ-3dp">
                        <li>
                          <span class="none"></span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon planning">
                                  <img src="/source/img/organ-icon-planning.png" alt="">
                                </span>
                                Planning Headquarters
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon production">
                                  <img src="/source/img/organ-icon-production.png" alt="">
                                </span>
                                Production Technology
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon sales">
                                  <img src="/source/img/organ-icon-sales.png" alt="">
                                </span>
                                Sales Department
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