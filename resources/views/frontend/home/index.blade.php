@extends('frontend.layouts.app', ['class' => 'bg-white'])

@section('content')
<div class="divider-xl"></div>
<!--	START BANNER  -->
@php
    $checkSubSlider = array_search('web-homepage-sub-banners', array_column($data['banners'], 'name'));
    $checkSlider = array_search('WebSlider', array_column($data['banners'], 'name'));
 @endphp
  <div class="row @if($checkSlider === false) d-flex justify-content-center @endif">

     @foreach($data['banners'] as $banner)
      @if($banner->name == 'WebSlider')
       <!-- <div class="w-70"> -->
       <div @if($checkSubSlider === false) class="col-lg-12 col-md-12 col-xl-12 col-xs-12" @else class="col-lg-8 col-md-8 col-xl-8 col-xs-12" @endif>
        <section class="banner py-1 wow fadeInUp ">
          <div  @if(Session::get('locale') == 'ar') dir="rtl" @endif>
            @if(count($banner->images) > 0)
             <section class="banner_js " >
              @forelse($banner->images as $key=>$value)
               <a href="{{$value->link}}">
                    <div class="banner-slide bg-img ">
                      <img src="{{asset('uploads')}}/banner/{{$value->image}}" alt=""/>
                      <div class="banner-overlay">
                          <div class="banner-wrapper">
                              <div class="otrixcontainer">
                                  <div class="banner-contain">
                                    <!-- <div class="ban-offer"></div> -->
                                  @if($value->link)
                                    <a href="{{$value->link}}"  class="button-block">Start Shop Now</a>
                                  @endif
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                </a>
              @empty
              @endforelse
            </section>
            @endif
          </div>
        </section>
      </div>
      <!-- <div class="w-2"></div> -->
      @endif
      @if($checkSlider !== false && $checkSubSlider !== false && $banner->name == 'web-homepage-sub-banners')
        <!-- <div class="w-28 "> -->
        <div class="text-right home-right-banner col-lg-4 col-md-4 col-xl-4 col-xs-12">
          <!-- <div class="d-flex flex-column  "> -->
            @forelse($banner->images as $key=>$value)
              <div class="banner-slide bg-img sub-slider justify-content-center mb-4">
                  <a  href="{{$value->link}}">
                    <!-- <img src="{{asset('uploads')}}/banner/{{$value->image}}" alt="" height="205" /> -->
                    <img src="{{asset('uploads')}}/banner/{{$value->image}}" alt="" />
                  </a>
              </div>
              @empty
              @endforelse
        </div>
      @endif

      @if($checkSlider === false && $checkSubSlider !== false && $banner->name == 'web-homepage-sub-banners')
            @forelse($banner->images as $key=>$value)
              <div class="text-right home-right-banner col-lg-4 col-md-4 col-xl-4 col-xs-12">
                  <div class="banner-slide bg-img sub-slider justify-content-center mb-4">
                      <a  href="{{$value->link}}">
                        <!-- <img src="{{asset('uploads')}}/banner/{{$value->image}}" alt="" height="205" /> -->
                        <img src="{{asset('uploads')}}/banner/{{$value->image}}" alt="" />
                      </a>
                  </div>
                </div>
          @empty
          @endforelse
      @endif

      @endforeach
  </div>
<!--==== End BANNER ====-->

