<?php get_header(); ?>
<div class="main single-clinic"> <?php echo breadcrumb_func(); ?>
  <div class="cont">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <div class="header-img"><img src="<?php the_field('clinic_img'); ?>" alt="<?php the_field('clinc_name'); ?>"></div>
    <h1>
      <?php the_field('clinc_name'); ?>
    </h1>
    <p class="btn-wra"><a href="<?php the_field('clinic_url'); ?>" class="btn" target="_blank">詳しくはこちら</a></p>
    <?php endwhile; endif; ?>
  </div>
</div>
<!-- main end -->

<?php get_footer(); ?>
