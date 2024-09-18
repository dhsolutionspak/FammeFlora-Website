@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/smk-accordion.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shopping-table.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shop-listing2.css">
@endpush

@section('content')
<!--==== START BREADCUMB ====-->
<section class="page-crumb">

        <ul class="cd-breadcrumb">
          <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
            <li class="current">{{ __('cart')['title']}}</li>
        </ul>

</section>
<!--==== END BREADCUMB ====-->


<!--==== START PRODUCT LISTING ====-->
<section class="" id="shop-listing">

        @if($status  == 1)
        <!-- Shopping cart -->
        <div class="shopping-wrapper">
            <div class="shop-left">
                <div class="shopping-cart">
                  <div class="column-labels text-center">
                      <label class="product-image">{{ __('cart')['image']}}</label>
                      <label class="product-details">{{ __('cart')['product_name']}}</label>
                      <label class="product-quantity">{{ __('order_details')['quantity']}}</label>
                      <label class="product-price">{{ __('cart')['total_price']}}</label>
                  </div>
                    @forelse($cartData as $value)
                    <div class="product shopping-box cart{{$value['cart_id']}}">
                        <button onclick="deleteCart(this,'{{$value['cart_id']}}')" class="remove" aria-label="Remove this item"  title="Delete Item From Cart" style="border:0;    z-index: 11;">×</button>
                        <div class="product-image">
                            <img class="lazy" data-original="{{asset('uploads')}}/product/{{$value['image']}}" class="product-thumbnail-img" alt="Men Pants 01" >
                        </div>
                        <div class="product-details product-name shoppingcart">
                            <a href="{{route('product.details',['id' => $value['pid']])}}" class="product-title text-center">{{$value['name']}}</a>
                            <div class="product-info my-1">
                              <div class="d-flex justify-content-center cart-product-detail  mx-5 my-2 my-md-0 my-lg-0 my-xl-0">
                                  <span class="w-50 cart-label-left">{{ __('product_details')['model']}}:</span>
                                  <span class="w-50 cart-label-right">{{$value['model']}}</span>
                              </div>
                            </div>
                            <div class="product-info my-1">
                              <div class="d-flex justify-content-center cart-product-detail my-2 my-md-0 my-lg-0 my-xl-0 mx-5">
                                  <span class="w-50 cart-label-left">{{ __('cart')['unit_price']}}:</span>
                                  <span class="w-50 cart-label-right unitprice{{$value['cart_id']}}">{{config('settingConfig.config_currency')}}{{$value['price']}}</span>
                              </div>
                            </div>

                            @if(isset($value['options']) && count($value['options']) > 0)
                              @foreach($value['options'] as $key=>$option)

                                <div class="product-info my-1">
                                  <div class="d-flex justify-content-center mx-5">
                                    <span class="w-50 cart-label-left">{{$option['name']}}:</span>
                                    <span class="w-50 cart-label-right">{{$option['label']}}   @if($option['price'] > 0 )(+{{config('settingConfig.config_currency')}}{{$option['price']}})@endif</span>
                                  </div>
                                </div>
                              @endforeach
                            @endif
                         </div>

                        <div class="product-quantity ">
                            <div class="quantitybox2">
                                <div class="quantity2">
                                    <label class="screen-reader-text" >Sponge Float dense sponge 40mm with long edge quantity</label>
                                    <input type="number"  class="input-text qty text" step="1" min="1" max="100" name="quantity" value="{{ $value['quantity'] }}" title="Qty" size="4" placeholder="" inputmode="numeric" />
                                </div>
                                <div class="value-button2 increase"  onclick="increaseValue($(this))" value="Increase Value">
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </div>
                                <div class="value-button2 decrease"  onclick="decreaseValue($(this))" value="Decrease Value">
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </div>
                            </div>
                            <button onclick="updateQty(this,'{{$value['cart_id']}}')" class="quantity-referesh" style="border:0;"><img src="{{ asset('frontend') }}/images/spinner.png" alt="" title="" /> </button>
                        </div>

                        <div class="product-price">
                            <span class="product-price-amount mx-3 amount totalPrice{{$value['cart_id']}}">{{config('settingConfig.config_currency')}}{{ $value['totalPrice'] }}</span>
                        </div>
                    </div>
                      @empty
                    @endforelse
                    <div class="text-left">
                       <a href="{{url('/')}}" class="button-white">{{ __('checkout')['continue_shopping']}}</a>
                    </div>

                </div>
            </div>
            <div class="shop-right">
                <div class="summary-detail shipping-detail">
                    <div class="shipping-summary">
                        <div class="heading-md heading-line head-line">{{ __('checkout')['order_summary']}}</div>

                        <div class="shipping-accordion">
                            <div class="accordion_in">
                                <div class="acc_head">
                                    <h3>{{ __('cart')['enter_coupon']}}</h3>
                                </div>
                                <div class="acc_content">
                                    <form action="#" class="coupon_input">
                                        <input type="text" class="form-control" id="coupon_input" placeholder="{{ __('cart')['enter_coupon']}}" value="@if($couponData) {{$couponData->coupon_code}} @endif">
                                        <input type="submit" onClick='applyCoupon()'  value="{{ __('cart')['apply']}}" class="btn-subscribe">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="summary-total">
                        <li>
                            <div class="total-box">
                                <div class="summary-title">{{ __('cart')['sub_total']}}:</div>
                                <div class="summary-price subTotal">{{config('settingConfig.config_currency')}}{{$subTotal}}</div>
                            </div>
                        </li>
                    
                        <li>
                            <div class="total-box discount-box">
                                <div class="summary-title">{{ __('order_details')['discount']}}:</div>
                                <div class="summary-price discountAmt">{{config('settingConfig.config_currency')}}{{ number_format($discountAMT,2) }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="total-box grand-total">
                                <div class="summary-title">{{ __('cart')['grand_total']}}:</div>
                                <div class="summary-price grandTotal"> {{config('settingConfig.config_currency')}}{{$grandTotal}} </div>
                            </div>
                        </li>
                    </ul>

                    <div class="summary-massage ">
                        <div class="discount-message @if(!$couponData)  d-none @endif">
                          @if($couponData)
                            You Save {{number_format($discountAMT,2)}}
                            @if($couponData->coupon_type == 1)
                              (discount {{config('settingConfig.config_currency')}}{{number_format($couponData->amount,2)}}%)
                            @endif
                          @endif
                        </div>

                        <a href="{{route('checkout')}}" class="button-block button-place">{{ __('cart')['checkout']}}</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Shopping cart -->
        @endif
          <div class="text-center empty-cart   @if($status  == 1) d-none @endif ">
              <img src="{{asset('frontend')}}/images/empty-cart.png" alt="empty-cart" >
              <h3 class="notfoundtxt mt-5">{{ __('cart')['empty']}}</h3>
              <a href="{{ url('/') }}" class="button-block my-5"> {{ __('cart')['shop_now']}} </a>
          </div>
</section>
<!--==== END PRODUCT LISTING ====-->

@endsection


<!-- JS (ADD HERE TO REDUCE PAGE LOAD) -->
@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/table.js"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/js/smk-accordion.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".shipping-accordion").smk_Accordion({
            closeAble: true, //boolean
            //closeOther: false, //boolean
            activeIndex: 1  //second section open
        });
    });
</script>
@endpush
