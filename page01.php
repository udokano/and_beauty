<?php
/*
Template Name:　ページ１
*/
 ?>




<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php bloginfo( 'name' ); ?></title>
<meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
   
      <?php wp_head(); ?>
</head>
    
    
    

<body <?php body_class(); ?>>
<div class="wrap">
    <header>
        
        <div class="h-in">
            <h1><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/header_logo.png" alt="創輝会"></a></h1>
        </div>
    
    </header>
        
        
    <div class="main">
            
            
            
            <div class="cont">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
              <h2><?php the_title(); ?>のご案内</h2>
                    <div class="in cf">
                        <div class="img-box">
                            <?php if(get_field('thum')): ?>
                                <img src="<?php the_field('thum'); ?>" alt="<?php the_title(); ?>">
                                <?php else: // サムネイルを持っていないときの処理 ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" alt="image">
                            <?php endif; ?>
                        </div>

                        <div class="txt-cont">
                            <div class="dis"><?php the_content(); ?></div>
                            <?php if(have_rows('price')): ?>
                                <?php while(have_rows('price')): the_row(); ?>
                               <p class="pri"> <?php the_sub_field('menu_name'); ?> <?php the_sub_field('menu_valu'); ?>円</p>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <p class="btn-wra"><a href="<?php the_field('btn_url'); ?>" class="btn" target="_blank">詳しく見る</a></p>
                        </div> 
                    </div>
                <?php endwhile; endif; ?>
            </div>   
            
            <div class="cont cont2">
                <h2><?php the_title(); ?>コラム</h2>
                    <ul>
                        
                        
                    <?php
                        // WP_Queryのパラメータを指定,新着情報5件抜粋
                        $args = array(
                            'category_name' => 'cat1', //ここで抽出するカテゴリーを指定、カテゴリー1のみ抽出
                            'posts_per_page' => 6, 
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                        // WP_Queryクラスのインスタンスを作成
                        $the_query = new WP_Query( $args );

                        // ループ開始
                        while ( $the_query->have_posts() ) :
                            // カスタムクエリの投稿データをセット
                            $the_query->the_post();?>

				
						
                         <li class="cf">
                        
						  <p class="img-box">
                              <a href="<?php the_permalink(); ?>">
                                 <!--画像を追加-->
							<?php if( has_post_thumbnail() ): ?>
							<?php the_post_thumbnail('thum'); ?>

							　<?php else: ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" height="240px" width="341px" alt="no-img"/>
							　<?php endif; ?>
                                  </a>
						  </p>
                        
                            <p class="txt">
                               <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </p>
                        </li>

    				<?php endwhile;
    				// ループ終了
    				// メインクエリの投稿データに戻す
    				wp_reset_postdata(); ?>
    				
                        
                        
                    </ul>
            </div>
        
            <div class="cont cont3">
                <h2><?php the_title(); ?>施術可能医院</h2>
                
                <ul>
                    
                    <?php $args = array(
                            'posts_per_page' => 8, 
                            'order'   => 'ASC',            // ソート順。ASC（昇順）かDESC（降順）で指定
                            'post_type' => 'clinic'    //投稿タイプの指定
                        );
                        $posts = get_posts( $args );
                        if( $posts ) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
                    
                    <li><a href="<?php the_field('clinic_url'); ?>" target="_blank">
                        <p class="img-box">

                            <?php if(get_field('clinic_img')): ?>
                            <img src="<?php the_field('clinic_img'); ?>" alt="<?php the_title(); ?>">
                            <?php else: // サムネイルを持っていないときの処理 ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/thumb_shinsaibashi2.jpg" alt="image">
                            <?php endif; ?>
                        </p>
                        <p class="shopn">
                            <?php the_field('clinc_name'); ?>
                        </p></a>
                    </li>
                    
				<?php endforeach; ?>
				
				<?php endif; wp_reset_postdata(); //クエリのリセット ?>

                    
                
                </ul>
            
            </div>
        
            <?php 
                        $args = array(
                                'connected_type' => 'pages_to_works',
                                'connected_items' => get_queried_object(),
                                'nopaging' => true,
                                'suppress_filters' => false
                        );
                        $connected_posts = get_posts( $args ); ?>
                        <?php if (! $connected_posts){} else { ?>
                        <p>関連クリニック</p>
                        <?php }?>
                        <?php foreach ( $connected_posts as $post ) { setup_postdata( $post );?>
                        <p><a href="<?php the_field('clinic_url'); ?>" target="_blank"><?php the_title(); ?></a></p>
            <?php }
            wp_reset_postdata();
            ?>


        
        
        
        </div>
        
        
        <footer>
            
            <p class="copy">Copyright(C) 創輝会 All Rights Reserved.</p>
        
        </footer>
    
    
</div><!--wrap--end-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/js/style.js"></script>
      <?php wp_footer(); ?>
</body>
</html>
