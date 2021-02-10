


<?php get_header(); ?>
    

	<div class="main main-aut">
        
         <?php breadcrumb(); ?>
        
        <div class="author-wra">
            
            <?php if ( wp_is_mobile() ) : ?>
            
            
                <h1><?php the_author_meta('name'); ?></h1>
            
                <p class="katagaki"><?php the_author_meta('katagaki'); ?></p>
            
                <?php  $author_id = get_the_author_meta( 'ID' );  ?>  
            
                <div class="p-wra"><img src="<?php the_field('photo','user_' . $author_id ); ?>" alt="先生写真"></div>
            
                <p class="shoukai"><?php the_author_meta('s_txt'); ?></p>
            
  
            <?php else: ?>
            
            <div class="a-cont cf">
                 <?php  $author_id = get_the_author_meta( 'ID' );  ?>  
            
                  <div class="p-wra"><img src="<?php the_field('photo','user_' . $author_id ); ?>" alt="先生写真"></div>
                
                <div class="p-left">
                
                       <h1><?php the_author_meta('name'); ?><span class="katagaki"><?php the_author_meta('katagaki'); ?></span></h1>
            
                <p class="shoukai"><?php the_author_meta('s_txt'); ?></p>
                
                </div>
            
            </div>
            
                
 
            <?php endif; ?>
        
            
            
            <dl>
                <dt>ブログ・SNS</dt>
                <dd> <?php $aID = get_the_author_meta('ID'); ?>
<?php if(get_field('bs', 'user_' . $aID)): ?>
<?php while(the_repeater_field('bs', 'user_' . $aID)): ?>
<p><a href="<?php the_sub_field('bs_url', 'user_' . $aID); ?>" target="_blank"><?php the_sub_field('bs_t', 'user_' . $aID); ?></a></p>
<?php endwhile; endif; ?></dd>
                
            </dl>
            
            <dl>
                <dt>経歴</dt>
                <dd>
                
                <?php $aID = get_the_author_meta('ID'); ?>
<?php if(get_field('career', 'user_' . $aID)): ?>
<?php while(the_repeater_field('career', 'user_' . $aID)): ?>
<p><span><?php the_sub_field('career_y', 'user_' . $aID); ?>年</span><?php the_sub_field('career_c', 'user_' . $aID); ?></p>
<?php endwhile; endif; ?>
                
                </dd>
            </dl>
            
            <dl>
                <dt>資格</dt>
                <dd>
                
                <?php $aID = get_the_author_meta('ID'); ?>
<?php if(get_field('ls', 'user_' . $aID)): ?>
<?php while(the_repeater_field('ls', 'user_' . $aID)): ?>
<p><span><?php the_sub_field('ls_y', 'user_' . $aID); ?>年</span><?php the_sub_field('ls_n', 'user_' . $aID); ?></p>
<?php endwhile; endif; ?>
                
                </dd>
            </dl>
            
            <dl>
                <dt>対応可能施術</dt>
                <dd><?php the_field('select_c', 'user_' . $aID); ?></dd>
            </dl>
            
            
            <dl class="c-cont">
                <dt>勤務病院・クリニック</dt>
                <dd class="cf">
                    <div class="p-wra"><img src="<?php the_field('c_photo','user_' . $author_id ); ?>" alt="クリニックサムネイル"></div>
                    <div class="c-dis"><p class="c-name"><?php the_author_meta('clinic_name'); ?></p>
                    <p><?php the_author_meta('c_address'); ?></p></div>
                </dd>
            </dl>
            
            
            
              <h2><?php the_author(); ?>先生の記事一覧</h2>
            
             
  		<div class="cont cont2 related">
                 <ul>
                     <?php if(have_posts()): while(have_posts()): the_post(); ?>
                  <li class="cf">

                                  <div class="thum-box">
                                     <a href="<?php the_permalink(); ?>">
                                         <!--画像を追加-->
                                    <?php if( has_post_thumbnail() ): ?>
                                    <?php the_post_thumbnail('thum'); ?>

                                     <?php else: ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="240px" width="341px" alt="no-img"/>
                                     <?php endif; ?>

                                     <div class="txt">
                                 <div class="in">
                                     <p class="tit"><?php the_title(); ?></p>
                                 
                                 
                                    <div class="ac-cont">
                                        <span class="category-area <?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->slug; } ?>">
                                          <?php $postcat=get_the_category(); echo $postcat[0]->name; ?>
                                        </span>

                                        <span class="at"><?php the_author(); ?></span>

                                    </div>
                                  </div>
                            </div>
                                    </a>
                                </div>


                                </li>
                     
                <?php endwhile; endif; ?>
                </ul>
            
            </div>
            
           <!-- <p class="readme"><a href="<?php echo get_post_type_archive_link('admin'); ?>">もっと見る</a></p>-->
	   　
            
            
        
        </div>
        
	
	</div><!-- main end -->
    
    
 <?php get_footer(); ?>