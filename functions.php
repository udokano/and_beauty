<?php


//サムネイル画像有効
add_theme_support( 'post-thumbnails', array( 'post' ) );


//投稿サムネイルサイズ指定
add_image_size( 'thumb300', 300, 220, true );
add_image_size( 'thum', 600, 450, true );
add_image_size( 'ninki-thum', 80, 60, true );

//表示件数スマホとPCで変える   SP 6

add_action( 'pre_get_posts', 'change_limit_mobile' );

function change_limit_mobile( $query ) {

  $new_limit = 6;

  $iphone = strpos( $_SERVER[ 'HTTP_USER_AGENT' ], "iPhone" );
  $android = strpos( $_SERVER[ 'HTTP_USER_AGENT' ], "Android" );
  $ipad = strpos( $_SERVER[ 'HTTP_USER_AGENT' ], "iPad" );
  $berry = strpos( $_SERVER[ 'HTTP_USER_AGENT' ], "BlackBerry" );
  $ipod = strpos( $_SERVER[ 'HTTP_USER_AGENT' ], "iPod" );

  if ( ( $iphone || $android || $ipad || $ipod || $berry ) && $query->is_main_query() ) {
    set_query_var( 'posts_per_page', $new_limit );
  }
}


//カテゴリーページのみ記事の表示件数変更

function change_home_posts_per_page( $query ) {
  // 管理画面、またはメインのループでない場合中断
  if ( is_admin() || !$query->is_main_query() ) {
    return;
  }

  // 表示件数を3件にする
  if ( $query->is_category() ) {
    $query->set( 'posts_per_page', 3 );
    return;
  }
}
add_action( 'pre_get_posts', 'change_home_posts_per_page' );


//記事関連


//post2 2 posts

function my_connection_types() {
  // Posts 2 Posts プラグインが有効化されてるかチェック
  if ( !function_exists( 'p2p_register_connection_type' ) )
    return;

  // ポストとドクターページのコネクションを登録する
  p2p_register_connection_type(
    array(
      'name' => 'posts_to_pages',
      'from' => 'post',
      'to' => 'rt'
    )
  );
  // クリニックとドクターのコネクションを登録する
  p2p_register_connection_type(
    array(
      'name' => 'posts_to_post2',
      'from' => 'clinic',
      'to' => 'rt',
      //			'to_query_vars' => array( 'role' => 'editor' )
    )
  );
  // クリニックとポストのコネクションを登録する
  p2p_register_connection_type(
    array(
      'name' => 'posts_to_post3',
      'from' => 'clinic',
      'to' => 'post',
      //			'to_query_vars' => array( 'role' => 'editor' )
    )
  );

  // クリニックとユーザのコネクションを登録する
  p2p_register_connection_type(
    array(
      'name' => 'multiple_authors',
      'from' => 'clinic',
      'to' => 'user',
      //			'to_query_vars' => array( 'role' => 'editor' )
    )
  );


}
add_action( 'wp_loaded', 'my_connection_types' );


// 人気記事出力用
function getPostViews( $postID ) {
  $count_key = 'post_views_count';
  $count = get_post_meta( $postID, $count_key, true );
  if ( $count == '' ) {
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
    return "0 View";
  }
  return $count . ' Views';
}

function setPostViews( $postID ) {
  $count_key = 'post_views_count';
  $count = get_post_meta( $postID, $count_key, true );
  if ( $count == '' ) {
    $count = 0;
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
  } else {
    $count++;
    update_post_meta( $postID, $count_key, $count );
  }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );


// レスポンシブページネーション

