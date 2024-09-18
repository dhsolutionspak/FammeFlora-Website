@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shopping-table.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shop-listing2.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/star-rating-svg.css">


@endpush

@section('content')

<!--==== START BREADCUMB ====-->
<section class="page-crumb">
  <div class="otrixcontainer">
    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
      <li><a href="{{route('get-orders')}}">{{ __('account')['label_order']}}</a></li>
      <li class="current">{{ __('order_details')['title']}}</li>
    </ul>
    <div class="heading-xs my-2">{{ __('order_details')['title']}}</div>
  </div>
</section>
<!--==== END BREADCUMB ====-->

<!--==== START MAIN ====-->
<section class="mt-3" id="shop-listing">
  <div class="row">
      <div class="col-md-2 col-xl-2 col-lg-2 col-sm-4">
          <div class="order-box d-flex justify-content-center">
              <p>{{ __('order_details')['order']}}</p>
              <span>#{{$order->id}}</span>
          </div>
      </div>
      <div class="col-md-2 col-xl-2 col-lg-2 col-sm-4">
          <div class="order-box d-flex justify-content-center">
              <p>{{ __('order_details')['order_date']}}</p>
              <span>{{date('d M Y',strtotime($order->order_date))}}</span>
          </div>
      </div>
      <div class="col-md-2 col-xl-2 col-lg-2 col-sm-4">
          <div class="order-box d-flex justify-content-center">
              <p>{{ __('order_details')['order_total']}}</p>
              <span>{{config('settingConfig.config_currency')}}{{number_format($order->grand_total,2)}}</span>
          </div>
      </div>
      <div class="col-md-2 col-xl-2 col-lg-2 col-sm-4">
          <div class="order-box d-flex justify-content-center">
              <p>Status</p>
              <span>{{$order->orderStatus ?  $order->orderStatus->name : 'N/A'}}</span>
          </div>
      </div>
      <div class="col-md-2 col-xl-2 col-lg-2 col-sm-4">
          <div class="order-box d-flex justify-content-center">
              <p>Payment Method</p>
              <span>{{$order->payment_method}}</span>
          </div>
      </div>
        <div class="col-md-2 col-xl-2 col-lg-2 col-sm-4">
          <div class="order-box d-flex justify-content-center">
              <p>Shipping Method</p>
              <span>{{$order->shipping_method}}</span>
          </div>
      </div>
  </div>

  <div class="row my-3">
    <div class="col-md-4 col-xl-4 col-lg-4 col-sm-12">
        <div class="order-detail-box box-summary ">
            <div class="title p-2">
                <img src="{{ asset('frontend') }}/images/wallet.png" alt="">
                <p class="mx-3">{{ __('order_details')['order_summary']}}</p>
            </div>
            <div class="row px-2 o-details mt-3">
              <div class="col-md-5 col-xl-5 col-lg-5">
                <p class="text-left">{{ __('cart')['sub_total']}}</p>
              </div>
              <div class="col-md-1 col-xl-1 col-lg-1 one-column">
                  <span class="dot">:</span>
              </div>
              <div class="col-md-5 col-xl-5 col-lg-5">
                <span>{{config('settingConfig.config_currency')}}{{number_format($order->total,2)}}</span>
              </div>
            </div>
            <div class="row px-2 o-details mt-3">
              <div class="col-md-5 col-xl-5 col-lg-5">
                <p class="text-left">{{ __('order_details')['shipping_charge']}}</p>
              </div>
              <div class="col-md-1 col-xl-1 col-lg-1 one-column">
                  <span class="dot">:</span>
              </div>
              <div class="col-md-5 col-xl-5 col-lg-5">
                <span>{{config('settingConfig.config_currency')}}{{number_format($order->shipping_charge,2)}}</span>
              </div>
            </div>

            @forelse($orderTaxes as $tax)
              <div class="row px-2 o-details mt-3">
                <div class="col-md-5 col-xl-5 col-lg-5">
                  <p class="text-left">{{$tax->tax_name}}</p>
                </div>
                <div class="col-md-1 col-xl-1 col-lg-1 one-column">
                    <span class="dot">:</span>
                </div>
                <div class="col-md-5 col-xl-5 col-lg-5">
                  <span>{{config('settingConfig.config_currency')}}{{$tax->tax_amount}}</span>
                </div>
              </div>
            @empty
            @endforelse


            <div class="row px-2 o-details mt-3">
              <div class="col-md-5 col-xl-5 col-lg-5">
                <p class="text-left">{{ __('order_details')['discount']}}</p>
              </div>
              <div class="col-md-1 col-xl-1 col-lg-1 one-column">
                  <span class="dot">:</span>
              </div>
              <div class="col-md-5 col-xl-5 col-lg-5">
                <span>{{config('settingConfig.config_currency')}}{{$order->discount}}</span>
              </div>
            </div>
            <div class="row px-2 o-details mt-3">
              <div class="col-md-5 col-xl-5 col-lg-5">
                <p class="text-left">{{ __('order_details')['order_total']}}</p>
              </div>
              <div class="col-md-1 col-xl-1 col-lg-1 one-column">
                  <span class="dot">:</span>
              </div>
              <div class="col-md-5 col-xl-5 col-lg-5">
                <span>{{config('settingConfig.config_currency')}}{{number_format($order->grand_total,2)}}</span>
              </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-4 col-lg-4 col-sm-12">
        <div class="order-detail-box">
            <div class="title p-2">
                <img src="{{ asset('frontend') }}/images/truck.png" alt="">
                <p class="mx-3">Shipping Address</p>
            </div>
            <p class='addressItem px-5'>{{$order->shipping_name}}, {{$order->shipping_address_1}}, {{$order->shipping_address_2}} </p>
            <span class='py-3 px-5'>Postcode: {{$order->shipping_postcode}}</span>
            <br>
            <span class='py-3 px-5'>City: {{$order->shipping_city}}</span>
            <br>
        </div>
    </div>

    <div class="col-md-4 col-xl-4 col-lg-4 col-sm-12">
        <div class="order-detail-box">
            <div class="title p-2">
                <img src="{{ asset('frontend') }}/images/bill.png" alt="">
                <p class="mx-3">Billing Address</p>
            </div>
            <p class='addressItem px-5'>{{$order->billing_name}}, {{$order->billing_address_1}}, {{$order->billing_address_2}} </p>
            <span class='py-3 px-5'>Postcode: {{$order->billing_postcode}}</span>
            <br>
            <span class='py-3 px-5'>City: {{$order->billing_city}}</span>
            <br>
        </div>
    </div>

  </div>


      <div class="orderlist my-3 orderdetailstable">
        <div class="table-responsive-sm">
          <table class="table table-borderless">
            <thead>
             <tr>
               <th scope="col" width="35%">Product</th>
               <th scope="col" width="10%">{{ __('order_details')['quantity']}}</th>
               <th scope="col" width="10%">{{ __('product_details')['price']}}</th>
               <th scope="col" width="10%">{{ __('orders')['order_status']}}</th>
               <th scope="col" width="10%">{{ __('cart')['total_price']}}</th>
               <th scope="col" width="30%">{{ __('account')['action']}}</th>
             </tr>
           </thead>
           <tbody>
             @forelse($order->products as $key=>$product)
             @php
               $productDetails = getProductOptions($product->product_id);
             @endphp
               <tr>
                 <td>
                   <div class="d-flex justify-content-start align-items-center">

                      <img src="{{asset('/uploads')}}/product/{{$product->image}}" alt="" class="order-detail-product-image">
                      <div class="flex-column">
                        <span class="mx-3"> {{$product->name}}</span>
                        @if($productDetails['options'])
                          @foreach( $productDetails['options'] as $option)
                            <div class="mx-3 my-2 d-flex flex-row">
                              <div class="p-1 optiontitle ">{{$option['name']}}:</div>
                              <div class="p-1 text-bold optionlabel " >{{$option['label']}} @if($option['price'] > 0 ) (+{{config('settingConfig.config_currency')}}{{$option['price'] * $product->quantity}})@endif</div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                   </div>

                 </td>
                 <td class="" >
                        {{$product->quantity}}x
                </td>
                 <td>{{config('settingConfig.config_currency')}} {{number_format($product->price,2)}}</td>
                 <td>{{$order->orderStatus ? $order->orderStatus->name : 'N/A'}}</td>
                 <td>{{config('settingConfig.config_currency')}} {{number_format($product->total,2)}}</td>
                 <td>
                   <a href="{{url('product')}}/{{$product->product_id}}" class="button-purple btn-sm ">{{ __('orders')['buy_again']}}</a>
                   <a href="javascript:void(0)" onclick="showRateModel('{{$product->product_id}}')" class="button-block-rate btn-block-rate btn-sm ">{{ __('order_details')['rate_this_product']}}</a>
                 </td>
               </tr>
              @empty
                <tr colspan="5">
                  <h4 class="p-5 text-center text-black">{{ __('account')['order_not']}}</h4>
                </tr>
             @endforelse
           </tbody>
          </table>
        </div>
      </div>



