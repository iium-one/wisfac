<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');

$inquery_table = G5_TABLE_PREFIX."inquiry";
$idx = $params[0];
$inq = sql_fetch(" select * from {$inquery_table} where inq_id='{$idx}' ");
?>

<div id="contact" class="contents">
  <?php sub_top($sb_menus, 'cs', 'contact'); ?>

  <div id="sb-contents">
    <section class="board-view">
      <h2 class="sound_only">문의하기 상세 내용</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <div class="board-head">
              <p class="board-v-subj"><?php echo $inq['inq_subj']; ?></p>
              <p class="board-v-date"><?php echo date("Y.m.d", strtotime($inq['inq_date'])); ?></p>
            </div>
            <div class="board-v-cont">
              <div class="inq-v-text_wrap">
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">이름</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_name']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">이메일</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_mail']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">지역</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_area']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">회사/학교</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_company']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">부서</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_depart']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">전화번호</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_tel']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">주소</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_add']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">문의사항</span>
                  <span class="inq-v-text-cont"><?php echo nl2br($inq['inq_content']); ?></span>
                </p>
              </div>
            </div>
            <div class="board-v-btn_group">
              <a href="" class="board-v-golist-btn">목록</a>
              <div class="board-v-navi_group">
                <a href="" class="board-v-navi-btn prev"><span class="icon"></span>PREV</a>
                <a href="" class="board-v-navi-btn next">NEXT<span class="icon"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>