<?php 
include_once(G5_INCLUDE_PATH.'/sub_top.php');
?>

<div id="contact" class="contents">
  <?php sub_top($sb_menus, 'cs', 'contact'); ?>

  <div id="sb-contents">
    <section class="board-top">
      <h2 class="sound_only">검색 및 작성버튼</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">
            <form id="fm-sch" action="">
              <div class="sch_wrap">
                <select name="" id="" class="nc-sel sch-select">
                  <option value="">전체</option>
                </select>
                <input type="text" class="sch-keyword" placeholder="검색어를 입력하세요.">
                <button type="submit" class="sch-submit" title="검색하기"></button>
              </div>
            </form>
            <a href="" class="write-btn">문의하기</a>
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
              <?php for($i = 0; $i < 10; $i++){ ?>
              <div class="board-list-item">
                <div class="num">01</div>
                <a href="" class="subj">게시판 제목 영역이 나타납니다. 게시판 제목 영역이 나타납니다.</a>
                <div class="date">
                  <span class="date-text">2023.07.10</span>
                  <a href="" class="more-btn">Learn more<img src="/source/img/arrow-right-red.png" alt=""></a>
                </div>
              </div>
              <?php } ?>
            </div>
            <!-- 페이징 { -->
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
            <!-- } 페이징 -->
          </div>
        </div>
      </div>
    </section>
  </div>
</div>