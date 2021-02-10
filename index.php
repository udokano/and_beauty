<?php get_header(); ?>
<div class="main cf">
  <div class="top-main">
    <div class="cont">
      <ul>
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <li class="cf">
          <div class="thum-box" style="background-color: #666;">
            <div class="l-heart"> <?php echo get_favorites_button(get_the_ID());  ?> </div>
            <a href="<?php the_permalink(); ?>?cat=<?php $cats = get_the_category();
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->slug;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>"> 
            <!--画像を追加-->
            <?php if( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail('full'); ?>
            <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="240px" width="341px" alt="no-img"/>
            <?php endif; ?>
            <div class="txt">
              <div class="in">
                <p class="tit">
                  <?php the_title(); ?>
                </p>
                <div class="ac-cont"> <span class="category-area">
                  <?php //子カテコリーのみ表示
                  $cats = get_the_category();
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->cat_name;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>
                  </span> <span class="at">
                  <?php the_author(); ?>
                  </span> </div>
              </div>
            </div>
            </a> </div>
        </li>
        <?php endwhile; endif; ?>
      </ul>
    </div>
    
    <!--ページネーション-->
    <?php
    if ( function_exists( 'responsive_pagination' ) ) {
      responsive_pagination( $additional_loop->max_num_pages );
    }
    ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<div class="dc-list">
  <h2>医師紹介</h2>
  <ul class="authors dc-slide" id="dc-slide">
    <?php
    $args = array(
      'post_type' => 'rt',
      'order' => 'ASC',
    );
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ): $the_query->the_post();
    ?>
    <li>
      <div class="au-p"><a href="<?php the_permalink(); ?>"> <span class="au-thum"><img src="<?php the_field('photo'); ?>" alt="ユーザー写真"></span> <span class="au-name">
        <?php the_field('name'); ?>
        </span></a> </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </li>
  </ul>
</div>
<?php get_footer(); ?>
