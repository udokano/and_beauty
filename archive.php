<?php get_header(); ?>

<body <?php body_class(); ?>>
<div class="wrap">
<div class="main main-aut">
  <?php breadcrumb(); ?>
  <div class="cont">
    <ul>
      <?php query_posts('post_type=post&paged='.$paged); ?>
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php the_permalink(); ?>"> 
          <!--画像を追加-->
          <?php if( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail('single_pc'); ?>
          <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="240px" width="341px" alt="no-img"/>
          <?php endif; ?>
          <div class="txt">
            <div class="in">
              <p class="tit">
                <?php the_title(); ?>
              </p>
              <div class="ac-cont"> <span class="category-area <?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->slug; } ?>">
                <?php $postcat=get_the_category(); echo $postcat[0]->name; ?>
                </span> <span class="at">
                <?php the_author(); ?>
                </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endwhile; endif; ?>
      <!--ループ終了-->
      
    </ul>
    
    <!--ページネーション追加-->
    <div class="pagination"> 
      <!--?php echo paginate_links( array(
          'type' => 'list',
          'mid_size' => '2',
          'prev_text' => '&laquo;',
          'next_text' => '&raquo;'
          ) ); ?-->
      <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
    </div>
    <?php wp_reset_query(); ?>
  </div>
</div>
<!-- main end -->
<?php get_footer(); ?>
