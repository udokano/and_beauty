
<div class="sidebar">
  <div class="side-in">
    <div class="banner"> <?php echo get_post_meta(791 , 'side_ad1' ,true); ?> </div>
    <ul class="cat-list">
      <?php wp_list_categories('title_li=&depth=1'); ?>
    </ul>
    <div class="banner"> <?php echo get_post_meta(791 , 'side_ad2' ,true); ?> </div>
    <div class="side-list cf ninnki">
      <h3>人気記事</h3>
      <?php
      // views post metaで記事のPV情報を取得する
      setPostViews( get_the_ID() );

      // ループ開始
      query_posts( 'meta_key=post_views_count&orderby=meta_value_num&posts_per_page=5&order=DESC' );
      while ( have_posts() ): the_post();
      ?>
      <div class="list cf"> <a href="<?php echo get_permalink(); ?>"> 
        <!-- サムネイルの表示 -->
        <div class="img-wrap"> 
          
          <!--画像を追加-->
          <?php if( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail('ninki-thum'); ?>
          　
          <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="60px" width="80px"  alt="no-img"/> 　
          <?php endif; ?>
        </div>
        
        <!-- タイトルの表示 -->
        <div class="txt-wrap">
          <p>
            <?php the_title(); ?>
          </p>
        </div>
        </a> </div>
      <?php endwhile; ?>
    </div>
    <div class="side-list pickup">
      <h3>PICK UP</h3>
      <?php
      $args = array(
        'posts_per_page' => 5, //5件表示する
        'orderby' => 'date', //日付順
        'order' => 'DESC', //降順
        'meta_key' => 'pickup', //カスタムフィールドのキー
        'meta_value' => 'on', //カスタムフィールドの値
        'meta_compare' => 'LIKE' //'meta_value'のテスト演算子
      );
      $my_query = new WP_Query( $args );
      if ( $my_query->have_posts() ): while ( $my_query->have_posts() ): $my_query->the_post();
      ?>
      <div class="list cf"> <a href="<?php echo get_permalink(); ?>"> 
        <!-- サムネイルの表示 -->
        <div class="img-wrap"> 
          
          <!--画像を追加-->
          <?php if( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail('ninki-thum'); ?>
          　
          <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="60px" width="80px"  alt="no-img"/> 　
          <?php endif; ?>
        </div>
        
        <!-- タイトルの表示 -->
        <div class="txt-wrap">
          <p>
            <?php the_title(); ?>
          </p>
        </div>
        </a> </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <div class="banner"> <?php echo get_post_meta(791 , 'side_ad3' ,true); ?> </div>
    <div class="side-list f-list">
      <h3>お気に入りリスト</h3>
      <?php $favorites = get_user_favorites(); ?>
      <?php
      if ( $favorites ): // This is important: if an empty array is passed into the WP_Query parameters, all posts will be returned
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; // If you want to include pagination
      $favorites_query = new WP_Query( array(
        'post_type' => 'post', // If you have multiple post types, pass an array
        'posts_per_page' => 5,
        'ignore_sticky_posts' => true,
        'post__in' => $favorites,
        'orderby' => 'ASC',
        'paged' => $paged
      ) );
      ?>
      <?php if ($favorites_query->have_posts()) : while ($favorites_query->have_posts()) : $favorites_query->the_post(); ?>
      <div class="list cf"> <a href="<?php echo get_the_permalink($favorite); ?>">
        <div class="img-wrap"> <?php echo get_the_post_thumbnail($favorite, 'thum'); ?> </div>
        
        <!-- タイトルの表示 -->
        <div class="txt-wrap">
          <p> <?php echo get_the_title($favorite); ?> </p>
        </div>
        </a> </div>
      <?php endwhile; ?>
      <?php
      endif;
      wp_reset_postdata();
      ?>
      <?php
      else :
        // No Favorites
        echo '<p class="text-center">お気に入りがありません。</p>';
      endif;
      ?>
      <p class="readme"><a href="<?php echo home_url( '/' ); ?>flist">もっと見る</a></p>
    </div>
    
    <!-- <?php 
					
					$favorites = get_user_favorites() ?>
                       
                       <?php $thumb = get_the_post_thumbnail( $post_id, 'thum' );
  echo $thumb; ?>
    <?php if (isset($favorites) && !empty($favorites)) :setup_postdata($favorites);
      foreach ($favorites as $favorite) :
        echo '<div class="list cf">'.'<div class="img-wrap">'. ''.get_the_post_thumbnail($favorite, 'thumbnail').''.'</div>' .'<div class="txt-wrap">'.get_the_title($favorite).'</div>' . '</div>';
      endforeach;
    else :
      // No Favorites
      echo '<p class="text-center">お気に入りがありません。</p>';
    endif; ?>--> 
    
  </div>
</div>
<!--sidebar  end--> 

