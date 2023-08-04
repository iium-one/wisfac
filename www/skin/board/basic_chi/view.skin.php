<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once('/home/wespec/www/chi/include/sub_top.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>


<div id="notice" class="contents">
  <?php sub_top($sb_menus, 'cs', 'notice'); ?>

  <div id="sb-contents">
    <section class="board-view">
      <h2 class="sound_only">회사소식 상세 내용</h2>
      <div class="container">
        <div class="wrapper">
          <div class="sec_ct">

            <div class="board-head">
              <p class="board-v-subj"><?php echo get_text($view['wr_subject']);?></p>
              <p class="board-v-date"><?php echo date("Y.m.d", strtotime($view['wr_datetime'])); ?></p>
            </div>

            <div id="bo_v_source">
              <!-- 첨부파일 시작 { -->
              <?php
              $cnt = 0;
              if ($view['file']['count']) {
                for ($i=0; $i<count($view['file']); $i++) {
                  if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'])
                    $cnt++;
                }
              }
              ?>
              <?php if($cnt) { ?>
              <div id="bo_v_file" class="bo_v_source_ct">
                <ul>
                  <?php
                  // 가변 파일
                  for ($i=0; $i<count($view['file']); $i++) {
                    if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
                  ?>
                  <li>
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                      <strong><?php echo $view['file'][$i]['source'] ?></strong>
                      <span class="bo_v_file_size"><?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)</span>
                    </a>
                  </li>
                  <?php
                    }
                  }
                  ?>
                </ul>
              </div>
              <?php } ?>
              <!-- } 첨부파일 끝 -->

              <!-- 관련링크 시작 { -->
              <?php if(isset($view['link']) && array_filter($view['link'])) { ?>
              <div id="bo_v_link" class="bo_v_source_ct">
                <ul>
                  <?php
                  // 링크
                  $cnt = 0;
                  for ($i=1; $i<=count($view['link']); $i++) {
                    if ($view['link'][$i]) {
                      $cnt++;
                      $link = cut_str($view['link'][$i], 70);
                  ?>
                  <li>
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                        <strong><?php echo $link ?></strong>
                    </a>
                  </li>
                  <?php
                    }
                  }
                  ?>
                </ul>
              </div>
              <?php } ?>
              <!-- } 관련링크 끝 -->
            </div>

            <div class="board-v-cont">
              <?php echo get_view_thumbnail($view['content']); ?>
            </div>

            <div class="board-v-btn_group">
              <a href="<?php echo $list_href ?>" class="board-v-golist-btn">目录</a>
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
            
            <!-- 게시물 관리 버튼 시작 { -->
            <div id="bo_v_bot">
              <?php ob_start(); ?>

              <ul class="btn_bo_user bo_v_com">
                <?php if ($update_href) { ?>
                <li>
                  <a href="<?php echo $update_href ?>" class="bo_btn2">수정</a>
                </li>
                <?php } ?>
                <?php if ($delete_href) { ?>
                <li>
                  <a href="<?php echo $delete_href ?>" class="bo_btn3" onclick="del(this.href); return false;">삭제</a>
                </li>
                <?php } ?>
              </ul>
              <?php
              $link_buttons = ob_get_contents();
              ob_end_flush();
              ?>
            </div>
            <!-- } 게시물 관리 버튼 끝 -->

          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
  $("a.view_file_download").click(function() {
    if(!g5_is_member) {
      alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
      return false;
    }

    var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

    if(confirm(msg)) {
      var href = $(this).attr("href")+"&js=on";
      $(this).attr("href", href);

      return true;
    } else {
      return false;
    }
  });
});
<?php } ?>

function board_move(href)
{
  window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
  $("a.view_image").click(function() {
    window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
    return false;
  });

  // 추천, 비추천
  $("#good_button, #nogood_button").click(function() {
    var $tx;
    if(this.id == "good_button")
      $tx = $("#bo_v_act_good");
    else
      $tx = $("#bo_v_act_nogood");

    excute_good(this.href, $(this), $tx);
    return false;
  });

  // 이미지 리사이즈
  $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
  $.post(
    href,
    { js: "on" },
    function(data) {
      if(data.error) {
        alert(data.error);
        return false;
      }

      if(data.count) {
        $el.find("strong").text(number_format(String(data.count)));
        if($tx.attr("id").search("nogood") > -1) {
          $tx.text("이 글을 비추천하셨습니다.");
          $tx.fadeIn(200).delay(2500).fadeOut(200);
        } else {
          $tx.text("이 글을 추천하셨습니다.");
          $tx.fadeIn(200).delay(2500).fadeOut(200);
        }
      }
    }, "json"
  );
}
</script>