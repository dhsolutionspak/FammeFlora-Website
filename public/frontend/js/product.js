
/*-----BRANDS-----*/
  $(".js_product_mainslider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.js_product_thumbslider'
  });

  $(".js_product_thumbslider").slick({
    slidesToShow: 7,
    slidesToScroll: 1,
    asNavFor: '.js_product_mainslider',
    dots: false,
    arrows: true,
    focusOnSelect: true,
    responsive: [

      {
        breakpoint: 1500,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1
        }
                    },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
                    },
      {
        breakpoint: 481,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });



// tabbed content
// http://www.entheosweb.com/tutorials/css/tabs.asp

$(".descirp-tab ").find(".tab_content").hide();
$(".descirp-tab ").find(".tab_content:first").show();

/* if in tab mode */
$("ul.tabs li").click(function () {
  var parent = $(this).parents(".descirp-tab "),
    activeTab = $(this).attr("rel");

  parent.find(".tab_content").hide();
  $("#" + activeTab).fadeIn();

  parent.find("ul.tabs li").removeClass("active");
  $(this).addClass("active");

  parent.find(".tab_drawer_heading").removeClass("d_active");
  parent.find(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");



});
/* if in drawer mode */
$(".tab_drawer_heading").click(function () {
  var parent = $(this).parents(".descirp-tab "),
    d_activeTab = $(this).attr("rel");

  parent.find(".tab_content").hide();
  $("#" + d_activeTab).fadeIn();

  parent.find(".tab_drawer_heading").removeClass("d_active");
  parent.find(this).addClass("d_active");

  parent.find("ul.tabs li").removeClass("active");
  parent.find("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");

});
