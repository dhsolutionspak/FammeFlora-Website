@extends('frontend.layouts.app', ['class' => 'bg-white'])
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shop-listing.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/smk-accordion.css">
@section('content')

<!--==== START BREADCUMB ====-->
<section class="page-crumb">
    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('homepage')['title']}}</a></li>
      <li class="current">
           {{$bradcumArr['name']}}
      </li>
    </ul>
</section>
<!--==== END BREADCUMB ====-->


<!--==== START PRODUCT LISTING ====-->
<section class="inner-wrapper " id="shop-listing">
    <div class="shop-bar ">
      <span class="product-count-text">{{$count}} Products Found</span>
      <div class="short-by-list">
        <form class="short-ordering">
          <label> {{__('product')['sortby']}}: </label>
            <select name="orderby" class="px-2 orderby" aria-label="Shop order" onchange="filterSortBy(this.value)">
                <option value="default" @if($orderBy == 'default') selected="true" @endif>{{__('filter')['default']}}</option>
                <option value="lowtohigh" @if($orderBy == 'lowtohigh') selected="true" @endif>{{__('filter')['ltoh']}}</option>
              <option value="hightolow" @if($orderBy == 'hightolow') selected="true" @endif>{{__('filter')['htol']}}</option>
            </select>
          <input type="hidden" name="paged" value="1">
        </form>

      </div>
    </div>
    <div class="shop-wrapper">
      <form class="search-container submitFilter" action="{{route('product.all',['type' => $type])}}" method="get ">
        <div class="shop-panel" id="shopping-info-detail">

          <div class="product-filter-click"><i class="fa fa-filter"></i> {{__('filter')['title']}}</div>

          <div class="product-list-overlay ">
            <a class="close-filter"> <i class="fa fa-times" aria-hidden="true"></i></a>
              <div class="mobile-product-list">
                <div class="panel-box categories-list">
                  <div class="heading-md heading-line">{{__('categories')['bradcum']}}</div>
                    @include('frontend.partials.sidecategory')
                  </div>

                  <div class="panel-box sizes-list">
                  <div class="heading-md heading-line">{{__('product')['price_range']}}</div>

                  <div class="price-range my-3 d-flex justify-content-space-between align-items-center">
                      <span class="mx-2">Min.</span>
                      <input class="form-control minPrice" type="number" name="min" value="{{$min_price}}">
                      <span class="mx-2">Max.</span>
                      <input class="form-control maxPrice" type="number" name="max" value="{{$max_price}}">
                  </div>
                  <div class="mx-3 my-2">
                    <button type="button" onclick="filterPriceRange()"  class="price-range-button" name="button">Filter Price</button>
                  </div>

                </div>

                <div class="panel-box top-brand-list">
                  <div class="heading-md heading-line">{{__('homepage')['top_brands']}}</div>
                  <ul class="top-brand-select">
                    @foreach($topBrands as $brand)
                      <li>
                        <label class="check-label">{{$brand->name}}
                          <input type="radio" name="brands" value="{{$brand->id}}"  onchange="filterBrands(this.value)" @if(in_array($brand->id,$brandsArr)) checked @endif >
                          <span class="checkmark"></span>
                        </label>
                      </li>
                    @endforeach
                  </ul>
                </div>

                @if(isset($leftSideBanner) && isset($leftSideBanner->images[0]))
                  @include('frontend.partials.sideBanner',['image' => $leftSideBanner->images[0]->image,'link' => $leftSideBanner->images[0]->link])
                @endif

              </div>
          </div>
        </div>
      </form>

      <div class="shop-col " id="shopping-list">
        <div class="product-gird ">
          <ul class="product prod-grid-col4 ">
            @forelse($data as $value)
            @php

              $price = $value->price;
              $special = 0;
              $offTxt = '';
              $date = Carbon\Carbon::parse($value->created_at);
              $now = Carbon\Carbon::now();
              $diff = $date->diffInDays($now);

              if($value->special) {

                $endDate = Carbon\Carbon::createFromFormat('m/d/Y',$value->special->end_date);
                $startDate = Carbon\Carbon::createFromFormat('m/d/Y', $value->special->start_date);
                $todayDate = Carbon\Carbon::createFromFormat('m/d/Y', date('m/d/y'));
                if($startDate->gte($todayDate) && $todayDate->lte($endDate)) {
                  $special = $value->special->price;
                  $offTxt = calculatePercentage($price,$special);
                }
            }

              $stars = $value->review_avg  ? (int)$value->review_avg : 0;
              $starResult = "";
              for ( $i = 1; $i <= 5; $i++ ) {
                  if ( round( $stars - .25 ) >= $i ) {
                    $starResult .=   " <i class='fa fa-star'></i>";
                  } elseif ( round( $stars + .25 ) >= $i ) {
                        $starResult .=  " <i class='fa fa-star-half-o' ></i>";
                  } else {
                        $starResult .=  " <i class='fa fa-star' style='color:#BCC7D1'></i>";
                  }
              }
            @endphp

              <li>
                <div class="product-box mb-2 pb-1">
                  <a href="{{route('product.details',['id' => $value->id])}}" class="prod-img">
                    <img class="lazy"  data-original="{{asset('uploads')}}/product/{{$value->image}}" alt="" title="" />
                  </a>
                  <div class="quickview quickview-common ">
                    <div class="d-flex justify-content-center ">
                      <a href="javascript:void(0);" class="quickviewtext" data-product="{{$value->id}}">Quick View</a>
                    </div>
                  </div>

                  @if($value->quantity ==  0)
                    <span class="latest-badge out-stock">{{ __('common')['label_out_of_stock'] }}</span>
                  @elseif($value->quantity !=  0 && $offTxt == '' && $diff < 15 )
                    <span class="latest-badge ">{{ __('common')['label_new'] }}</span>
                  @elseif($value->quantity !=  0 && $offTxt != '')
                    <span class="latest-badge discount-badge">{{$offTxt}}</span>
                  @elseif($value->quantity !=  0 && $offTxt == '' && $diff > 15 && ((int)$value->viewed > 999 && (int)$value->viewed < 1200))
                    <span class="latest-badge trending-badge">{{ __('common')['trending'] }}</span>
                  @endif


                  <div class="floating-bar">
                    <div class="floating-add-to-cart  d-flex justify-content-center">
                      <input type="hidden" name="productID" value="{{$value->id}}">
                       <a href="" class="btn-add-to-cart  d-flex align-items-center">
                        <img src="{{asset('frontend')}}/images/add-to-cart.png" alt="" title="" class="add-to-cart-img" />
                      </a>
                    </div>
                      @if(Auth::guard('customer')->check())
                          @if(in_array($value->id, getWishlist()))
                          <div class="floating-wishlist fill-wishlist  d-flex justify-content-center">
                            <a href="javascript:void(0);" class="d-flex align-items-center" onclick="addToWish(this,'{{$value->id}}')">
                              <i class="fas fa-heart" ></i>
                            </a>
                          </div>
                          @else
                          <div class="floating-wishlist  d-flex justify-content-center">
                            <a href="javascript:void(0);" class=" d-flex align-items-center" onclick="addToWish(this,'{{$value->id}}')">
                              <img src="{{asset('frontend')}}/images/little-heart.png" alt="" title="" class="" />
                            </a>
                          </div>
                          @endif
                      @else
                      <div class="floating-wishlist  d-flex justify-content-center">
                          <a href="javascript:void(0);" class=" d-flex align-items-center" onclick="addToWish('{{$value->id}}')" >
                            <img src="{{asset('frontend')}}/images/little-heart.png" alt="" title="" class="" />
                          </a>
                        </div>
                      @endif
                  </div>


                  <!-- <a href="javascript:void(0);"  class="@if(Auth::guard('customer')->check() && in_array($value->id, getWishlist())) add-to-wishlist-fill @else  add-to-wishlist @endif wishlist{{$value->id}} wishlist{{$value->id}}" data-title="Add to Wishlist"  onclick="addToWish('{{$value->id}}')"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->

                  <div class="mx-2 mb-3 mt-4" >
                    <div class="product-detail mb-3">
                      <p class="modeltext mt-1  mb-1">{{$value->category?->name}}</p>
                      <a href="{{route('product.details',['id' => $value->id])}}" class="prod-title mb-3 ">{{Str::limit($value->productDescription?->name, 48, '...')}}</a>
                      <!-- <p class="modeltext mt-1  mb-3">{{$value->model}}</p> -->
                      @if($special > 0)
                        <div class="price">
                          <span class="specialPrice">{{config('settingConfig.config_currency')}}{{number_format($special,2)}}</span>
                          <span class="originalPrice">{{config('settingConfig.config_currency')}}{{number_format( $value->price,2)}}</span>
                        </div>
                      @else
                        <div class="price">{{config('settingConfig.config_currency')}}{{ $value->price}} <span class="offer">{{$offTxt}}</span></div>
                      @endif
                      <ul class="rating mt-3 ">
                        {!! $starResult !!}
                      </ul>
                  </div>

                  </div>

                </div>
              </li>
              @empty
              <div class="col-12 text-center">
                <div class="mt-5">
                </div>
                <img src="{{asset('frontend')}}/images/sad.png" alt="">
                <h3 class="notfoundtxt mt-5">{{ __('common')['product_not_found'] }}</h3>
              </div>

            @endforelse
          </ul>



          <div class="my-5">
            {{ $data->appends(['name' => request()->name])->links() }}
          </div>


        </div>
      </div>
    </div>

