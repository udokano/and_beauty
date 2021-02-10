<?php get_header(); ?>
<div class="main pages-main"> <?php echo breadcrumb_func(); ?>
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
  <div class="wp-cont">
    <div class="th-cont"> <span class="time">
      <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
        <?php the_time('Y年m月d日'); ?>
      </time>
      </span>
      <h1>
        <?php the_title(); ?>
      </h1>
    </div>
    <?php if(get_field("header_img")): ?>
    <div class="header-img"><img src="<?php the_field('header_img'); ?>" alt="ヘッダー画像"></div>
    <?php endif; ?>
    <div class="category-area">
      <?php
      $cats = get_the_category();
      echo "<ul>";
      foreach ( $cats as $cat ):
        if ( $cat->parent ) {
          echo "<li><a href='" . get_category_link( $cat->cat_ID ) . "'>" . $cat->cat_name . "</a></li>";
        }
      endforeach;
      echo "</ul>";
      ?>
    </div>
    <div class="wp-in">
      <?php remove_filter('the_content', 'wpautop'); ?>
      <?php the_content(); ?>
    </div>
    <div class="category-area bottom">
      <?php
      $cats = get_the_category();
      echo "<ul>";
      foreach ( $cats as $cat ):
        if ( $cat->parent ) {
          echo "<li><a href='" . get_category_link( $cat->cat_ID ) . "'>" . $cat->cat_name . "</a></li>";
        }
      endforeach;
      echo "</ul>";
      ?>
    </div>
  </div>
  <?php endwhile; endif; ?>
  <div class="contena">
    <div class="au-cont"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
      <dl class="au-area cf">
        <dt>
          <div class="p-wra"> <?php echo get_avatar( get_the_author_meta( 'ID' ),512,500,500 ); ?> </div>
        </dt>
        <dd>
          <h4 class="au-t">この記事を書いた人</h4>
          <p class="doctor-name">
            <?php the_author(); ?>
          </p>
          <?php $author_id = get_the_author_meta( 'ID' );  ?>
          <div class="shoukai"> 
            <!-- <?php the_author_meta('user_description'); ?>-->
            <?php
            // Find connected weeks
            $connected = new WP_Query( array(
              'connected_type' => 'posts_to_post3',
              'connected_items' => get_queried_object(),
              'nopaging' => true,
            ) );
            if ( $connected->have_posts() ): ?>
            <p class="kinmusaki">勤務病院・クリニック</p>
            <ul class="clinic">
              <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
              <li> <span class="shopn">
                <?php the_title(); ?>
                </span> </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <!-- ./shoukai -->
          <?php else: ?>
          <?php endif;?>
        </dd>
      </dl>
      <!-- ./ au-area--> 
      </a> </div>
    <!--./au-cont--> 
    <!--    <p class="banner_wrap"> <?php echo get_post_meta(791 , 'dt_ad' ,true); ?></p>-->
    
    <div class="sns-area">
      <ul class="sns-items flex al-cent">
        <li class="heart icons"><?php echo get_favorites_button(get_the_ID());  ?></li>
        <li class="tw icons"> <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_new"><i class="fa fa-twitter"></i></a> </li>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <li class="line icons"> <a href="https://timeline.line.me/social-plugin/share?url=[http://souki-kai.or.jp/blog/]" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/line_icon.svg" alt="LINEicon"></a> </li>
        <li class="fb icons"> <a href="http://www.facebook.com/share.php?u=http://souki-kai.or.jp/blog/" onclick="window.open(encodeURI(decodeURI(this.href)), 'FBwindow', 'width=554, height=470, menubar=no, toolbar=no, scrollbars=yes'); return false;" rel="nofollow"> <img src="<?php echo get_template_directory_uri(); ?>/images/fb_icon.svg" alt="FB_icon"> </a> </li>
      </ul>
    </div>
    <!-- ./sns-cont --> 
  </div>
  <!-- ./contena--> 
</div>
<!-- main end -->