//レスポンシブなページネーションを作成する
function responsive_pagination( $pages = '', $range = 4 ) {
  $showitems = ( $range * 2 ) + 1;

  global $paged;
  if ( empty( $paged ) )$paged = 1;

  //ページ情報の取得
  if ( $pages == '' ) {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if ( !$pages ) {
      $pages = 1;
    }
  }

  if ( 1 != $pages ) {
    echo '<ul class="pagination" role="menubar" aria-label="Pagination">';
    //先頭へ
    echo '<li class="first"><a href="' . get_pagenum_link( 1 ) . '"><span>First</span></a></li>';
    //1つ戻る
    echo '<li class="previous"><a href="' . get_pagenum_link( $paged - 1 ) . '"><span>Previous</span></a></li>';
    //番号つきページ送りボタン
    for ( $i = 1; $i <= $pages; $i++ ) {
      if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
        echo( $paged == $i ) ? '<li class="current"><a>' . $i . '</a></li>': '<li><a href="' . get_pagenum_link( $i ) . '" class="inactive" >' . $i . '</a></li>';
      }
    }
    //1つ進む
    echo '<li class="next"><a href="' . get_pagenum_link( $paged + 1 ) . '"><span>Next</span></a></li>';
    //最後尾へ
    echo '<li class="last"><a href="' . get_pagenum_link( $pages ) . '"><span>Last</span></a></li>';
    echo '</ul>';
  }
}


function my_excerpt_length($length) {
return 120;
}
add_filter('excerpt_mblength', 'my_excerpt_length');

function my_excerpt_more($more) {
return '・・・';
}
add_filter('excerpt_more', 'my_excerpt_more');


//ブログカード挿入


// 記事IDを指定して抜粋文を取得
function ltl_get_the_excerpt( $post_id ){
  global $post;
  $post_bu = $post;
  $post = get_post( $post_id );
  setup_postdata( $post_id );
  $output = get_the_excerpt();
  $post = $post_bu;
  return $output;
}

//ショートコード
function nlink_scode($atts) {
extract(shortcode_atts(array(
'url'=>"",
'title'=>"",
'excerpt'=>""
),$atts));

$id = url_to_postid($url);//URLから投稿IDを取得

$no_image = 'noimageに指定したい画像があればここにパス';//アイキャッチ画像がない場合の画像を指定

//タイトルを取得
if(empty($title)){
$title = esc_html(get_the_title($id));
}
//抜粋文を取得
  if( empty( $excerpt ) ){
      $excerpt = esc_html( ltl_get_the_excerpt( $id ) );
  if( mb_strlen($excerpt, 'UTF-8') > 120 ){
      $excerpt= mb_substr($excerpt, 0, 120, 'UTF-8').'...';
  }
  }

//アイキャッチ画像を取得
if(has_post_thumbnail($id)) {
$img = wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
$img_tag = "<img src='" . $img[0] . "' alt='{$title}'/>";
}else{
$img_tag ='<img src="'.$no_image.'" alt="" width="'.$img_width.'" height="'.$img_height.'" />';
}

$nlink .='




<a href="'. $url .'" class="blog-card" target="_blank" rel="noopener noreferrer">
  <div class="blog-card__box">
    <div class="blog-card__thumbnail">'. $img_tag .'</div>
    <div class="blog-card__right">
        <div class="blog-card__title">'. $title .' </div>
        <div class="blog-card__excerpt">'. $excerpt .'</div>
		<div class="blog-card__readmore">記事を読む</div>
    </div>
  </div>
</a>';



return $nlink;
}

add_shortcode("nlink", "nlink_scode");



