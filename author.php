<?php get_header(); ?>
<div class="main main-aut pages-main"> <?php echo breadcrumb_func(); ?>
  <div class="author-wra" itemscope="itemscope" itemtype="http://schema.org/Person">
    <?php if ( wp_is_mobile() ) : ?>
    <h1 itemprop="name">
      <?php the_author(); ?>
    </h1>
    <p class="katagaki" itemprop="award">
      <?php the_author_meta('katagaki'); ?>
    </p>
    <?php  $author_id = get_the_author_meta( 'ID' );  ?>
    <div class="p-wra"><?php echo get_avatar( $author_id ,300 ); ?></div>
    <p class="shoukai">
      <?php the_author_meta('user_description'); ?>
    </p>
    <?php else: ?>
    <div class="a-cont cf">
      <?php  $author_id = get_the_author_meta( 'ID' );?>
      <div class="p-wra" itemprop="image"><?php echo get_avatar($author_id , 300); ?></div>
      <div class="p-left">
        <h1 itemprop="name">
          <?php the_author(); ?>
          <span class="katagaki" itemprop="award">
          <?php the_author_meta('katagaki'); ?>
          </span></h1>
        <p class="shoukai">
          <?php the_author_meta('user_description'); ?>
        </p>
      </div>
    </div>
    <?php endif; ?>
    
    <!--<?php $aID = get_the_author_meta('ID'); ?>            
<?php if(get_field('bs', 'user_' . $aID)): ?>
                    
            <dl>
                <dt>ブログ・SNS</dt>
                <dd class="rf"> 
                    <?php $aID = get_the_author_meta('ID'); ?>
                    <?php while(the_repeater_field('bs', 'user_' . $aID)): ?>
                    <p><a href="<?php the_sub_field('bs_url', 'user_' . $aID); ?>" target="_blank"><?php the_sub_field('bs_t', 'user_' . $aID); ?></a></p>
                    <?php endwhile; ?>
                </dd>
                    
        　　</dl>
                    
<?php else: ?>        
        
<?php endif; ?>-->
    
    <?php $aID = get_the_author_meta('ID'); ?>
    <?php

    $sns = get_field( 'bs', 'user_' . $aID ) . get_field( 'bs2', 'user_' . $aID ) . get_field( 'bs3', 'user_' . $aID ) . get_field( 'bs4', 'user_' . $aID );
    ?>
    <?php if($sns): ?>
    <dl>
      <dt>ブログ・SNS</dt>
      <?php $aID = get_the_author_meta('ID'); ?>
      <?php if( have_rows('bs','user_' . $aID)): ?>
      <dd class="rf">
        <?php while ( have_rows('bs','user_' . $aID) ) : the_row(); ?>
        <p><a href="<?php the_sub_field('bs_url','user_' . $aID); ?>" target="_blank" class="icon insta">
          <?php the_sub_field('bs_t','user_' . $aID); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
      <?php $aID = get_the_author_meta('ID'); ?>
      <?php if( have_rows('bs2','user_' . $aID) ): ?>
      <dd class="rf">
        <?php while(the_repeater_field('bs2','user_' . $aID)): ?>
        <p><a href="<?php the_sub_field('bs_url2','user_' . $aID); ?>" target="_blank" class="icon twitter">
          <?php the_sub_field('bs_t2','user_' . $aID); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
      <?php $aID = get_the_author_meta('ID'); ?>
      <?php if( have_rows('bs3','user_' . $aID) ): ?>
      <dd class="rf">
        <?php while(the_repeater_field('bs3','user_' . $aID)): ?>
        <p><a href="<?php the_sub_field('bs_url3','user_' . $aID); ?>" target="_blank" class="icon facebook">
          <?php the_sub_field('bs_t3','user_' . $aID); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
      <?php $aID = get_the_author_meta('ID'); ?>
      <?php if( have_rows('bs4','user_' . $aID) ): ?>
      <dd class="rf">
        <?php while(the_repeater_field('bs4','user_' . $aID)): ?>
        <p><a href="<?php the_sub_field('bs_url4','user_' . $aID); ?>" target="_blank" class="">
          <?php the_sub_field('bs_t4','user_' . $aID); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php $aID = get_the_author_meta('ID'); ?>
    <?php if(get_field('career', 'user_' . $aID)): ?>
    <dl>
      <dt>経歴</dt>
      <dd class="rf">
        <?php $aID = get_the_author_meta('ID'); ?>
        <?php while(the_repeater_field('career', 'user_' . $aID)): ?>
        <p><span>
          <?php the_sub_field('career_y', 'user_' . $aID); ?>
          年</span>
          <?php the_sub_field('career_c', 'user_' . $aID); ?>
        </p>
        <?php endwhile;?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php $aID = get_the_author_meta('ID'); ?>
    <?php if(get_field('ls', 'user_' . $aID)): ?>
    <dl>
      <dt>資格</dt>
      　
      <dd class="rf">
        <?php while(the_repeater_field('ls', 'user_' . $aID)): ?>
        <p>
          <?php the_sub_field('ls_n', 'user_' . $aID); ?>
        </p>
        <?php endwhile; ?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php $aID = get_the_author_meta('ID'); ?>
    <?php if(get_field('sj', 'user_' . $aID)): ?>
    <dl>
      <dt>所属</dt>
      <dd class="rf">
        <?php while(the_repeater_field('sj', 'user_' . $aID)): ?>
        <p>
          <?php the_sub_field('sj_n', 'user_' . $aID); ?>
        </p>
        <?php endwhile; ?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php $aID =  get_the_author_meta('ID');?>
    <?php if(get_field('select_c', 'user_' . $aID)): ?>
    <dl>
      <dt>対応可能施術</dt>
      <dd>
        <?php the_field('select_c', 'user_' . $aID)?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif;?>
  </div>
</div>
<!--一旦main end-->

<?php /*?>
<?php
$args = array(
  'connected_type' => 'multiple_authors',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
  'suppress_filters' => false
);
$connected_posts = get_posts( $args );
?>
<?php if (! $connected_posts){} else { ?>
<?php }?><?php */?>
<?php
// Find connected weeks
$connected = new WP_Query( array(
  'connected_type' => 'multiple_authors',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );
if ( $connected->have_posts() ): ?>
<div class="bg-gray">
  <div class="cont cont3">
    <h2>勤務病院・クリニック</h2>
    <ul class="slider cf">
      <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
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
    </ul>
  </div>
</div>
<?php else: ?>
<?php endif;?>
<?php wp_reset_postdata(); ?>
<div class="main single-rt list-cont">
  <h2>
    <?php the_author(); ?>
    先生の記事一覧</h2>
  <div class="cont cont2 related">
    <ul>
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
  
  <!-- <p class="readme"><a href="<?php echo get_post_type_archive_link('admin'); ?>">もっと見る</a></p>--> 
  　 </div>
<!-- main end -->

<?php get_footer(); ?>
