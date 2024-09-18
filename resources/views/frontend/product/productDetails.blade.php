@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/smk-accordion.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/proctuct-detail.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shop-listing.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/star-rating-svg.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/product-detail-extra.css">
@endpush

@section('content')

<!--==== START BREADCUMB ====-->
<section class="page-crumb">
        <ul class="cd-breadcrumb">
            <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
            <li class="current">{{ __('product_details')['title']}}</li>
        </ul>
</section>
<!--==== END BREADCUMB ====-->

<!--==== START PRODUCT LISTING ====-->
<section class="inner-wrapperr" id="shop-listing">
    <div class="">

        <div class="protdetail-container product-details">
            <div class="prod-silder">
                <div class="shopdetail_slider">
                  <div  @if(Session::get('locale') == 'ar') dir="rtl" @endif>
                    <ul class="js_product_mainslider">

                            <li>
                                <div class="imgmain">
                                    <img id="NZoomImg" data-NZoomscale="2" src="{{asset('uploads')}}/product/{{$data['product']->image}}" alt="" title="" />
                                </div>
                            </li>

                        @foreach($data['product_images'] as $key=>$value)
                            <li>
                                <div class="imgmain">
                                    <img src="{{asset('uploads')}}/product/{{$value->image}}" alt="" title="" />
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <ul class="js_product_thumbslider slicknav">

                            <li>
                                <div class="product_thumbitem">
                                    <img  src="{{asset('uploads')}}/product/{{$data['product']->image}}" alt="" title="" />
                                </div>
                            </li>

                        @foreach($data['product_images'] as $key=>$value)
                            <li>
                                <div class="product_thumbitem">
                                    <img src="{{asset('uploads')}}/product/{{$value->image}}" alt="" title="" />
                                </div>
                            </li>
                        @endforeach