<!--==== Trending product ====-->
@include('frontend.partials.homeproduct',['isSlider' => false,'type' => 'trending','title' => "Trending Products", 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.",'productsArr' => $data['trendingProducts'],'new' => false])
<!--==== End Trending product ====-->

<!--====Start Homepage banner 3 column ====-->
@if(isset($data['homepagethreecolumnbanners']) && isset($data['homepagethreecolumnbanners']->images[1]))
  @include('frontend.partials.homepageBanners',['column' => 3,'data' => $data['homepagethreecolumnbanners']->images])@endif
<!--====End Homepage banner 3 column  ====-->

<!--==== START Special Offers ====-->
@include('frontend.partials.specialoffer')
<!--==== END Special Offers ====-->


<!--==== START Top Categories ====-->
@include('frontend.partials.topcategories')
<!--==== End Top Categories ====-->

<!--==== Start New product ====-->
@include('frontend.partials.homeproduct',['isSlider' => true,'type' => 'new','title' => "Flash Sale For You!", 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.",'productsArr' => $data['newProducts'],'new' => true])
<!--==== End New product ====-->

<!--==== Start Featured product ====-->
@include('frontend.partials.homeproduct',['isSlider' => false,'type' => 'featured','title' => "Featured", 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.",'productsArr' => $data['featuredproducts'],'new' => false])
<!--==== End Featured product ====-->

<!--====Start Homepage banner 2 column ====-->
@if(isset($data['homepagetwocolumnbanners']) && isset($data['homepagetwocolumnbanners']->images[1]))
  @include('frontend.partials.homepageBanners',['column' => 2,'data' => $data['homepagetwocolumnbanners']->images])
@endif
<!--====End Homepage banner 2 column  ====-->

<!--==== Category Wise Products ====-->
@include('frontend.partials.categoryWiseProducts')
<!--==== End Category Wise Products ====-->

<!--==== Brands  ====-->
@include('frontend.partials.brands')
<!--==== End Brands ====-->

<!--==== Blog Section  ====-->
@include('frontend.partials.blog')
<!--==== End Blog Section  ====-->


@if(isset($data['homepageBanners']) && isset($data['homepageBanners']->images[2]))
  @include('frontend.partials.homepageBanners')
@endif

@push('js')

<script type="text/javascript">

 <?php foreach($data['dodProducts'] as $key=>$value) {
   $endDatee = str_replace("/","-",$value->special->end_date);
   $endDatee = date('M d, Y',strtotime($endDatee));
   $endDatee .= ' 23:59:59'
   ?>

  var deadline = new Date("{{$endDatee}}").getTime();

  var x = setInterval(function() {

  var now = new Date().getTime();
  var t = new Date("{{$endDatee}}").getTime() - now;
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
  var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((t % (1000 * 60)) / 1000);
  $(".days"+"{{$value->id}}").html(days) ;
  $(".hours"+"{{$value->id}}").html(hours);
  $(".minutes"+"{{$value->id}}").html(minutes);
  $(".seconds"+"{{$value->id}}").html(seconds);
  if (t < 0) {
        clearInterval(x);
        $(".day"+"{{$value->id}}").innerHTML ='0';
        $(".hour"+"{{$value->id}}").innerHTML ='0';
        $(".minute"+"{{$value->id}}").innerHTML ='0' ;
        $(".second"+"{{$value->id}}").innerHTML = '0'; }
  }, 1000);
  <?php } ?>

  //render tab products
  var activeTab = $("ul.nav-tabs li a.active");
   getProductsByCat(activeTab.data('cat'));

   function activeTabGetData(data,category){

      //find active
      var activeTab = $("ul.nav-tabs li a.active");

      activeTab.removeClass('active');
      $(data).addClass('active');

      //find acitve tab content
      var activeTabContent = $("div.tab-content .active");
      activeTabContent.removeClass('active');
      $('#Tab-'+category).addClass('active');
      $('#cat-ul-'+category).html(`<div class="" style="margin: 0 auto"><img src="{{asset('frontend')}}/images/loading.gif" alt="loader "  /></div>`);
      getProductsByCat(category)
   }

  function getProductsByCat(category) {
    var url = '{{ route("category.productsajax", ":id") }}';
    url = url.replace(':id', category);
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'html',
        success: function(response) {
            $('#cat-ul-'+category).empty();
            $('#cat-ul-'+category).html(response);
            $("img.lazy").lazyload({
              effect:'fadein',
              placeholder_data_img:"{{asset('frontend/images/imageloader.gif')}}"
            });
        }
    });
  }


</script>
@endpush

@endsection
