<?php get_header(); ?>
<div class="main single-rt pages-main"> <?php echo breadcrumb_func(); ?>
  <div class="author-wra">
    <?php if(have_posts()): the_post(); ?>
    <?php if ( wp_is_mobile() ) : ?>
    <h1>
      <?php the_title(); ?>
    </h1>
    <p class="katagaki">
      <?php the_field('katagaki'); ?>
    </p>
    <div class="p-wra"><img src="<?php the_field('photo'); ?>" alt=""></div>
    <div class="shoukai">
      <?php the_content(); ?>
    </div>
    <?php else: ?>
    <div class="a-cont cf">
      <?php
      $author_id = get_the_author_meta( 'ID' );

      ?>
      <div class="p-wra"><img src="<?php the_field('photo'); ?>" alt=""></div>
      <div class="p-left">
        <h1>
          <?php the_title(); ?>
          <span class="katagaki">
          <?php the_field('katagaki'); ?>
          </span></h1>
        <div class="shoukai">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    <?php

    $sns = get_field( 'bs' ) . get_field( 'bs2' ) . get_field( 'bs3' ) . get_field( 'bs4' );
    ?>
    <?php if($sns): ?>
    <dl>
      <dt>ブログ・SNS</dt>
      <?php if( have_rows('bs') ): ?>
      <dd class="rf">
        <?php while ( have_rows('bs') ) : the_row(); ?>
        <p><a href="<?php the_sub_field('bs_url'); ?>" target="_blank" class="icon insta">
          <?php the_sub_field('bs_t'); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
      <?php if( have_rows('bs2') ): ?>
      <dd class="rf">
        <?php while(the_repeater_field('bs2')): ?>
        <p><a href="<?php the_sub_field('bs_url2'); ?>" target="_blank" class="icon twitter">
          <?php the_sub_field('bs_t2'); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
      <?php if( have_rows('bs3') ): ?>
      <dd class="rf">
        <?php while(the_repeater_field('bs3')): ?>
        <p><a href="<?php the_sub_field('bs_url3'); ?>" target="_blank" class="icon facebook">
          <?php the_sub_field('bs_t3'); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
      <?php if( have_rows('bs4') ): ?>
      <dd class="rf">
        <?php while(the_repeater_field('bs4')): ?>
        <p><a href="<?php the_sub_field('bs_url4'); ?>" target="_blank" class="">
          <?php the_sub_field('bs_t4'); ?>
          </a></p>
        <?php endwhile; ?>
      </dd>
      <?php else: ?>
      <?php endif; ?>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php if(get_field('career')): ?>
    <dl>
      <dt>経歴</dt>
      <dd class="rf">
        <?php while(the_repeater_field('career')): ?>
        <p><span>
          <?php the_sub_field('career_y'); ?>
          年</span>
          <?php the_sub_field('career_c'); ?>
        </p>
        <?php endwhile;?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php if(get_field('ls')): ?>
    <dl>
      <dt>資格</dt>
      <dd class="rf">
        <?php while(the_repeater_field('ls')): ?>
        <p>
          <?php the_sub_field('ls_n'); ?>
        </p>
        <?php endwhile;?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php if(get_field('sj')): ?>
    <dl>
      <dt>所属</dt>
      <dd class="rf">
        <?php while(the_repeater_field('sj')): ?>
        <p>
          <?php the_sub_field('sj_n'); ?>
        </p>
        <?php endwhile; ?>
      </dd>
    </dl>
    <?php else: ?>
    <?php endif; ?>
    <?php $value = get_post_meta($post->ID, 'select_c', true);?>
    <?php if(empty($value)):?>
    <?php else:?>
    <dl>
      <dt>対応可能施術</dt>
      <dd>
        <?php the_field('select_c')?>
      </dd>
    </dl>
    <?php endif;?>
  </div>
</div>
<!--一旦main end-->

<?php
// Find connected weeks
$connected = new WP_Query( array(
  'connected_type' => 'posts_to_post2',
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
<?php
// Find connected weeks
$connected = new WP_Query( array(
  'connected_type' => 'posts_to_pages',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );
if ( $connected->have_posts() ): ?>
<div class="main single-rt list-cont">
  <div class="cont cont2">
    <h2>
      <?php the_title(); ?>
      先生の記事一覧</h2>
    <ul>
      
      <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
      <li class="cf">
        <div class="thum-box"> <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('thum'); ?>
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
          <?php endwhile; ?>
      
    </ul>
  </div>
</div>
<?php else: ?>
<?php endif;?>
<?php wp_reset_postdata(); ?>
<!--main  end-->

<?php get_footer(); ?>