<div class="main list-cont"> 
  
  <!-- 関連記事 -->
  
  <?php
  if ( has_category() ) {
    $cats = get_the_category();
    $catkwds = array();
    foreach ( $cats as $cat ) {
      $catkwds[] = $cat->term_id;
    }
  }
  ?>
  <?php
  $myposts = get_posts( array(
    'post_type' => 'post',
    'posts_per_page' => '5',
    'post__not_in' => array( $post->ID ),
    'category__in' => $catkwds,
    'orderby' => 'rand'
  ) );
  if ( $myposts ): ?>
  <div class="cont cont2 related">
    <h3>関連記事</h3>
    <ul>
      
      <!--   投稿オブジェクト(PR)     -->
      <?php $post_objects = get_field('ac_link1',791); if( $post_objects ): // 投稿オブジェクトの取得 ?>
      <?php
      $post = $post_object;
      setup_postdata( $post );

      ?>
      <!--   投稿オブジェクト(PR) NUM01     -->
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_permalink($post_objects->ID); // ID指定でリンクを取得 ?>"> 
          <!--画像を追加-->
          <?php //アイキャッチ画像の取得
          $thumbnail_id = get_post_thumbnail_id( $post_objects->ID ); // アタッチメントIDの取得
          $image = wp_get_attachment_image_src( $thumbnail_id, 'thum' ); //「thum」サイズのアイキャッチの情報を取得
          $src = $image[ 0 ]; // URL
          $width = $image[ 1 ]; // 横幅
          $height = $image[ 2 ]; // 高さ
          echo '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" />';
          ?>
          <div class="txt">
            <div class="in">
              <p class="tit"> <?php echo get_the_title($post_objects->ID); //タイトルの取得 ?> </p>
              <div class="ac-cont"> <span class="category-area">
                   <?php //子カテコリーのみ表示
                  $cats = get_the_category($post_objects);
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->cat_name;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>
                </span>
                <?php $author_id = get_the_author_meta( 'ID' );  ?>
                <span class="at"> <?php echo get_the_author($post_objects,$author_id); ?> </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endif; ?>
      
      <!--   投稿オブジェクト(PR) NUM02    -->
      <?php $post_objects = get_field('ac_link2',791); if( $post_objects ): // 投稿オブジェクトの取得 ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_permalink($post_objects->ID); // ID指定でリンクを取得 ?>"> 
          <!--画像を追加-->
          <?php //アイキャッチ画像の取得
          $thumbnail_id = get_post_thumbnail_id( $post_objects->ID ); // アタッチメントIDの取得
          $image = wp_get_attachment_image_src( $thumbnail_id, 'thum' ); //「thum」サイズのアイキャッチの情報を取得
          $src = $image[ 0 ]; // URL
          $width = $image[ 1 ]; // 横幅
          $height = $image[ 2 ]; // 高さ
          echo '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" />';
          ?>
          <div class="txt">
            <div class="in">
              <p class="tit"> <?php echo get_the_title($post_objects->ID); //タイトルの取得 ?> </p>
              <div class="ac-cont"> <span class="category-area">
                  <?php //子カテコリーのみ表示
                  $cats = get_the_category($post_objects);
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->cat_name;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>
                </span>
                <?php $author_id = get_the_author_meta( 'ID' );  ?>
                <span class="at"> <?php echo get_the_author($post_objects,$author_id); ?> </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endif; ?>
      
      <!--   投稿オブジェクト(PR) NUM03     -->
      <?php $post_objects = get_field('ac_link3',791); if( $post_objects ): // 投稿オブジェクトの取得 ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_permalink($post_objects->ID); // ID指定でリンクを取得 ?>"> 
          <!--画像を追加-->
          <?php //アイキャッチ画像の取得
          $thumbnail_id = get_post_thumbnail_id( $post_objects->ID ); // アタッチメントIDの取得
          $image = wp_get_attachment_image_src( $thumbnail_id, 'thum' ); //「thum」サイズのアイキャッチの情報を取得
          $src = $image[ 0 ]; // URL
          $width = $image[ 1 ]; // 横幅
          $height = $image[ 2 ]; // 高さ
          echo '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" />';
          ?>
          <div class="txt">
            <div class="in">
              <p class="tit"> <?php echo get_the_title($post_objects->ID); //タイトルの取得 ?> </p>
              <div class="ac-cont"> <span class="category-area">
                  <?php //子カテコリーのみ表示
                  $cats = get_the_category($post_objects);
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->cat_name;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>
                </span>
                <?php $author_id = get_the_author_meta( 'ID' );  ?>
                <span class="at"> <?php echo get_the_author($post_objects,$author_id); ?> </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endif; ?>
      
      <!--   ./投稿オブジェクト(PR)     -->
      
      <?php
      foreach ( $myposts as $post ):
        setup_postdata( $post );
      ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php the_permalink(); ?>"> 
          <!--画像を追加-->
          <?php if( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail('thum'); ?>
          <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="240px" width="341px" alt="no-img"/>
          <?php endif; ?>
          <div class="txt">
            <div class="in">
              <p class="tit">
                <?php the_title(); ?>
              </p>
              <div class="ac-cont"> <span class="category-area <?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->slug; } ?>">
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
      <?php endforeach; ?>
    </ul>
  </div>
  <?php
  wp_reset_postdata();
  endif;
  ?>
  
  <!-- 関連記事ここまで --> 
  
</div>
<!-- main end -->

<?php get_footer(); ?>
