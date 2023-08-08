<?php 
include_once(G5_PATH.'/eng/include/sub_top.php');

$inquery_table = G5_TABLE_PREFIX."inquiry_eng";

$sfl = $_GET['sfl'];
$stx = $_GET['stx'];

$sql_common = " from {$inquery_table} ";
$sql_search = " where (1) ";

if ($stx) {
  $sql_search .= " and ( ";
  $sql_search .= " ($sfl like '%$stx%') ";
  $sql_search .= " ) ";
}

$sst = "inq_date";
$sod = "desc";
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_where} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 10;
$total_page  = ceil($total_count / $rows);
$page = $_GET['page'];
if ($page < 1) { $page = 1; }
$from_record = ($page - 1) * $rows;

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

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
?>

<div id="contact" class="contents">
  <?php sub_top($sb_menus, 'cs', 'contact'); ?>

  <div id="sb-contents">
    <section class="board-top">
      <h2 class="sound_only">검색 및 작성버튼</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <form id="fm-sch" method="get">
              <div class="sch_wrap">
                <select name="sfl" id="sfl" class="nc-sel sch-select">
                  <option value="inq_subj" selected>Title</option>
                </select>
                <input type="text" name="stx" id="stx" class="sch-keyword" value="<?php echo $stx;?>" required placeholder="plesse enter a search term">
                <button type="submit" class="sch-submit" title="검색하기"></button>
              </div>
              <?php if( isset($sfl) || isset($stx) ){ ?>
              <a href="/eng/sub/contact" class="return-btn" title="전체검색"></a>
              <?php } ?>
            </form>
            <a href="/eng/sub/contact_register" class="write-btn">Write inquiry</a>
          </div>
        </div>
      </div>
    </section>

    <section class="board-list textType-a">
      <h2 class="sound_only">게시글 목록</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <div class="board-list_wrap">
              <?php 
              $k=0;
              for($i=0; $row=sql_fetch_array($result); $i++){ 
                $list_num = $total_count - ($page - 1) * $rows;
                $row[$i]['num'] = $list_num - $k;
                $k++;
              ?>
              <div class="board-list-item">
                <div class="num"><?php echo $row[$i]['num'];?></div>
                <button type="button" class="view-btn subj" data-post-id="<?php echo $row['inq_id'];?>" data-post-qstr="<?php echo $qstr;?>"><?php echo $row['inq_subj'];?></button>
                <!-- <a href="/eng/sub/contact_view/<?php echo $row['inq_id'];?>?<?php echo $qstr;?>" class="subj"><?php echo $row['inq_subj'];?></a> -->

                <div class="date">
                  <span class="date-text"><?php echo date("Y.m.d", strtotime($row['inq_date'])); ?></span>
                  <button type="button" class="view-btn more-btn" data-post-id="<?php echo $row['inq_id'];?>" data-post-qstr="<?php echo $qstr;?>">Learn more<img src="/source/img/arrow-right-red.png" alt=""></button>
                  <!-- <a href="/eng/sub/contact_view/<?php echo $row['inq_id'];?>?<?php echo $qstr;?>" class="more-btn">Learn more<img src="/source/img/arrow-right-red.png" alt=""></a> -->
                </div>
              </div>
              <?php 
              }
              if ($i == 0) {
                echo '<div class="empty_table">There is no data.</div>';
              }
              ?>
            </div>
            <?php echo get_paging(5, $page, $total_page, '/eng/sub/contact?'.$qstr.'&amp;page='); ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<div class="password_dim">
  <div class="password_ct">
    <button type="button" class="password_close"><i class="fa fa-times" aria-hidden="true"></i></button>
    <p class="password_tit">Check password</p>
    <p class="password_cau">
      Please enter the password you entered when writing the inquiry. <br/>If you don't know the password, you can't view it, and please contact the administrator.
    </p>

    <form id="password_fm" action="" method="post">
      <input type="hidden" name="return_url" value="<?php echo G5_URL.$_SERVER[ "REQUEST_URI" ];?>">
      <input type="password" name="contact_check_pw" required id="contact_check_pw" class="form-input full">
      <button type="submit" class="contact_check_pw_submit">Confirm</button>
    </form>
  </div>
</div>

<script>
$(document).ready(function(){
  const $passwordPop = $(".password_dim");
  let post_id="";
  let post_qstr="";
  let post_link="";

  $(".view-btn").on('click', function(){
    post_id = $(this).data('post-id');
    post_qstr = $(this).data('post-qstr');
    post_link = `/eng/sub/contact_view/${post_id}?${post_qstr}`;

    $("#password_fm").attr('action', post_link);
    $passwordPop.fadeIn(200);
  });

  $(".password_close").on('click', function(){
    $passwordPop.fadeOut(200);
  });
});
</script>