<?php
include_once('./_common.php');
include '/home/wespec/www/chi/include/menus.php';

function sub_top($sb_menus, $sb_id, $pg_id){
  foreach ($sb_menus as $menu) {
    if ($menu['id'] === $sb_id) {
?>
<section class="sb_top <?php echo $sb_id.'_top';?>">
  <h2 class="sound_only"><?php echo $menu['name']; ?> 페이지</h2>
  <div class="container">
    <div class="wrapper">
      <div class="sb_top_ct">
        <p class="sb_title"><?php echo $menu['name']; ?></p>
        <div class="sb_2menus">
          <ul class="sb_2menus_wrap">
          <?php 
          foreach ($menu['sb_2menus'] as $menu2) {
          ?>
            <li class="<?php echo $menu2['id'] == $pg_id ? 'act':'';?>">
              <a href="<?php echo $menu2['link']; ?>"><?php echo $menu2['name']; ?></a>
            </li>
          <?php 
          } 
          ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
      break;
    }
  }
} 
?>