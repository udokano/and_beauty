<html>
<head>
<meta charset="UTF-8">
<title>
<?php bloginfo( 'name' ); ?>
</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.css">
<link rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/css/slick-theme.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrap">
<header class="fix-head">
  <div class="h-in">
    <div class="h-left">
      <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="アンドビューティー"></a></div>
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <div class="h-dis">
        <?php the_author(); ?>先生が<?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?>に関する記事をお届け！</div>
      <?php endwhile; endif; ?>
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
        <li class="batu">×</li>
        <li class="sh">
          <select id="bar" name="bar" onChange="jump()" disabled>
            <option value="" selected="selected">もっと詳しく探す</option>
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
                  echo ' data-val="' . $val->slug . '">' . $child_val->name . '';
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
        
         //読み込み時にも親カテゴリ選択されていたら、それに応じた子カテゴリーが選択できるようにする
        window.onload = function() {
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