//if (!function_exists('st_tiny_mce_before_init')) {
//	/**
//	 * オリジナルタグ登録
//	 */
//	function st_tiny_mce_before_init( $init_array ) {
//	//書式プルダウンメニューのカスタマイズ
//	$init_array['block_formats'] = '段落=p;見出し2=h2;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6';
//	$init_array['fontsize_formats'] = '70% 80% 90% 120% 130% 150% 200% 250% 300%';
//	//自作クラスをプルダウンメニューで追加
//	$style_formats = array (
//        array( 'title' => 'h2', 'block' => 'h2', 'classes' => 'editor__h2' ),
//        array( 'title' => 'h3', 'block' => 'h3', 'classes' => 'editor__h3' ),
//		array( 'title' => 'ボックス', 'inline' => 'div', 'classes' => 'box' ),
//		array( 'title' => '太字', 'inline' => 'span', 'classes' => 'huto' ),
//		array( 'title' => '太字（赤）', 'inline' => 'span', 'classes' => 'hutoaka' ),
//        array( 'title' => '太字（黄）', 'inline' => 'span', 'classes' => 'hutoyellow' ),
//		array( 'title' => '大文字', 'inline' => 'span', 'classes' => 'oomozi' ),
//		array( 'title' => '小文字', 'inline' => 'span', 'classes' => 'komozi' ),
//		array( 'title' => 'ドット線', 'inline' => 'span', 'classes' => 'dotline' ),
//		array( 'title' => '黄マーカー', 'inline' => 'span', 'classes' => 'ymarker' ),
//		array( 'title' => '赤マーカー', 'inline' => 'span', 'classes' => 'rmarker' ),
//		array( 'title' => '参考', 'inline' => 'span', 'classes' => 'sankou' ),
//		array( 'title' => '写真に枠線', 'inline' => 'span', 'classes' => 'photoline' ),
//		array( 'title' => '記事タイトルデザイン', 'block' => 'p', 'classes' => 'entry-title' ),
//		array( 'title' => '吹き出し', 'block' => 'p', 'classes' => 'h2fuu' ),
//		array( 'title' => '回り込み解除', 'block' => 'div', 'classes' => 'clearfix' , 'wrapper' => true ),
//		array( 'title' => 'センター寄せ', 'block' => 'div', 'classes' => 'center' , 'wrapper' => true ),
//		array( 'title' => '黄色ボックス', 'block' => 'div', 'classes' => 'yellowbox' , 'wrapper' => true ),
//		array( 'title' => '薄赤ボックス', 'block' => 'div', 'classes' => 'redbox' , 'wrapper' => true ),
//        array( 'title' => '薄青ボックス', 'block' => 'div', 'classes' => 'bluebox' , 'wrapper' => true ),
//         array( 'title' => '薄緑ボックス', 'block' => 'div', 'classes' => 'greenbox' , 'wrapper' => true ),
//         array( 'title' => '薄茶色ボックス', 'block' => 'div', 'classes' => 'blaunbox' , 'wrapper' => true ),
//		array( 'title' => 'グレーボックス', 'block' => 'div', 'classes' => 'graybox' , 'wrapper' => true ),
//		array( 'title' => '引用風ボックス', 'block' => 'div', 'classes' => 'inyoumodoki' , 'wrapper' => true ),
//		/*array( 'title' => 'olタグを囲む数字ボックス', 'block' => 'div', 'classes' => 'maruno' , 'wrapper' => true ),
//		array( 'title' => 'ulタグを囲む数字ボックス', 'block' => 'div', 'classes' => 'maruck' , 'wrapper' => true ),
//		array( 'title' => 'table横スクロールボックス', 'block' => 'div', 'classes' => 'scroll-box' , 'wrapper' => true ),
//		array( 'title' => 'imgインラインボックス', 'block' => 'span', 'classes' => 'inline-img' , 'wrapper' => true ),
//		array( 'title' => 'width100%リセット', 'block' => 'span', 'classes' => 'resetwidth' , 'wrapper' => true ),
//		array( 'title' => '装飾なしテーブル', 'block' => 'div', 'classes' => 'notab' , 'wrapper' => true ),*/
//		);
//	$init_array['style_formats'] = json_encode( $style_formats );
//	$init['style_formats_merge'] = false;
//	return $init_array;
//	}
//}
//add_filter( 'tiny_mce_before_init', 'st_tiny_mce_before_init' );