</section>
<!--==== END PRODUCT LISTING ====-->

@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/smk-accordion.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      //	FAQ
        $(".faq_accordion").smk_Accordion({
          closeAble: true, //boolean
          //closeOther: false, //boolean
          activeIndex: 2  //second section open
        });


        $(".submitFilter").submit(function(e){
            e.preventDefault();
            let val = $('.searchinput').val();
            var url =new URL(window.location.href);
            url.searchParams.append('search', val);
            let urlappends = url.href;
            let [path, params] = urlappends.split("?");
            let redirectURL = path + '?' + new URLSearchParams(Object.fromEntries(new URLSearchParams(params))).toString()
            window.location.replace(redirectURL);
        });
    });

    function filterSortBy(val) {
      var url =new URL(window.location.href);
      url.searchParams.append('sortby', val);
      let urlappends = url.href;
      let [path, params] = urlappends.split("?");
      let redirectURL = path + '?' + new URLSearchParams(Object.fromEntries(new URLSearchParams(params))).toString()
      window.location.replace(redirectURL);
    }

    function filterPriceRange() {
      var url =new URL(window.location.href);
      let priceMin = $('.minPrice').val();
      let priceMax = $('.maxPrice').val();
      let range = priceMin +'-'+priceMax;
      url.searchParams.append('priceRange', range);
      let urlappends = url.href;
      let [path, params] = urlappends.split("?");
      let redirectURL = path + '?' + new URLSearchParams(Object.fromEntries(new URLSearchParams(params))).toString()
      window.location.replace(redirectURL);
    }

    function filterBrands(val) {
      var url =new URL(window.location.href);
      const paramss = (url).searchParams;
      let findBrandParam = paramss.get('brands');

      if(findBrandParam != null) {

          if(findBrandParam.split(",")[0] == val) {
            findBrandParam =   findBrandParam.replace(new RegExp(val+',', "g"),'');
            url.searchParams.append('brands', findBrandParam);
          }
          else {

            let findValueExist = findBrandParam.indexOf(val);

            if(findValueExist != -1) {

              if(findBrandParam.length- 2 == findBrandParam.indexOf(val)) {
                findBrandParam =   findBrandParam.replace(new RegExp(val+',', "g"),'');
              }
              else {
                findBrandParam =   findBrandParam.replace(new RegExp(','+val, "g"),'');
              }

              url.searchParams.append('brands', findBrandParam);
            }
            else {
              url.searchParams.append('brands', findBrandParam+','+val);
            }
          }

      }
      else {
          url.searchParams.append('brands', val);
      }

      let urlappends = url.href;
      let [path, params] = urlappends.split("?");
      let redirectURL = path + '?' + new URLSearchParams(Object.fromEntries(new URLSearchParams(params))).toString()

      window.location.replace(redirectURL);
    }

</script>

<script>
      /*Responsive filter toggle*/
      $(".product-filter-click, .close-filter").click(function() {
          $(".product-filter-click, .product-list-overlay").toggleClass("active");
          if ($(".product-list-overlay").hasClass("active")) {
              $('html').addClass('filterhidden');
          } else {
              $('html').removeClass('filterhidden');
          }
      });

  </script>
@endpush
@endsection
