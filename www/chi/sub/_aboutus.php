<?php 
include_once(G5_PATH.'/chi/include/sub_top.php');
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
              <p class="sb_top-title-text1">引领全世界半导体用晶片检查设备市场的跨国企业<span class="highlight">WISFAC。</span></p>
              <p class="sb_top-title-text2">以技术密集型世界一流企业为目标,于2018年成立的WISFAC为了晶片检查设备技术的国产化，正在进行多年的技术开发，<br/>正在成长为半导体用晶片检查领域以纯国内技术为基础，开发并生产适用尖端技术的Wafer Inspection设备的全球专门企业。</p>
            </div>
            <div class="match-height dgtxt-wrap aboutus-slo cd4">
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">技术革命</p>
                  <p class="dgtxt-text2">专利获得，尖端技术集成、Ai应用</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">产品多样化</p>
                  <p class="dgtxt-text2">生产符合多种Wafer Inspection的设备</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">跨国企业成长</p>
                  <p class="dgtxt-text2">超越亚洲，确保欧洲、美洲的顾客公司</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">企业人才</p>
                  <p class="dgtxt-text2">通过体系的人才选拔和培养，强化企业力量</p>
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
              <span class="highlight2"><b>WISFAC<?php echo $_GET['v'];?></b></span>
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
              WISFAC集中确保人才和核心技术，将力量最大化进一步加大产品差异化、新产品开发力度，<br/>
              逐步发展成为拥有世界领先技术水平的技术密集型企业。<br/>
              作为超一流企业，将创造世界市场的新文化,成为把顾客利益放在首位的全球顶级专业企业。
            </p>
            <div class="match-height vision-slo">
              <div class="vision-slo-item item1">
                <p class="vision-slo-text1">高科技的WISFAC</p>
                <p class="vision-slo-text2">整合硬件及软件技术<br/>尖端检查设备最高水平的技术<br/>兼备的企业</p>
              </div>
              <div class="vision-slo-item item2">
                <p class="vision-slo-text1">创造客户价值</p>
                <p class="vision-slo-text2">以无限的责任感将顾客价值提升到最高的企业。</p>
              </div>
              <div class="vision-slo-item item3">
                <p class="vision-slo-text1">IBS HA 的 WISFAC</p>
                <p class="vision-slo-text2">智能建筑(intelligent building)系统及全自动化的<br/>开发出最高技术及产品，未来社会的<br/>创造新文化的企业</p>
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
                  <span>CEO代表</span>
                  <ul class="organ-2dp">
                    <li>
                      <span>CTO副总经理</span>
                      <ul class="organ-3dp">
                        <li>
                          <span>技术研究所</span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon software">
                                  <img src="/source/img/organ-icon-software.png" alt="">
                                </span>
                                软件开发部
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon hardware">
                                  <img src="/source/img/organ-icon-hardware.png" alt="">
                                </span>
                                硬件开发部
                              </span>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span>经营企划室长</span>
                      <ul class="organ-3dp">
                        <li>
                          <span class="none"></span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon planning">
                                  <img src="/source/img/organ-icon-planning.png" alt="">
                                </span>
                                企划本部
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon production">
                                  <img src="/source/img/organ-icon-production.png" alt="">
                                </span>
                                生产技术部
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon sales">
                                  <img src="/source/img/organ-icon-sales.png" alt="">
                                </span>
                                营业部
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