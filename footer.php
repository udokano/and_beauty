
<footer>
  <p id="pagetop"><img src="<?php echo get_template_directory_uri(); ?>/images/page_top.svg" alt="ページトップ"></p>
  <p class="copy">Copyright(C) 創輝会 All Rights Reserved.</p>
</footer>
<div class="menu-trigger"> <span></span> <span></span> <span></span> </div>
<nav class="menu-in">
  <ul>
    <li><a href="<?php echo home_url( '/' ); ?>flist">お気に入りリスト</a></li>
    <li><a href="<?php echo home_url( '/' ); ?>">プライバシーポリシー</a></li>
    <li><a href="https://souki-kai.or.jp/contact/index.php" target="_blank">お問い合わせ</a></li>
  </ul>
</nav>
<div class="overlay"></div>
</div>
<!--wrap--end-->

<?php wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/style.js?var=1.2"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script> 
<script>
                    $(function() {
                            $('#foo option').each(function() {
                                
                                //現在ページのURLの末尾を取得
                                    var activeUrl = location.pathname.split("/")[1];　// 2階層目
                                 //var activeUrl02 = location.href;　// 2階層目
                                  
                                //テスト出力
                                 
                                //valu(カテゴリースラッグ)取得
                                    var href = $(this).val();
                                //テスト出力
                                  //  console.log(href);
                                    if (href == activeUrl ) {
                                        // $("#foo option").prop("selected",false);
                                        $(this).prop("selected",true);
                                        // $("#bar").prop("disabled",false);
                                        //$("#foo option").val(href);
                                      
                                    }
                            });
                    });
    
    
    
                        $(window).load(function(){
                            
                            $("#bar option").each(function(){
                               
                                // var activeUrl02 = location.pathname.split("/")[3];　// 2階層目
                                   var activeUrl02 = location.href; // URLのフルパス取得
                                //テスト出力
                                  // console.log(activeUrl02);
                                 
                                //valu(カテゴリースラッグ)取得
                                    var href02 = $(this).val();
                                
                                  //  console.log(href02);
                                    
                                        if (href02 === activeUrl02) {
                                            //$("#bar option").prop("selected",false);
                                            $(this).prop("selected",true);
                                        }
                                    
                            });
                        
                          });
    
    function getParam(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

    
 
    
 $(window).load(function(){

        var tt = getParam('cat');
    console.log(tt);
    
  
      $('#bar option').each(function () {
        var val = $(this).data("slug");
        console.log(val);
        if (tt == val) {
          $(this).prop("selected", true);
        }
      });

    
    });


    
</script>
</body></html>