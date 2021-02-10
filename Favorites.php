<?php
/*
Template Name:　お気に入りリスト
*/
?>
<!-- /*echo '<li class="cf">'.'<div class="thum-box">'.<a href=the_permalink()>.''.get_the_post_thumbnail($favorite, 'thumbnail').''.'<div class="txt">'.'<div class="in">'.'<p class="tit">'.get_the_title($favorite).'</p>' . 
			'<div class="ac-cont">'.'<span class="category-area">'.''.get_the_category($favorite).''.'</span>'.'<span class="at">'.''.get_the_author($favorite).''.'</span>'.'</div>'.'</a>'.'</div>'.'</li>';*/-->

<?php get_header(); ?>
<div class="main pages-main"> <?php echo breadcrumb_func(); ?>
  <?php $favorites = get_user_favorites(); ?>
  <?php if (isset($favorites) && !empty($favorites)): ?>
  <h2>お気に入りの記事一覧</h2>
  <div class="cont cont2">
    <ul>
      <?php  foreach ($favorites as $favorite) : setup_postdata($favorite);?>
      <?php $thumb = get_the_post_thumbnail( $post_id, 'thum' );?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_the_permalink($favorite); ?>"> 
          <!--画像を追加--> 
          <?php echo get_the_post_thumbnail($favorite, 'thum'); ?>
          <div class="txt">
            <div class="in">
              <p class="tit"><?php echo get_the_title($favorite); ?></p>
              <div class="ac-cont"> <span class="category-area <?php $cat = get_the_category($favorite); $cat = $cat[0]; { echo $cat->slug; } ?>">
               
                   <?php //子カテコリーのみ表示
                  $cats = get_the_category($favorite);
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->cat_name;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>
                </span> <span class="at">
                <?php the_author($favorite); ?>
                </span> </div>
              <!--./ac-cont--> 
            </div>
            <!--./ in--> 
          </div>
          <!-- ./ txt--> 
          </a> </div>
        <!-- ./thum-box--> 
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <!-- ./cont-->
  <?php else: ?>
    <!-- お気に入り記事がない時-->
  <h2 class="tc">お気に入り記事がありません</h2>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
</div>
<!--main end-->

<?php get_footer(); ?>
