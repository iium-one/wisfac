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
            제목 : <?php echo $inq['inq_subj']; ?> <br/><br/>
            날짜 : <?php echo date("Y.m.d", strtotime($inq['inq_date'])); ?> <br/><br/>
            이름 : <?php echo $inq['inq_name']; ?> <br/><br/>
            이메일 : <?php echo $inq['inq_mail']; ?> <br/><br/>
            지역 : <?php echo $inq['inq_area']; ?> <br/><br/>
            회사/학교 : <?php echo $inq['inq_company']; ?> <br/><br/>
            부서 : <?php echo $inq['inq_depart']; ?> <br/><br/>
            전화번호 : <?php echo $inq['inq_tel']; ?> <br/><br/>
            주소 : <?php echo $inq['inq_add']; ?> <br/><br/>
            문의사항 : <?php echo nl2br($inq['inq_content']); ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>