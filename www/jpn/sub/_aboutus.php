<?php 
include_once(G5_PATH.'/jpn/include/sub_top.php');
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
              <p class="sb_top-title-text1">全世界の半導体用ウェハ検査装置市場を先導す<br/>るグローバル企業、<span class="highlight"><b>ウィスファクです。</b></span></p>
              <p class="sb_top-title-text2">技術集約型の世界一流企業を目標として2018年に設立されたウィスファクはウェハ検査装置技術を国産化するために長年にわたって技術開発を行っており、<br/>半導体用ウェハ検査分野において韓国技術をベースに先端技術を適用したWafer Inspection装置を開発・生産するグローバル専門企業として成長しています。</p>
            </div>
            <div class="match-height dgtxt-wrap aboutus-slo cd4">
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">技術革新</p>
                  <p class="dgtxt-text2">特許取得、先端技術集約、AI適用</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">製品の多様化</p>
                  <p class="dgtxt-text2">様々なWafer Inspectionに合った装置を生産</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">グローバル企業としての成長</p>
                  <p class="dgtxt-text2">アジアを超え、欧州、米州の顧客先を確保</p>
                </div>
              </div>
              <div class="dgtxt-list">
                <div class="dgtxt-list-in">
                  <p class="dgtxt-text1">企業の人材</p>
                  <p class="dgtxt-text2">体系的な人材選抜と育成を通した企業の力量強化</p>
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
              ウィスファクは人材と核心技術の確保に集中することで力量を最大限に活かし<br/>
              製品の差別化と新製品開発にさらに拍車を加え世界最高の技術力を持つ技術集約的企業として成長しています。<br/>
              超一流企業として世界市場で新しい文化を創造し、お客様の利益を最優先とする世界一の専門企業になります。
            </p>
            <div class="match-height vision-slo">
              <div class="vision-slo-item item1">
                <p class="vision-slo-text1">先端技術のウィスファク</p>
                <p class="vision-slo-text2">ハードウェアおよびソフトウェアの技術を統合し<br/>先端検査装置の最高水準の技術を<br/>兼ね揃えた企業</p>
              </div>
              <div class="vision-slo-item item2">
                <p class="vision-slo-text1">お客様の価値創造</p>
                <p class="vision-slo-text2">揺るぎることのない責任感を持ってお客様の価値を<br/>最高に高める企業</p>
              </div>
              <div class="vision-slo-item item3">
                <p class="vision-slo-text1">IBS HAのウィスファク</p>
                <p class="vision-slo-text2">インテリジェントビルシステム及びオートメーションの<br/>最高技術及び製品を開発し、未来の社会で<br/>新しい文化を創造する企業</p>
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
                  <span>CEO代表理事</span>
                  <ul class="organ-2dp">
                    <li>
                      <span>CTO副社長</span>
                      <ul class="organ-3dp">
                        <li>
                          <span>技術研究所</span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon software">
                                  <img src="/source/img/organ-icon-software.png" alt="">
                                </span>
                                ソフトウェア開発部
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon hardware">
                                  <img src="/source/img/organ-icon-hardware.png" alt="">
                                </span>
                                ハードウェア開発部
                              </span>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span>経営技術室長</span>
                      <ul class="organ-3dp">
                        <li>
                          <span class="none"></span>
                          <ul class="organ-4dp">
                            <li>
                              <span>
                                <span class="icon planning">
                                  <img src="/source/img/organ-icon-planning.png" alt="">
                                </span>
                                企画本部
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon production">
                                  <img src="/source/img/organ-icon-production.png" alt="">
                                </span>
                                生産技術部
                              </span>
                            </li>
                            <li>
                              <span>
                                <span class="icon sales">
                                  <img src="/source/img/organ-icon-sales.png" alt="">
                                </span>
                                営業部
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