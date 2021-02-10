// JavaScript Document

//スマホの時にトップページバナーの長さだけパディング取得

$(function () {

  var height = $(".fv-mobile").height(); //#menuの高さを取得

  $(".fv-jack").css("padding-top", height); //bodyのCSSをいじる

});


//トップページ、下スクロールしたらヘッダー固定


/*$(function () {
  var $win = $(window),
    $main = $('.pages-main'),
    $nav = $('#front-header'),
    navHeight = $nav.outerHeight(),
    navPos = $nav.offset().top,
    fixedClass = 'is-fixed';

  $win.on('load scroll', function () {
    var value = $(this).scrollTop();
    if (value > navPos) {
      $nav.addClass(fixedClass);
    } else {
      $nav.removeClass(fixedClass);
    }
  });
});
*/
//セレクトボックス設定

/*$(function() {
  var $children = $('.children');
  var original = $children.html();

  $('.parent').change(function() {
    var val1 = $(this).val();

    $children.html(original).find('option').each(function() {
      var val2 = $(this).data('val');
      if (val1 != val2) {
        $(this).not('optgroup,.msg').remove();
      }
    });

    if ($(this).val() === '') {
      $children.attr('disabled', 'disabled');
    } else {
      $children.removeAttr('disabled');
    }

  });
});*/


//スマホヘッダー上スクロール設定

var windowWidth = $(window).width();
var windowSm = 768;
if (windowWidth <= windowSm) {
  $(function () {
    var headerHeight = $('.fix-head').outerHeight(),
      startPos = 0;
    $(window).on('load scroll', function () {
      var scrollPos = $(this).scrollTop();
      if (scrollPos > startPos && scrollPos > headerHeight) {
        $('.fix-head').css('top', '-' + headerHeight + 'px');
      } else {
        $('.fix-head').css('top', '0');
      }
      startPos = scrollPos;
    });
  });
}


$(function () {

  //ハンバーガー設定

  $('.menu-trigger').on('click', function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('.menu-in').removeClass('open');
      $('.overlay').removeClass('open');
    } else {
      $(this).addClass('active');
      $('.menu-in').addClass('open');
      $('.overlay').addClass('open');
    }
  });
  $('.overlay').on('click', function () {
    if ($(this).hasClass('open')) {
      $(this).removeClass('open');
      $('.menu-trigger').removeClass('active');
      $('.menu-in').removeClass('open');
    }
  });

  //スクロールトップ


  $("#pagetop").on('click', function () {
    $('html,body').animate({
      scrollTop: '0'
    }, 500);
  });


  //スライダードクター一覧
  $(function () {

    $('#dc-slide').slick({
      arrows: false,
      accessibility: true,
      autoplay: true,
      infinite: true,
      dots: false,
      /* centerMode: true,
        centerPadding: '60px',*/
      slidesToShow: 10,
      slidesToScroll: 1,

      responsive: [

        {
          breakpoint: 1120,
          settings: {
            slidesToShow: 7,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            dots: true, //ページャーを表示（スライダー下の黒い丸）
            slidesToShow: 5,
            slidesToScroll: 1,
          }
        },

        {

          breakpoint: 460,
          settings: {
            dots: true, //ページャーを表示（スライダー下の黒い丸）
            slidesToShow: 3,
            slidesToScroll: 1,
          }

        }

      ]
    });
  });


  //スライダークリニック一覧
  $(function () {
    //slider
    $('.slider').slick({
      accessibility: true,
      autoplay: false,
      infinite: true,
      dots: false,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [{
        breakpoint: 768,
        settings: {
          dots: true, //ページャーを表示（スライダー下の黒い丸）
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      }]
    });
  });

  //スムーススクロール
  $('a[href^="#"]').click(function () {
    var speed = 1000;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    $("html, body").animate({
      scrollTop: target.offset().top
    }, speed, "swing");
    return false;
  });


});
