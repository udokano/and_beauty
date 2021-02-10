<html>
<head>
<meta charset="UTF-8">
<title>
<?php bloginfo( 'name' ); ?>
</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.css">
<link rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/css/slick-theme.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css?<?php echo filemtime( get_stylesheet_directory() . '/css/style.css'); ?>">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<?php wp_head(); ?>
</head>
<?php if ( is_home() || is_front_page() ) : ?>
<body <?php body_class(); ?> id="top">
<?php else: ?>
<body <?php body_class(); ?>>
<?php endif; ?>
<div class="wrap">
<?php if ( is_home() || is_front_page() ) : ?>
<header class="fix-head page-header" id="front">
<?php else: ?>
<header class="fix-head page-header">
  <?php endif; ?>
  <div class="h-in">
    <div class="h-left">
      <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="アンドビューティー"></a></div>
      <?php if ( is_singular("post") ): ?>
      <!-- 記事ページの場合 -->
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <p class="h-dis">
        <?php the_author(); ?>先生が<?php //子カテコリーのみ表示
                  $cats = get_the_category();
                  foreach ( $cats as $cat ) {
                    if ( $cat->parent ) {
                      echo $cat->cat_name;
                      break; //１つしか出力したくないから1回でループリセット
                    }
                  }
                  ?>に関する記事をお届け！</p>
		
      <?php endwhile; endif; ?>
      <?php else: ?>
      <!--    それ以外のページ    -->
      <h1 class="h-dis">美容のタメになる話を現役医師達が綴る美容マガジン</h1>
      <?php endif; ?>
    </div>
    <div class="h-rig">
    <form action="#" name="form1">
      <ul class="cf">
        <li class="lo">
          <select id="foo" name="foo">
            <option value="" selected="selected">お悩みを選ぶ</option>
            <?php
            //一番親階層のカテゴリをすべて取得
            $categories = get_categories( 'parent=0' );

            //取得したカテゴリへの各種処理
            foreach ( $categories as $val ) {
              //カテゴリのリンクURLを取得
              $cat_link = get_category_link( $val->cat_ID );
              //親カテゴリのリスト出力
              echo ' <option value="';
              echo '' . $val->slug . '">' . $val->name . '';
              echo '</option>';
            }
            ?>
          </select>
        </li>
        <li class="batu"><img src="<?php echo get_template_directory_uri(); ?>/images/batu.png" alt="×"></li>
        <li class="sh">
          <select id="bar" name="bar" onChange="jump()" disabled>
            <option value="">もっと詳しく探す</option>
            <?php
            //一番親階層のカテゴリをすべて取得
            $categories = get_categories( 'parent=0' );

            //取得したカテゴリへの各種処理
            foreach ( $categories as $val ) {
              //カテゴリのリンクURLを取得
              $cat_link = get_category_link( $val->cat_ID );
              //子カテゴリのIDを配列で取得。配列の長さを変数に格納
              $child_cat_num = count( get_term_children( $val->cat_ID, 'category' ) );

              //子カテゴリが存在する場合
              if ( $child_cat_num > 0 ) {
                //子カテゴリの一覧取得条件
                $category_children_args = array( 'parent' => $val->cat_ID );
                //子カテゴリの一覧取得
                $category_children = get_categories( $category_children_args );
                //子カテゴリの数だけリスト出力
                foreach ( $category_children as $child_val ) {
                  $cat_link = get_category_link( $child_val->cat_ID );
                  echo ' <option value="';
                  echo '' . $cat_link . '"';
                  echo ' data-val="' . $val->slug . '"data-slug="'. $child_val->slug .'">' . $child_val->name . '';
                  echo '</option>';
                }
              }

            }
            ?>
          </select>
        </li>
      </ul>
      </div>
      <script type="text/javascript">
		const foo = document.getElementById( 'foo' );
		const bar = document.getElementById( 'bar' );
		const options = bar.options;
		const optionsArray = Array.from( options );
		const original = bar.innerHTML;

		// optionsをフィルタリング
		const optionsSet = ( val1 ) => {
			bar.innerHTML = '';

			const result = optionsArray.filter( ( option, i ) => {
				const val2 = option.getAttribute( 'data-val' );
				return val1 === val2 || i === 0; // 「都道府県を選択」を消さないように
			} );

			for ( const option of result ) {
				bar.innerHTML += option.outerHTML;
			}
		};

		// #fooが変更されたら
		foo.onchange = () => {
			bar.innerHTML = original;
			const val1 = foo.value;

			if ( val1 !== '' ) {
				optionsSet( val1 );
				bar.removeAttribute( 'disabled' );
				// 指定された要素を選択する
				//$("#bar").prop("selectedIndex", 1);
			} else {
				bar.setAttribute( 'disabled', 'disabled' );
			}
		}
        
        //※追記、読み込み時にも親カテゴリ選択されていたら、それに応じた子カテゴリーが選択できるようにする
        window.onload = function() {
			bar.innerHTML = original;
			const val1 = foo.value;
            console.log(val1);//
            
            var val3 = options;//
            console.log(val3);//
            
            const url014 = location.href;//
            console.log(url014);//
            
			if ( val1 !== '' ) {
				optionsSet( val1 );
				bar.removeAttribute( 'disabled' );
				// 指定された要素を選択する
				//$("#bar").prop("selectedIndex", 1);
                if(val3 === url014) {
                    $("#bar option").prop("selected","true");
                }
			} else {
				bar.setAttribute( 'disabled', 'disabled' );
			}
		}
	</script> 
      <script type="text/javascript">
	var target = "";
	function jump(){
		var url = document.form1.bar.options[document.form1.bar.selectedIndex].value;
		if(url != "" ){
			if(target == 'top'){
				top.location.href = url;
			}
			else if(target == 'blank'){
				window.open(url, 'window_name');
			}
			else if(target != ""){
				eval('parent.' + target + '.location.href = url');
			}
			else{
				location.href = url;
			}
		}
	}
	</script>
    </form>
  </div>
</header>