if ( !function_exists( 'st_add_orignal_quicktags' ) ) {
  /**
   * オリジナルクイックタグ登録
   */
  function st_add_orignal_quicktags() {
    if ( wp_script_is( 'quicktags' ) ) {
      ?>
<script type="text/javascript">
				QTags.addButton('ed_p', 'P', '<p>', '</p>');
                QTags.addButton('ed_h2', 'h2', '<h2>', '</h2>');
                QTags.addButton('ed_h3', 'h3', '<h3>', '</h3>');
                QTags.addButton('ed_h4', 'h4', '<h4>', '</h4>');
                QTags.addButton('ed_br', 'br', '<br>');
                //スマホの時は改行OFF
                QTags.addButton('ed_br__pc', 'br__pc', '<br class="pc">');
                QTags.addButton('ed_strong', 'strong', '<strong>', '</strong>');
				QTags.addButton('ed_huto', 'ボックス', '<div class="huto">', '</div>');
				QTags.addButton('ed_huto', '太字', '<span class="huto">', '</span>');
				QTags.addButton('ed_hutoaka', '太字（赤）', '<span class="hutoaka">', '</span>');
                QTags.addButton('ed_hutyellow', '太字（黄）', '<span class="hutoyellow">', '</span>');
				QTags.addButton('ed_oomozi', '大文字', '<span class="oomozi">', '</span>');
				QTags.addButton('ed_komozi', '小文字', '<span class="komozi">', '</span>');
				QTags.addButton('ed_dotline', 'ドット線', '<span class="dotline">', '</span>');
				QTags.addButton('ed_ymarker', '黄マーカー', '<span class="ymarker">', '</span>');
				QTags.addButton('ed_under_rmarker', 'アンダー黄色マーカー', '<span class="underline-yellow">', '</span>');
				QTags.addButton('ed_ymarker', '黄マーカー', '<span class="ymarker">', '</span>');
				QTags.addButton('ed_sankou', '参考', '<div class="sankou">', '</div>');
				QTags.addButton('ed_photoline', '写真に枠線', '<span class="photoline">', '</span>');
				QTags.addButton('ed_entry', '記事タイトルデザイン', '<p class="entry-title">', '</p>');
				QTags.addButton('ed_clearfix', '回り込み解除', '<div class="clearfix">', '</div>');
				QTags.addButton('ed_center', 'センター寄せ', '<div class="center">', '</div>');
				QTags.addButton('ed_yellowbox', '黄色ボックス', '<div class="boxes-style yellowbox">', '</div>');
				QTags.addButton('ed_redbox', '薄赤ボックス', '<div class="boxes-style redbox">', '</div>');
                QTags.addButton('ed_bluebox', '薄青ボックス', '<div class="boxes-style bluebox">', '</div>');
                QTags.addButton('ed_greenbox', '薄緑ボックス', '<div class="boxes-style greenbox">', '</div>');
                  QTags.addButton('ed_blaunbox', '薄茶色ボックス', '<div class="boxes-style blaunbox">', '</div>');
				QTags.addButton('ed_graybox', 'グレーボックス', '<div class="boxes-style graybox">', '</div>');
				QTags.addButton('ed_inyoumodoki', '引用風', '<div class="inyoumodoki">', '</div>');
				QTags.addButton('ed_dl', 'dl', '<dl><dt></dt>', '<dd></dd></dl>');
				/*QTags.addButton('ed_maruno', 'olタグを囲む数字ボックス', '<div class="maruno">', '</div>');
				QTags.addButton('ed_maruck', 'ulタグを囲むチェックボックス', '<div class="maruck">', '</div>');*/
				/*QTags.addButton('ed_scroll_box', 'table横スクロール要素', '<div class="scroll-box">', '</div>');
				QTags.addButton('ed_resetwidth', 'width100%リセット', '<span class="resetwidth">', '</span>');
				QTags.addButton('ed_notab', '装飾なしテーブル', '<div class="notab">', '</div>');
				QTags.addButton('ed_responbox', 'PCのみ左右%ボックス', '<div class="clearfix responbox"><div class="lbox"><p>左側のコンテンツ40%</p></div><div class="rbox"><p>右側のコンテンツ60%</p></div></div>', '');
				QTags.addButton('ed_responbox50s', '全サイズ左右50%ボックス', '<div class="clearfix responbox50 smart50"><div class="lbox"><p>左側のコンテンツ50%</p></div><div class="rbox"><p>右側のコンテンツ50%</p></div></div>', '');
				QTags.addButton( 'ed_ive', 'イベント', "onclick=\"ga('send', 'event', 'linkclick', 'click', 'hoge');\"", '' );*/
				QTags.addButton( 'ed_nofollow', 'nofollow', " rel=\"nofollow\"", '' );
			</script>
<?php
}
}
}
add_action( 'admin_print_footer_scripts', 'st_add_orignal_quicktags' );