</section>
<!--==== END MAIN ====-->

{{-- Review  Modal--}}
<div class="modal fade " id="rate-modal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalaria" aria-hidden="true">
		<div class="  modal-lg modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header border-bottom-0 ">
								<h5></h5>
                <button type="button" onclick="closeRateModel()" class="btn btn-outline-primary btn-md" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" > &times;</span>
                </button>
						</div>
						<div class="modal-body mt-1">
              <form  method="POST" action="{{route('submit.review')}}">
                  <h3 class="m-3 text-center">{{ __('order_details')['rate_this_product']}}</h3>
                  @csrf
                  <div class="d-flex justify-content-center my-3 ">
                    <div class="rating text-center p-2"> </div>
                     <span class="live-rating text-center" ></span>
                     <input type="hidden" name="rating" value="" id="review">
                     <input type="hidden" name="product_id" value="" id="productid">
                  </div>
                  <div class="form-group">
                      <label for="firstName">{{ __('order_details')['rate_text']}} </label>
                      <textarea class="form-control" name="text" placeholder="{{ __('order_details')['rate_text']}} " name="ra" rows="8" cols="80"></textarea>
                  </div>
                  <div class="d-flex justify-content-center my-3">
                    <button type="submit" class="button-block btn-lg" name="button">{{ __('order_details')['rate_product_now']}}</button>
                  </div>
              </form>
						</div>
				</div>
		</div>
</div>
{{-- End Stripe Modal--}}

@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.star-rating-svg.js"></script>
<script type="text/javascript">
  function closeRateModel() {
    $('#rate-modal').modal('hide')
  }
  function showRateModel(productID){

    $('#productid').val(productID)
    $(".rating").starRating({
      totalStars: 5,
      emptyColor: 'lightgray',
      hoverColor: 'slategray',
      disableAfterRate: false,
      activeColor: 'cornflowerblue',
      initialRating: 0,
      strokeWidth: 0,
      readOnly: false,
      useGradient: false,
      minRating: 1,
      onLeave: function(currentIndex, currentRating, $el){
        $('.live-rating').text(currentRating);
        $('#review').val(currentRating)
      }
    });
    $('#rate-modal').modal('show')
  }
</script>

@endpush
@endsection
