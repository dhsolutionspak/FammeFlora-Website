<script type="text/javascript">

  function setSearchCategory(catid) {
    $('.searchCat').val(catid)
  }
  function searchMobile() {
    $('.mobile-search-form').submit();
  }
  function searchData(searchKeyword) {
    setTimeout(() => {
      if(searchKeyword.length > 2) {
        $('#searchData').empty();
        var url = '{{ route("product.search") }}';
        let category = $('.searchCat').val();
          $.ajax({
              url: url,
              type: 'post',
              dataType: 'json',
              data:{ "_token": "{{ csrf_token() }}", "keyword":searchKeyword,"category":category},
              success: function(response) {
                if(response.status == 1) {
                  let data = response.data;
                  let renderHTML = `<div class="instant-results">
                   <ul class="list-unstyled result-bucket">`;
                  if(data.length > 0) {
                      data.map((item) =>{
                        renderHTML +=`<li class="result-entry" data-suggestion="Target 2" data-position="1" data-type="type" data-analytics-type="merchant">
                          <div class="row p-2 result-link">
                            <div class="col-md-4 col-sm-4 col-lg-4  text-center">
                              <a href="{{url('/product')}}/${item.id}">
                                <img src="{{asset('uploads')}}/product/${item.image}" class="media-object">
                              </a>
                            </div>
                            <div class="col-md-8 col-sm-8 col-lg-8  text-left">
                              <div class="media-body">
                                  <h4 class="media-heading">
                                    <a href="{{url('/product')}}/${item.id}" class="prod-title" tabindex="0">${item.product_description.name}</a>
                                  </h4>
                                  <p>`;
                                  renderHTML += "{{config('settingConfig.config_currency')}}";
                                  renderHTML +=` ${item.price}</p>
                              </div>
                            </div>
                          </div>
                        </li>
                        `;
                    })
                  }
                   renderHTML += '</ul></div>';
                   $('#searchData').append(renderHTML)
                   $(".instant-results").fadeIn('slow').css('height', 'auto');
                }
              }
          });
      }
      else {
        $('#searchData').empty();
      }
     }, 600);
  }


   $( document ).ready(function() {

       if (document.cookie.indexOf("accepted_cookies=") < 0) {
         $(".cookie-overlay").removeClass("d-none").addClass("d-block");
       }

       $(".accept-cookies").on("click", function () {
         document.cookie = "cookieName=cookieValue; max-age=100*720*60*60; path=/;";
         document.cookie = "accepted_cookies=yes;";
         $(".cookie-overlay").removeClass("d-block").addClass("d-none");
       });

       // expand depending on your needs
       $(".close-cookies").on("click", function () {
         $(".cookie-overlay").removeClass("d-block").addClass("d-none");
       });





    <?php if(Session::has('loginSuccess')) { ?>
          new RetroNotify({
            style: 'green',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-check"></i> Login Success',
            contentText: '',
            closeDelay: 2500
          });
    <?php  } ?>

    <?php if(Session::has('registerSuccess')) { ?>
          new RetroNotify({
            style: 'green',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-check"></i> Register Success',
            contentText: '',
            closeDelay: 2500
          });

    <?php  } ?>


    <?php if(Session::has('loginError')) { ?>
      new RetroNotify({
        style: 'red',
        animate: 'slideTopRight',
        contentHeader: '<i class="fa fa-close"></i> Login error',
        contentText: '{!! \Session::get('loginError') !!}',
        closeDelay: 2500
      });
    <?php  } ?>
    <?php if(Session::has('commonError')) { ?>
          new RetroNotify({
            style: 'white',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-info"></i> Error',
            contentText: '{!! \Session::get('commonError') !!}',
            closeDelay: 2500
          });

    <?php  } ?>
    <?php if(Session::has('commonSuccess')) { ?>
          new RetroNotify({
            style: 'green',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-check"></i> Success',
            contentText: '{!! \Session::get('commonSuccess') !!}',
            closeDelay: 2500
          });
    <?php  } ?>


      //chnage language
      $(".langBtn").on('click', function(that){
        var language = $(this).attr('data-language');
        var languageid= $(this).attr('data-languageid');

        ///location.reload();
        var url = '{{ route("setLanguage") }}';
          $.ajax({
              url: url,
              type: 'post',
              dataType: 'json',
              data:{ "_token": "{{ csrf_token() }}", "language_id":languageid,"locale":language},
              success: function(response) {
                if(response.status == 1) {
                    location.reload();
                }
              }
            });
      });
    });

    $('.dropdown-toggle').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).closest('.search-dropdown').toggleClass('open');
    });

    $('.dropdown-menu > li > a').click(function(e) {
      e.preventDefault();
      var clicked = $(this);
      clicked.closest('.dropdown-menu').find('.menu-active').removeClass('menu-active');
      clicked.parent('li').addClass('menu-active');
      clicked.closest('.search-dropdown').find('.toggle-active').html(clicked.html());
    });

    $(document).click(function() {

      $('.search-dropdown.open').removeClass('open');
    });

    //open language dropdown
    $('.language-toggle').click(function(e) {
      e.preventDefault();
      e.stopPropagation();

      if($('.language-menu ').attr('class') == 'language-menu d-none') {
        $('.language-menu').removeClass('d-none');
      }
      else {
        $('.language-menu').addClass('d-none');
      }
    });
    $('body').click(function() {
      $('.language-menu').addClass('d-none');
    });

    $(function() {
      $("img.lazy").lazyload({
        effect:'fadein',
        placeholder_data_img:"{{asset('frontend/images/imageloader.gif')}}"
      });
    });


</script>
