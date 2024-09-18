
<!--==== START New product ====-->
<section class="new-product  ">
  @if($type != 'releted')
    <div class="flex-wrapper title-row title-space my-1">
      <div class="cust_left">
        <div class="short-intro">
          <div class="heading-lg">@if($type == 'new') {{ __('homepage')['new_product'] }} @elseif($type == 'trending') {{ __('homepage')['trending_product'] }}  @elseif($type == 'releted') {{ __('product_details')['releted_products'] }} @elseif($type == 'featured') {{ __('homepage')['featured_products'] }} @endif</div>
        </div>
      </div>
      @if($type != 'featured' )
      <div class="cust_right">
        <a href="{{ route('product.all',['type' => $type]) }}" class="view_all">{{ __('homepage')['view_all_product'] }} <i class="fas fa-chevron-right mx-2"></i></a>
      </div>
      @endif
    </div>
    @endif

    <div id="@if($isSlider) new-product @endif" @if(!$isSlider) class="product-gird" @endif>
      <ul class="@if($isSlider) product new-product-js  slick-arrow @else product prod-grid-col5 @endif">
        @foreach($productsArr as $key=>$value)
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
            <div class="product-box my-2  py-1">
              <a href="{{route('product.details',['id' => $value->id])}}" class="prod-img">
                <img data-original="{{asset('uploads')}}/product/{{$value->image}}" class="lazy"  >
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
                  <a href="" class="btn-add-to-cart d-flex align-items-center">
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
                      <a href="{{route('product.details',['id' => $value->id])}}" class="prod-title mb-3 "> {{Str::limit($value->productDescription?->name, 48, '...')}}</a>
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

        @endforeach
      </ul>
    </div>

</section>
<!--==== End New product ====-->
