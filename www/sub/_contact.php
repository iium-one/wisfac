<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');

$inquery_table = G5_TABLE_PREFIX."inquiry";

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

if(isset($sfl) || isset($stx) || isset($page)){
  $qstr .= "sfl=".$sfl."&stx=".$stx."page=".$page;
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
                  <option value="inq_name" <?php echo get_selected($sfl, "inq_name"); ?>>전체</option>
                </select>
                <input type="text" name="stx" id="stx" class="sch-keyword" value="<?php echo $stx;?>" required placeholder="검색어를 입력하세요.">
                <button type="submit" class="sch-submit" title="검색하기"></button>
              </div>
              <?php if( isset($sfl) || isset($stx) ){ ?>
              <a href="/sub/contact" class="return-btn" title="전체검색"></a>
              <?php } ?>
            </form>
            <a href="/sub/contact_register" class="write-btn">문의하기</a>
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
                <a href="" class="subj"><?php echo $row['inq_name'];?></a>
                <div class="date">
                  <span class="date-text">2023.07.10</span>
                  <a href="" class="more-btn">Learn more<img src="/source/img/arrow-right-red.png" alt=""></a>
                </div>
              </div>
              <?php 
              }
              if ($i == 0) {
                echo '<div class="empty_table">자료가 없습니다.</div>';
              }
              ?>
            </div>
            <?php echo get_paging(5, $page, $total_page, '/sub/contact?'.$qstr.'&amp;page='); ?>
            <!-- 페이징 { 
            <nav class="pg_wrap">
              <span class="pg">
                <a href="" class="pg_page pg_start">처음</a>
                <span class="sound_only">열린</span>
                <strong class="pg_current">1</strong>
                <span class="sound_only">페이지</span>
                <a href="" class="pg_page">
                  2<span class="sound_only">페이지</span>
                </a>
                <a href="" class="pg_page">
                  3<span class="sound_only">페이지</span>
                </a>
                <a href="" class="pg_page">
                  4<span class="sound_only">페이지</span>
                </a>
                <a href="" class="pg_page">
                  5<span class="sound_only">페이지</span>
                </a>
                <a href="https://ismr.or.kr/faq?page=2" class="pg_page pg_end">맨끝</a>
              </span>
            </nav>
            } 페이징 -->
          </div>
        </div>
      </div>
    </section>
  </div>
</div>