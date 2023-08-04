<?php 
include_once('/home/wespec/www/chi/include/sub_top.php');

$inquery_table = G5_TABLE_PREFIX."inquiry_chi";
$idx = $params[0];
$inq = sql_fetch(" select * from {$inquery_table} where inq_id='{$idx}' ");

$inq_return = $_POST['return_url'];
$inq_check_pw = $_POST['contact_check_pw'];
$inq_pw = $inq['inq_pw'];

if( !check_password($inq_check_pw, $inq_pw) ) {
  alert("비밀번호가 일치하지 않습니다.", $inq_return);
}

$sfl = $_GET['sfl'];
$stx = $_GET['stx'];
$page = $_GET['page'];

if(isset($sfl) || isset($stx)){
  $qstr .= "sfl=".$sfl."&stx=".$stx;
}
if(isset($page)){
  if(isset($sfl) || isset($stx)){
    $qstr .= "&page=".$page;
  }else{
    $qstr .= "page=".$page;
  }
}

// 윗글을 얻음
$sql = " select inq_id from {$inquery_table} where inq_id < '{$idx}' order by inq_date desc limit 1 ";
$prev = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (! (isset($prev['inq_id']) && $prev['inq_id'])) {
    $sql = " select inq_id from {$inquery_table} where inq_id < '{$idx}' order by inq_date desc limit 1 ";
    $prev = sql_fetch($sql);
}

// 아래글을 얻음
$sql = " select inq_id from {$inquery_table} where inq_id > '{$idx}' order by inq_date limit 1 ";
$next = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (! (isset($next['inq_id']) && $next['inq_id'])) {
    $sql = " select inq_id from {$inquery_table} where inq_id > '{$idx}' order by inq_date limit 1 ";
    $next = sql_fetch($sql);
}

// 이전글 링크
$prev_href = '';
if (isset($prev['inq_id']) && $prev['inq_id']) {
  $prev_href = '/sub/contact_view/'.$prev['inq_id'].'?'.$qstr;
}

// 다음글 링크
$next_href = '';
if (isset($next['inq_id']) && $next['inq_id']) {
  $next_href = '/sub/contact_view/'.$next['inq_id'].'?'.$qstr;
}
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
                  <span class="inq-v-text-tit">姓名</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_name']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">电子邮件</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_mail']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">地区</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_area']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">公司/学校</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_company']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">部门</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_depart']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">电话号码</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_tel']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">地址</span>
                  <span class="inq-v-text-cont"><?php echo $inq['inq_add']; ?></span>
                </p>
                <p class="match-height inq-v-text">
                  <span class="inq-v-text-tit">咨询事项</span>
                  <span class="inq-v-text-cont"><?php echo nl2br($inq['inq_content']); ?></span>
                </p>
              </div>
            </div>
            <div class="board-v-btn_group">
              <a href="/sub/contact<?php echo $qstr!=''?'?'.$qstr:'';?>" class="board-v-golist-btn">目录</a>
              <?php if($prev_href || $next_href) { ?>
              <div class="board-v-navi_group">
                <?php if($prev_href) { ?>
                <a href="<?php echo $prev_href;?>" class="board-v-navi-btn prev"><span class="icon"></span>之前</a>
                <?php } ?>
                <?php if($next_href) { ?>
                <a href="<?php echo $next_href;?>" class="board-v-navi-btn next">下一个<span class="icon"></span></a>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>