{{--                        </li>--}}
                    </ul>
                  </div>
                </div>

                <!-- Start Social link -->
              @php
                $title = $data['product']->productDescription?->name;
                $short_url =url()->current();
                $url = url()->current();

               $twitter_params =
               '?text=' . urlencode($title) . '+-' .
               '&amp;url=' . urlencode($short_url) .
               '&amp;counturl=' . urlencode($url) .
               '';

               $link = "http://twitter.com/share" . $twitter_params . "";

                $text = $title.' Buy product now from here';
                $produtURL =url()->current();
                $wurl = "https://api.whatsapp.com/send?text=".urlencode($text.' URL:'.$produtURL);

                $stars = $data['avgReview'] ? (int)$data['avgReview'] : 0;
                $starResult = "";
                for ( $i = 1; $i <= 5; $i++ ) {
                    if ( round( $stars - .25 ) >= $i ) {
                      $starResult .=   " <i class='fa fa-star' ></i>";
                    } elseif ( round( $stars + .25 ) >= $i ) {
                          $starResult .=  " <i class='fa fa-star-half-o' ></i>";
                    } else {
                          $starResult .=  " <i class='fa fa-star' style='color:#BCC7D1'></i>";
                    }
                }
                @endphp
                <!-- End Social link -->
            </div>

            <div class="prod-detail">

                <div class=" heading-sm mb-4">{{$data['product']->productDescription?->name}}</div>
                <div class=" mb-4 row product-detail-info">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xs-6 col-sm-6 star-rating">
                          {!! $starResult !!} &nbsp {{(int)$data['avgReview']}} Reviews
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xs-6 col-sm-6 stock-status">
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xs-12 col-sm-6">
                        <div class="row">
                          <div class="col-6">
                            <button class="btn-add-to-wishlist d-flex justify-content-center" onclick="addToWish(this,'{{$data['product']->id}}',1)">
                              @if(Auth::guard('customer')->check())
                                @if(in_array($data['product']->id, getWishlist()))
                                  <i class="fa fa-heart" @if(session()->get('locale') == 'ar')  style="margin-left:10px;" @else style="margin-right:10px;" @endif></i>
                                @else
                                  <i class="fa fa-heart-o " @if(session()->get('locale') == 'ar')  style="margin-left:10px;" @else style="margin-right:10px;" @endif></i>
                                @endif
                                @else
                                  <i class="fa fa-heart-o " @if(session()->get('locale') == 'ar')  style="margin-left:10px;" @else style="margin-right:10px;" @endif></i>
                              @endif
                                {{ __('common')['wishlist']}}
                              </button>
                              <input type="hidden" id="showshare" name="" value="0">
                          </div>
                          <div class="col-6 ">
                            <button onclick="showShareOptions()" class="btn-share d-flex justify-content-center mx-3"> <i class="fas fa-share-alt " @if(session()->get('locale') == 'ar')  style="margin-left:10px;" @else style="margin-right:10px;" @endif></i>   {{ __('product_details')['share']}}</button>
                            <div class="ctnect-link  justify-content-end  d-none ">
                                <ul class="social-link">
                                    <li><a href="https://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
                                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}"  target="_blank" class="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i> </a> </li>
                                    <li><a href="{{$link}}" class="twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> </a> </li>
                                    <li><a href="{{$wurl}}" data-action="share/whatsapp/share" target="_blank" class="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
                                </ul>
                            </div>
                          </div>
                        </div>


                  </div>
                </div>



            <form action="" method="post">
                @csrf
                      @php
                        $price =$data['product']->price;
                        $special = 0;
                        $offTxt = '';
                        if($data['product']->special) {
                          $endDate = Carbon\Carbon::createFromFormat('m/d/Y',$data['product']->special->end_date);
                          $startDate = Carbon\Carbon::createFromFormat('m/d/Y', $data['product']->special->start_date);
                          $todayDate = Carbon\Carbon::createFromFormat('m/d/Y', date('m/d/y'));
                          if($startDate->gte($todayDate) && $todayDate->lte($endDate)) {
                            $special = $data['product']->special->price;
                            $offTxt = calculatePercentage($price,$special);
                          }
                      }

                      @endphp
                      <div class="price-wrap">
                      @if($special > 0 )
                        <input type="hidden" id="orignalPrice" name="orignalPrice" value="{{$data['product']->price}}">
                        <div class="price">{{ __('product_details')['price']}}: <span id="priceproduct">{{config('settingConfig.config_currency')}}{{  $special > 0 ? number_format($special,2) : number_format($data['product']->price,2)}}</span>
                          <span class="originalPrice" >{{config('settingConfig.config_currency')}}{{$price}}</span>
                          <span class="offer" style="font-size:16px;">{{$offTxt}}</span>
                        </div>
                      @else
                        <input type="hidden" id="orignalPrice" name="orignalPrice" value="{{$price}}">
                        <div class="price"> <span id="priceproduct">{{config('settingConfig.config_currency')}}{{$price}}</span></div>
                      @endif

                </div>

                <div class="product-short-desc  my-2">
                  <span>{!! $data['product']->productDescription?->short_description !!}</span>
                </div>

                <ul class=" prod-all-deatil @if($data['productOptions'] > 0) mt-5 @else mt-2 @endif">

                      @foreach($data['productOptions'] as $key=>$option)
                         @php $title = explode('-',$key); @endphp

                        <li>
                            <div class="probox ">
                                <div class="prod-head mb-3 ">{{$title[1]}}: @if($title[0] !='Color' )<span class="optionSelected{{$key}}"></span>@endif</div>
                                  <div class="prod-info">
                                    @if($title[0] == 'Select')
                                    <select name="{{$key}}" id="select{{$data['product']->id}}"  class="form-control size_id" >
                                        <option value="">Select Size</option>
                                        @forelse($data['productOptions'][$key] as $key2=>$optionValues)
                                                <option value="{{$optionValues->product_option_id}}">{{$optionValues->label}} (+{{$optionValues->price}})</option>
                                        @empty
                                            <option value="">No Size</option>
                                        @endforelse
                                    </select>

                                      @elseif($title[0] == 'Checkbox')
                                       <div class="row">
                                        @foreach($data['productOptions'][$key] as $key2=>$optionValues)

                                          @if(strlen($optionValues->label) < 3)
                                            <div class="col-md-1 col-1 col-sm-1  col-lg-1">
                                              <label class="check-label">
                                                <input type="radio" class="option-checkbox" name="{{$key}}" value="{{$optionValues->product_option_id}}"  onchange="changePrice('{{$optionValues->price}}','Checkbox','{{$optionValues->label}}',0,null,'{{$key}}')" >
                                                <span class="checkmark-round">{{$optionValues->label}}</span>
                                              </label>
                                            </div>
                                          @else
                                            <div class="col-md-4 col-sm-4  col-lg-4">
                                              <label class="check-label">{{$optionValues->label}} @if($optionValues->price > 0) (+{{$optionValues->price}}) @endif
                                                <input type="radio" class="option-checkbox"  name="{{$key}}" value="{{$optionValues->product_option_id}}"  onchange="changePrice('{{$optionValues->price}}','Checkbox','{{$optionValues->label}}',0,null,'{{$key}}')" >
                                                <span class="checkmark"></span>
                                              </label>
                                            </div>
                                          @endif

                                        @endforeach
                                      </div>


                                      @elseif($title[0] == 'Radio')
                                        <div class="row">
                                          @foreach($data['productOptions'][$key] as $key2=>$optionValues)
                                          @if(strlen($optionValues->label) < 3)
                                              <div class="col-md-1 col-1 col-sm-1  col-lg-1">
                                                <label class="check-label">
                                                  <input type="radio" class="option-radio" name="optionRadio" value="{{$optionValues->product_option_id}}"  onchange="changePrice('{{$optionValues->price}}','Radio','{{$optionValues->label}}',0,null,'{{$key}}')" >
                                                  <span class="checkmark-round">{{$optionValues->label}}</span>
                                                </label>
                                              </div>
                                            @else
                                              <div class="col-md-4 col-sm-6  col-lg-4">
                                                  <label class="check-label">{{$optionValues->label}} @if($optionValues->price > 0) (+{{$optionValues->price}}) @endif
                                                    <input type="radio" class="option-radio" name="optionRadio" value="{{$optionValues->product_option_id}}"  onchange="changePrice('{{$optionValues->price}}','Radio','{{$optionValues->label}}',0,null,'{{$key}}')"   >
                                                    <span class="checkmark"></span>
                                                  </label>
                                                </div>
                                              @endif
                                          @endforeach

                                        </div>

                                        @elseif($title[0] == 'Color')
                                          <div class="row">
                                            @foreach($data['productOptions'][$key] as $key2=>$optionValues)
                                              <div class="col-md-1 col-1 col-sm-1  col-lg-1">
                                                <label class="check-label">
                                                  <input type="radio" name="optionColor" value="{{$optionValues->product_option_id}}"  onchange="changePrice('{{$optionValues->price}}','Color','',0,this,'{{$key}}')" >
                                                  <span class="checkmark-round color-checkmark" style="background:{{$optionValues->color_code}}" ></span>
                                                {{--<p> @if($optionValues->price > 0) (+{{$optionValues->price}}) @endif</p>--}}
                                                </label>
                                              </div>
                                            @endforeach
                                          </div>
                                        @endif

                                  </div>
                            </div>
                        </li>

                      @endforeach

                      </ul>


                <ul class="mt-5  ">
                  <li > <span class="heading-xs ">Availibility: <span class="info @if($data['product']->quantity > 0 ) greenclr @else redclr @endif">{{$data['product']->quantity > 0 ?  __('product_details')['instock'] :  __('common')['label_out_of_stock']}}</span></span> </li>
                  <li class="my-1"> <span class="heading-xs ">Cateory: <span class="themeTxt">{{$data['product']->category?->name}}</span></span> </li>
                  <li class="my-1"> <span class="heading-xs ">Brand: <span class="themeTxt">{{$data['product']->productManufacturer->name}}</span></span> </li>
                  <li > <span class="heading-xs ">SKU: <span class="themeTxt">{{$data['product']->sku}}</span></span> </li>
                </ul>
                <div class="quantity-wrap">
                    <div class="quantitybox d-flex justify-content-center align-items-center">
                      <div class="value-button decrease" onclick="decreaseValue($(this))" value="Decrease Value">
                        <i class="fas fa-sharp fa-regular fa-minus"></i>
                      </div>
                        <div class="quantity ">
                            <label class="screen-reader-text" >Sponge Float dense sponge 40mm with long edge quantity</label>
                            <input type="number" class="input-text qty text" step="1" min="1" max="100" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
                        </div>
                        <div class="value-button increase"  onclick="increaseValue($(this))" value="Increase Value">
                          <i class="fas fa-sharp fa-regular fa-plus"></i>
                        </div>
                    </div>
                    <input type="hidden" name="productID" value="{{$data['product']->id}}">
                    <!-- <input type="submit" class="add-to-cart" value="Add to Cart"> -->
                    <button  class="add-to-cart">{{ __('product_details')['add_to_cart']}}  </button>
                    <button  class="add-to-cart buy-now">{{ __('account')['buy_now']}}  </button>
                </div>
            </form>


            </div>
        </div>


        <div class="container-fluid">
          <ul class="nav nav-tabs " role="tablist">
              <li class="nav-item " @if(app()->getLocale() == 'en') style="margin-right:10px;" @else style="margin-left:10px;" @endif>
                <a  onclick="activeTabGetData(this,'detail')" class="nav-link  active " rel="prd-detail" data-toggle="tab"  role="tab" >
                  {{ __('product_details')['title']}}
                </a>
              </li>
              <li class="nav-item " @if(app()->getLocale() == 'en') style="margin-right:10px;" @else style="margin-left:10px;" @endif>
                <a onclick="activeTabGetData(this,'reviews')" class="nav-link   " rel="prd-reviews" data-toggle="tab"  role="tab" >
                  {{ __('product_details')['review']}}
                </a>
              </li>
              @if(count($data['releted_products']) > 0)
                <li class="nav-item " @if(app()->getLocale() == 'en') style="margin-right:10px;" @else style="margin-left:10px;" @endif>
                  <a onclick="activeTabGetData(this,'related')" class="nav-link   " data-toggle="tab"  role="tab" >
                    {{ __('product_details')['releted_products']}}
                  </a>
                </li>
              @endif
              @if(count($data['productAttributes']) > 0)
                <li class="nav-item " @if(app()->getLocale() == 'en') style="margin-right:10px;" @else style="margin-left:10px;" @endif>
                  <a onclick="activeTabGetData(this,'product_specification')" class="nav-link   " data-toggle="tab"  role="tab" >
                    {{ __('product_details')['product_specification']}}
                  </a>
                </li>
              @endif
          </ul>

              <div class="tab-content clearfix my-3">

                      <div id="prd-detail" class="tab-pane active " rel="prd-detail" role="tabpanel">
                        <div class="prod-description-wrappers p-3">

                          {!! html_entity_decode($data['product']->productDescription?->description) !!}
                        </div>
                      </div>

                      <div id="prd-reviews" class="tab-pane" rel="prd-reviews">
                        <div class="overall-ratting">
                            <div class="rating-left">
                                <div class="ratting-inner">
                                    <div class="ratingtxt">{{ __('product_details')['overall_rating']}}</div>
                                    <div class="rate-prod">{{$data['avgReview'] }}</div>
                                    <div class="my-rating-6"></div>
                                    <p>{{ __('product_details')['based_on']}} {{$data['totalReviews']}} {{ __('product_details')['review']}}</p>
                                </div>
                            </div>
                            <div class="rating-right">
                                <div class="progress-col">
                                    <div class="progress-title">{{ __('product_details')['excellent']}}</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$data['star5']}}%">
                                        </div>
                                    </div>
                                </div>

                                <div class="progress-col">
                                    <div class="progress-title">{{ __('product_details')['good']}}</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$data['star4']}}%"></div>
                                    </div>
                                </div>

                                <div class="progress-col">
                                    <div class="progress-title">{{ __('product_details')['avg']}}</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-in" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$data['star3']}}%">
                                        </div>
                                    </div>
                                </div>

                                <div class="progress-col">
                                    <div class="progress-title">{{ __('product_details')['poor']}}</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$data['star2']}}%">
                                        </div>
                                    </div>
                                </div>

                                <div class="progress-col">
                                    <div class="progress-title">{{ __('product_details')['very_bad']}}</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: {{$data['star1']}}%"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

              <div class="review_wrapper">
                @forelse($data['reviews_text'] as $key=>$review)
                  <div class="reviewbox">
                    <div class="review-info">
                      <div class="writer-img">
                          <img src="@if($review->image != null)
                              {{asset('uploads')}}/user/{{$review->image}}
                            @else
                              {{asset('frontend')}}/images/profile.png
                            @endif
                            " alt="" title="">
                      </div>
                      <div class="writer-info">
                        <div class="name">{{$review->firstname}} </div>
                        <div class="deg">
                            <div class="my-rating-{{$review->id}}" ></div>
                        </div>
                      </div>
                    </div>
                    <div class="review-cont">
                      <p>{{$review->text}}</p>
                    </div>
                  </div>
                @empty
                  <h4 class="text-center text-black">{{ __('product_details')['review_not']}}</h4>
                @endforelse
                </div>
                </div>
                @if(count($data['releted_products']) > 0)
                  <div id="prd-related" class="tab-pane" rel="prd-related">
                      @include('frontend.partials.homeproduct',['isSlider' => false,'type' => 'releted','title' => "Flash Sale For You!", 'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.",'productsArr' =>$data['releted_products'],'new' => false])
                  </div>
                @endif
                @if(count($data['productAttributes']) > 0)
                <div id="prd-product_specification" class="tab-pane  " rel="prd-detail" role="tabpanel">
                  @foreach($data['productAttributes'] as $key=>$productattribute)
                    <div class="product-specification my-4">
                        <div class="heading-sm">{{$key}}</div>
                        @foreach($productattribute as $key=>$attribute)
                          <div class="row ">
                            <div class="col-md-2 col-xl-2 col-lg-2 ">
                                <span class="attribute_name">{{$attribute['name']}}</span>
                            </div>
                            <div class="col-md-1 col-xl-1 col-lg-1">
                                <span class="attribute_name">:</span>
                            </div>
                            <div class="col-md-7 col-xl-7 col-lg-7 ">
                                <span class="attribute_name">{{$attribute['text']}}</span>
                            </div>
                          </div>
                        @endforeach
                    </div>
                  @endforeach
                </div>
                @endif

              </div>
            </div>




    </div>
</section>
<!--==== END PRODUCT LISTING ====-->

@push('js')

    <script type="text/javascript" src="{{ asset('frontend') }}/js/smk-accordion.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.star-rating-svg.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/Nzoom.min.js"></script>

    <script type="text/javascript">
      localStorage.clear();
        $(document).ready(function() {
            //	FAQ
            $(".faq_accordion").smk_Accordion({
                closeAble: true, //boolean
                //closeOther: false, //boolean
                activeIndex: 2  //second section open
            })


        });

    </script>
    <script type="text/javascript">
        $(function (){



          $(".my-rating-6").starRating({
            totalStars: 5,
            emptyColor: 'lightgray',
            hoverColor: 'slategray',
            activeColor: '#0d6efd',
            initialRating: parseFloat("{{$data['avgReview']}}"),
            strokeWidth: 0,
            readOnly: true,
            useGradient: false,
            minRating: 1,
            callback: function(currentRating, $el){
            }
          });
          <?php foreach($data['reviews_text'] as $review) { ?>
            $(".my-rating-"+'<?php echo $review->id; ?>').starRating({
              totalStars: 5,
              starSize:20,
              emptyColor: 'lightgray',
              hoverColor: 'slategray',
              activeColor: '#3AD35C',
              initialRating: parseFloat("{{$review->rating}}"),
              strokeWidth: 0,
              readOnly: true,
              useGradient: false,
              minRating: 1,
              callback: function(currentRating, $el){
              }
            });

          <?php } ?>



            $('.size_id').change(function () {

                var id = $(this).val();
                var url = '{{ route("product.price", ":id") }}';
                url = url.replace(':id', id);

                let orignalPrice = $('#orignalPrice').val();
                 orignalPrice = parseFloat(orignalPrice);

                 let productPrice = $('#priceproduct').text().replace(/^\D|,+/g, '');
                 productPrice = parseFloat(productPrice);

                if(id == null || id == ""){
                  let nPrice = orignalPrice;
                  $('#priceproduct').text("{{config('settingConfig.config_currency')}}"+nPrice.toFixed(2))
                  localStorage.setItem('select',0);
                }

                else{
                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                          var additionalPrice = response.price;

                            if (response != null) {
                                if(additionalPrice == null || additionalPrice == 0 || id == "" ){
                                    $('#priceproduct').text(orignalPrice);
                                    localStorage.setItem('select',0);
                                }else{
                                  //  let price = Number.parseFloat(orignalPrice) + Number.parseFloat(additionalPrice);
                                    let price = Number.parseFloat(additionalPrice);
                                    let newPrice = productPrice;
                                    if(price > 0) {
                                      newPrice += Number.parseFloat(price)
                                    }

                                    let getTypePrice = localStorage.getItem('select');
                                    if(getTypePrice > 0) {
                                       newPrice -= getTypePrice
                                    }
                                    localStorage.setItem('select', additionalPrice);

                                   $('#priceproduct').text("{{config('settingConfig.config_currency')}}"+newPrice.toFixed(2))
                                }
                            }
                            else{
                                alert("Error");
                            }
                        }
                    });
                }
            })
        })

        function showShareOptions() {
          let shareStatus = $('#showshare').val();
          if(shareStatus == 1) {
            $('#showshare').val(0)
            $('.ctnect-link').addClass('d-none');
          }
          else {
            $('#showshare').val(1)
            $('.ctnect-link').removeClass('d-none');
          }
        }

        function activeTabGetData(data,category){

           //find active
           var activeTab = $("ul.nav-tabs li a.active");

           activeTab.removeClass('active');
           $(data).addClass('active');

           //find acitve tab content
           var activeTabContent = $("div.tab-content .active");
           activeTabContent.removeClass('active');
           $('#prd-'+category).addClass('active');
        }


    </script>
@endpush
@endsection
