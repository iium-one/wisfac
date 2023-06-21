<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

/*
#관리자 > 게시판 관리 > 갤러리 이미지 폭, 갤러리 이미지 높이 = 300 으로 설정
*/
?>

<div class="sub">
  <!-- sub contents { -->
  <div id="gallery_list" class="sub_contents">
    <div class="wrapper">

      <!-- 게시판 목록 시작 { -->
      <div id="bo_gall" style="width:<?php echo $width; ?>">

        <!-- 게시판 카테고리 시작 { -->
        <?php if ($is_category) { ?>
        <nav id="bo_cate">
          <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
          <ul id="bo_cate_ul">
            <?php echo $category_option ?>
          </ul>
        </nav>
        <?php } ?>
        <!-- } 게시판 페이지 정보 -->

        <div class="bo_top_info">
          <!-- 게시판 페이지 정보 { -->
          <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
          </div>
          <!-- } 게시판 페이지 정보 -->

          <!-- 게시판 검색 시작 { -->
          <div class="bo_sch_wrap">
            <fieldset class="bo_sch">
              <h3 class="sound_only">검색</h3>
              <form name="fsearch" method="get">
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sop" value="and">
                <label for="sfl" class="sound_only">검색대상</label>
                <div class="bo_sch_ct">
                  <select name="sfl" id="sfl">
                    <option value="wr_subject||wr_content" selected="selected">전체</option>
                    <option value="wr_subject">제목</option>
                    <option value="wr_content">내용</option>
                  </select>
                  
                  <div class="sch_bar">
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                    <button type="submit" value="검색" class="sch_btn">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <span class="sound_only">검색</span>
                    </button>
                  </div>
                  <?php if(isset($_REQUEST['stx']) || $_REQUEST['stx'] != ''){ ?>
                  <a href="/bbs/board.php?bo_table=<?php echo $bo_table;?>" class="sch_back">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                  </a>
                  <?php } ?>
                </div>
              </form>
            </fieldset>
          </div>
          <!-- } 게시판 검색 끝 --> 
        </div>

        <form name="fboardlist"  id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
          <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
          <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
          <input type="hidden" name="stx" value="<?php echo $stx ?>">
          <input type="hidden" name="spt" value="<?php echo $spt ?>">
          <input type="hidden" name="sst" value="<?php echo $sst ?>">
          <input type="hidden" name="sod" value="<?php echo $sod ?>">
          <input type="hidden" name="page" value="<?php echo $page ?>">
          <input type="hidden" name="sw" value="">

          <?php if ($is_checkbox) { ?>
          <div id="gall_allchk" class="all_chk chk_box">
              <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
              <label for="chkall">
                  <span></span>
                  <b class="sound_only">현재 페이지 게시물 </b> 전체선택
              </label>
          </div>
          <?php } ?>

          <div id="gall_contents">
            <ul id="gall_ul" class="gall_row">
              <?php
              for ($i=0; $i<count($list); $i++) {
                $classes = array();
                $classes[] = 'gall_li';
                $classes[] = 'col-gn-'.$bo_gallery_cols;

                if( $i && ($i % $bo_gallery_cols == 0) ){
                  $classes[] = 'box_clear';
                }

                if( $wr_id && $wr_id == $list[$i]['wr_id'] ){
                  $classes[] = 'gall_now';
                }

                $line_height_style = ($board['bo_gallery_height'] > 0) ? 'line-height:'.$board['bo_gallery_height'].'px' : '';
              ?>
              <li class="<?php echo implode(' ', $classes); ?>">
                <div class="gall_box">
                  <div class="gall_chk chk_box">
                    <?php if ($is_checkbox) { ?>
                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                    <label for="chk_wr_id_<?php echo $i ?>">
                      <span></span>
                      <b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
                    </label>
                    <?php } ?>

                    <span class="sound_only">
                      <?php
                      if ($wr_id == $list[$i]['wr_id'])
                        echo "<span class=\"bo_current\">열람중</span>";
                      else
                        echo $list[$i]['num'];
                      ?>
                    </span>
                  </div>
                  <div class="gall_con">
                    <div class="gall_img">
                      <a href="<?php echo $list[$i]['href'] ?>">
                      <?php
                      if ($list[$i]['is_notice']) { // 공지사항  ?>
                        <span class="is_notice" style="<?php echo $line_height_style; ?>">공지</span>
                      <?php } else {
                        $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

                        if($thumb['src']) {
                          $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
                        } else {
                          $img_content = '<span class="no_image" style="'.$line_height_style.'">no image</span>';
                        }

                        echo run_replace('thumb_image_tag', $img_content, $thumb);
                      }
                      ?>
                      </a>
                    </div>
                    <div class="gall_text_href">
                      <?php if ($is_category && $list[$i]['ca_name']) { ?>
                      <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                      <?php } ?>

                      <a href="<?php echo $list[$i]['href'] ?>" class="cut_text bo_tit">
                        <?php echo $list[$i]['wr_subject']; //글 제목 ?>
                      </a>
                      <duv class="bo_cnt"><?php echo utf8_strcut(strip_tags($list[$i]['wr_content']), 68, '..'); ?></duv>
                    </div>

                    <div class="cf gall_info">
                      <ul class="i-col-0 gall_info_ul">
                        <li>
                          <span class="sound_only">작성자 </span>
                          <span class="gall_info_txt gall_writer">
                            <i class="fa fa-user-o" aria-hidden="true"></i><?php echo $list[$i]['name'] ?>
                          </span>
                        </li>
                        <li>
                          <span class="sound_only">조회 </span>
                          <span class="gall_info_txt gall_view">
                            <i class="fa fa-eye" aria-hidden="true"></i><?php echo $list[$i]['wr_hit'] ?>
                          </span>
                        </li>
                      </ul>
                      <div class="gall_info_date">
                        <span class="sound_only">작성일 </span>
                        <span class="gall_info_txt gall_date">
                          <?php echo date("Y.m.d", strtotime($list[$i]['wr_datetime'])) ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php } ?>
              <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
            </ul>
          </div>
          
          <!-- 페이지 -->
          <?php echo $write_pages; ?>
          <!-- 페이지 -->
          
          <?php if ($list_href || $is_checkbox || $write_href) { ?>
          <div class="bo_fx">
            <div class="bo_fx_wrap">
              <?php if ($list_href || $write_href) { ?>
              <ul class="btn_bo_user">
                <?php if ($is_checkbox) { ?>
                <li>
                  <button type="submit" name="btn_submit" class="bo_btn2" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button>
                </li>
                <li>
                  <button type="submit" name="btn_submit" class="bo_btn2" value="선택복사" onclick="document.pressed=this.value">선택복사</button>
                </li>
                <li>
                  <button type="submit" name="btn_submit" class="bo_btn2" value="선택이동" onclick="document.pressed=this.value">선택이동</button>
                </li>
                <?php } ?>
                <?php if ($write_href) { ?>
                <li>
                  <a href="<?php echo $write_href ?>" class="bo_btn1">글쓰기</a>
                </li>
                <?php } ?>
              </ul>	
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        </form>
      </div>
      <!-- } 게시판 목록 끝 -->

    </div>
  </div>
  <!-- } sub contents -->
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>