// パンくずリスト
function breadcrumb_func() {
  global $post;
  $str = '';
  if ( !is_home() && !is_admin() ) {
    $str .= '<ul class="path" itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $str .= '<a href="' . home_url() . '" itemprop="item"><span itemprop="name">' . 'HOME' . '</span></a><meta itemprop="position" content="1" /></li>';
    $str .= '<li>&gt;</li>';
    if ( is_post_type_archive() ) {
      $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( get_post_type_object( get_post_type() )->label ) . '</span><meta itemprop="position" content="2" /></li>';
    } elseif ( is_tax() ) {
      $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_post_type_archive_link( get_post_type() ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_post_type_object( get_post_type() )->label ) . '</span></a><meta itemprop="position" content="2" /></li>';
      $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">><a href="#" itemprop="item"><span itemprop="name">' . single_term_title( '', false ) . '</span></a><meta itemprop="position" content="3" /></li>';
    } elseif ( is_tag() ) {
      $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">><a href="#" itemprop="item"><span itemprop="name">' . single_tag_title( '', false ) . '</span></a><meta itemprop="position" content="2" /></li>';
    } elseif ( is_category() ) {
      $cat = get_queried_object();
      if ( $cat->parent != 0 ) {
        $ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
        foreach ( $ancestors as $ancestor ) {
          $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_category_link( $ancestor ) . '" itemprop="item"><span itemprop="name">' . get_cat_name( $ancestor ) . '</span></a><meta itemprop="position" content="2" /></li>';
          $str .= '<li>&gt;</li>';
        }
      }
      $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . $cat->cat_name . '</span></a><meta itemprop="position" content="3" /></li>';
    } elseif ( is_page() ) {
      if ( $post->post_parent != 0 ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        foreach ( $ancestors as $ancestor ) {
          $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink( $ancestor ) . '" itemprop="item"><span itemprop="name">' . get_the_title( $ancestor ) . '</span></a><meta itemprop="position" content="2" /></li>';
          $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . wp_title( '', false ) . '</span></a><meta itemprop="position" content="3" /></li>';
        }
      } else {
        $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . wp_title( '', false ) . '</span></a><meta itemprop="position" content="2" /></li>';
      }
    }
    elseif ( is_author() ) {
      if ( $post->post_parent != 0 ) {
        $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
        foreach ( $ancestors as $ancestor ) {
          $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_permalink( $ancestor ) . '" itemprop="item"><span itemprop="name">' . get_the_title( $ancestor ) . '</span></a><meta itemprop="position" content="2" /></li>';
          $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . wp_title( '', false ) . '</span></a><meta itemprop="position" content="3" /></li>';
        }
      } else {
        $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . wp_title( '', false ) . '</span></a><meta itemprop="position" content="2" /></li>';
      }
    }

    elseif ( is_single() ) {
      $categories = get_the_category( $post->ID );
      $cat = $categories[ 0 ];
      if ( $cat->parent != 0 ) {
        $ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
        foreach ( $ancestors as $ancestor ) {
          $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_category_link( $ancestor ) . '" itemprop="item"><span itemprop="name">' . get_cat_name( $ancestor ) . '</span></a><meta itemprop="position" content="2" /></li>';
          $str .= '<li>&gt;</li>';
        }
        $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . get_category_link( $cat->term_id ) . '" itemprop="item"><span itemprop="name">' . $categories[ 0 ]->cat_name . '</span></a><meta itemprop="position" content="3" /></li>';
        $str .= '<li>&gt;</li>';
        $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . wp_title( '', false ) . '</span></a><meta itemprop="position" content="4" /></li>';
      } else {

        $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">' . wp_title( '', false ) . '</span></a><meta itemprop="position" content="3" /></li>';
      }
    }


    $str .= '</ul>' . "\n";
  }
  return $str;
}
add_shortcode( 'breadcrumb', 'breadcrumb_func' );


