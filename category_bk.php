<?php get_header(); ?>
<div class="main pages-main"> <?php echo breadcrumb_func(); ?>
  <?php
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
  $catimg = get_field( 'thum', $post_id );
  $img = wp_get_attachment_image_src( $catimg, 'full' );
  if ( !empty( $img ) ) {
    ?>
  <div class="cont">
    <h2>
      <?php single_cat_title(); ?>
    </h2>
    <div class="in cf">
      <div class="img-box"> 
        
        <!--画像-->
        <?php
        $cat_id = get_queried_object()->cat_ID;
        $post_id = 'category_' . $cat_id;
        $catimg = get_field( 'thum', $post_id );
        $img = wp_get_attachment_image_src( $catimg, 'full' );
        ?>
        <span><img src="<?php echo $img[0]; ?>" alt="<?php single_cat_title(); ?>" /></span> </div>
      <div class="txt-cont">
        <div class="dis"> 
          <!--文字-->
          <?php
          $cat_id = get_queried_object()->cat_ID;
          $post_id = 'category_' . $cat_id;
          ?>
          <?php echo category_description(); ?> </div>
        <!--リピ-->
        <?php
        $cat_id = get_queried_object()->cat_ID;
        $post_id = 'category_' . $cat_id;
        $rows = get_field( 'price', $post_id );
        if ( $rows ) {
          echo '<div class="pri">';
          foreach ( $rows as $row ) {
            echo '<div class="pri-list">' . '<span class="menu_name">' . $row[ 'menu_name' ] . '</span>' . '<span class="menu_valu">' . $row[ 'menu_valu' ] . "円" . '</span>' . '</div>';
            //echo '<span>' . $row['menu_valu'] . '</span>'."円";
          }
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<!--一旦mein end-->

<?php
$txt = get_field( 'btn_url', $post_id );
if ( !empty( $txt ) ) {
  ?>
<div class="bg-gray">
  <div class="cont cont3">
    <h2>
      <?php single_cat_title(); ?>
      相談可能医院</h2>
    <ul class="slider cf">
      <?php
      $categoryvariable = $cat;
      $args = array(
        'post_type' => 'clinic', //投稿を表示
        'cat' => $categoryvariable,
        'posts_per_page' => 10
      );
      query_posts( $args );
      ?>
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <li>
        <p class="img-box">
          <?php
          $image = get_field( 'clinic_img' );
          $size = 'thum'; // (thumbnail, medium, large, full or custom size)

          if ( $image ) {
            echo wp_get_attachment_image( $image, $size );
          }
          ?>
        </p>
        <span class="shopn">
        <?php the_field('clinc_name'); ?>
        </span>
        <div class="cbtn-cont">
          <div class="cbtns tel"><a href="<?php the_field('tel_url'); ?>" target="_blank">電話する</a></div>
          <div class="cbtns rs"><a href="<?php the_field('rs_url'); ?>" target="_blank">Web来院予約</a></div>
        </div>
      </li>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
    </ul>
    <p class="btn-wra"><a href="<?php the_field('btn_url',$post_id); ?>" class="btn" target="_blank">詳しく見る</a></p>
  </div>
</div>
<!--bg-gray end-->

<?php } ?>
<div class="main list-cont">
  <div class="cont cont2">
    <h2>
      <?php single_cat_title(); ?>
      コラム</h2>
    <ul>
        
       <!--     <div style="display: none;">
        
        

      <?php
      $post_id = get_post_meta( 791, 'ac_link1', true );
      $get_post = get_post( $post_id );
      ?>
      <?php if($post_id):  入力がある場合  ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_permalink($post_objects->ID); // ID指定でリンクを取得 ?>"> 
          <!--画像を追加--> 
          <?php echo get_the_post_thumbnail($get_post, 'thum')?>
          <div class="txt">
            <div class="in">
              <p class="tit"> <?php echo esc_html($get_post->post_title); ?> </p>
              <div class="ac-cont"> <span class="category-area">
                <?php $postcat=get_the_category($post_id); echo $postcat[0]->name; ?>
                </span>
                <?php $author_id = get_the_author_meta( 'ID' );  ?>
                <span class="at"> <?php echo get_the_author($get_post,$author_id); ?> </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endif; ?>
      <?php
      $post_id = get_post_meta( 791, 'ac_link2', true );
      $get_post = get_post( $post_id );
      ?>
      <?php if($post_id):  入力がある場合  ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_permalink($post_objects->ID); // ID指定でリンクを取得 ?>"> 
          <!--画像を追加--> 
          <?php echo get_the_post_thumbnail($get_post, 'thum')?>
          <div class="txt">
            <div class="in">
              <p class="tit"> <?php echo esc_html($get_post->post_title); ?> </p>
              <div class="ac-cont"> <span class="category-area <?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->slug; } ?>">
                <?php $postcat=get_the_category($post_id); echo $postcat[0]->name; ?>
                </span> <span class="at">
                <?php the_author($get_post); ?>
                </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endif; ?>
      <?php
      $post_id = get_post_meta( 791, 'ac_link3', true );
      $get_post = get_post( $post_id );
      ?>
      <?php if($post_id):  入力がある場合  ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php echo get_permalink($post_objects->ID); // ID指定でリンクを取得 ?>"> 
          <!--画像を追加--> 
          <?php echo get_the_post_thumbnail($get_post, 'thum')?>
          <div class="txt">
            <div class="in">
              <p class="tit"> <?php echo esc_html($get_post->post_title); ?> </p>
              <div class="ac-cont"> <span class="category-area <?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->slug; } ?>">
                <?php $postcat=get_the_category($post_id); echo $postcat[0]->name; ?>
                </span> <span class="at">
                <?php the_author($get_post); ?>
                </span> </div>
            </div>
          </div>
          </a> </div>
      </li>
      <?php endif; ?>
            
            
           
       </div> -->
        
        
        
         
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
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
                <?php $postcat=get_the_category(); echo $postcat[0]->name; ?>
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
  <div>
    <?php
    // Find connected weeks
    $connected = new WP_Query( array(
      'connected_type' => 'posts_to_pages', // the name of your connection type
      'connected_items' => get_queried_object(),
      'nopaging' => true,
    ) );

    // Display connected weeks
    if ( $connected->have_posts() ): ?>
    <h3>Weeks in this Workshop</h3>
    <ul>
      <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
      <li><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a></li>
      <?php endwhile; ?>
    </ul>
    <?php
    // Prevent weirdness
    wp_reset_postdata();
    endif;
    ?>
    </ul>
  </div>
</div>
</div>
<?php get_footer(); ?>