//子カテゴリーを表示させるためにパーマリンクをフラットにする
/*function permalink_change_post( $permalink, $post, $leavename ) {
 
    // 記事が属するカテゴリと親カテゴリを取得
    $category = get_the_category($post->ID);
    $parent = get_category($category[0]->parent);
     
    // 親カテゴリが存在する場合は、フラットなURLにカスタマイズ
    if ( empty($category[0]->parent) === false )
    {
        $permalink = home_url('/'.$category[0]->slug.'/'.$post->post_name);
    }
 
    return $permalink;
}
 
add_filter( 'post_link', 'permalink_change_post', 10, 3 );*/

//子カテゴリー404回避
function child_category_link_custom( $query = array() ) {

  if ( isset( $query[ 'category_name' ] ) && strpos( $query[ 'category_name' ], '/' ) === false && isset( $query[ 'name' ] ) ) {
    $parent_category = get_category_by_slug( $query[ 'category_name' ] );
    $child_categories = get_categories( 'child_of=' . $parent_category->term_id );
    foreach ( $child_categories as $child_category ) {
      if ( $query[ 'name' ] === $child_category->category_nicename ) {
        $query[ 'category_name' ] = $query[ 'category_name' ] . '/' . $query[ 'name' ];
        unset( $query[ 'name' ] );
      }
    }
  }
  return $query;
}
add_filter( 'request', 'child_category_link_custom' );

/* カテゴリーURLから「category」を削除
---------------------------------------------------------- */
add_filter( 'user_trailingslashit', 'remcat_function' );

function remcat_function( $link ) {
  return str_replace( "/category/", "/", $link );
}
add_action( 'init', 'remcat_flush_rules' );

function remcat_flush_rules() {
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_filter( 'generate_rewrite_rules', 'remcat_rewrite' );

function remcat_rewrite( $wp_rewrite ) {
  $new_rules = array( '(.+)/page/(.+)/?' => 'index.php?category_name=' . $wp_rewrite->preg_index( 1 ) . '&paged=' . $wp_rewrite->preg_index( 2 ) );
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}


/* サムネイル自動登録
---------------------------------------------------------- */
add_action( 'save_post', 'save_default_thumbnail' );

function save_default_thumbnail( $post_id ) {
  $post_thumbnail = get_post_meta( $post_id, $key = '_thumbnail_id', $single = true );
  if ( !wp_is_post_revision( $post_id ) ) {
    if ( empty( $post_thumbnail ) ) {
      update_post_meta( $post_id, $meta_key = '_thumbnail_id', $meta_value = '789' );
    }
  }
}


/**
 * 外部リンク用のメニューを追加します (例: Google Analytics)
 */
function admin_analytics_menu() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  //   $page_title: 設定ページの<title>部分 → メニュー名と同じでよいです。
  //   $menu_title: メニュー名
  //   $capability: 権限 ( 'manage_options' や 'administrator' など)
  //   $menu_slug : メニューのslug → 例では'analytics'ですが、必要に応じて好きな名前にしてください。
  //   $function  : 設定ページの出力を行う関数 → 不要
  //   $icon_url  : メニューに表示するアイコン → 今回の例では不要
  //   $position  : メニューの位置 ( 1 や 99 など ) → 今回の例では不要
  add_menu_page( '広告管理', '広告管理', 'manage_options', 'analytics' );
}
add_action( 'admin_menu', 'admin_analytics_menu', 1000 );

/**
 * 外部リンク用のリンク設定を行います (例: Google Analytics)
 * ※ add_menu_page()だけでは外部リンクの設定ができないため、JavaScriptで調整します。
 */
function admin_analytics_menu_link() {
  ?>
<script>
		jQuery(function($){
			// 上で指定したメニューのスラッグ
			var menu_slug = 'analytics';
			$('a.toplevel_page_' + menu_slug).prop({
				// 外部URL
				href: "post.php?post=791&action=edit"
				// 新しいタブで開く
				// target: "_blank"
			});
		});
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 'admin_analytics_menu_link' );


/**
 * 子カテチェックで親カテも
 */
add_action( 'admin_footer-welcart-shop_page_usces_itemedit', 'super_category_toggler' );
add_action( 'admin_footer-welcart-shop_page_usces_itemnew', 'super_category_toggler' );