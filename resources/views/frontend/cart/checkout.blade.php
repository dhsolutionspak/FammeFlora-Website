@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shopping-table.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shop-listing2.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/DatPayment.css">
@endpush

@section('content')

<!--==== START BREADCUMB ====-->
<section class="page-crumb">
    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
      <li><a href="{{route('shopping.cart')}}">{{ __('cart')['title']}}</a></li>
      <li class="current">{{ __('cart')['checkout']}}</li>
    </ul>
</section>
<!--==== END BREADCUMB ====-->


<!--==== START PRODUCT LISTING ====-->
<section class="" id="shop-listing">
    <form action="{{route('doCheckout')}}"  method="post" class="checkoutForm" onsubmit="return doCheckout(event)">
      @csrf
      @method('post')
      <input type="hidden" name="tid" class="tid" >

      <div class="checkout-wrapper flex-wrapper">
       <div class="delivery-blk">

            <!-- Billing Address -->
                <div class="checkout-box mt-0">
                  <div class="delivery-dtail ">
                    <div class="row">
                        <div class="col-md-8 col-xl-8 col-lg-8">
                          <div class="heading-xs my-1">  {{ __('checkout')['billing_address']}} </div>
                        </div>
                        <div class="col-md-4 col-xl-4 col-lg-4 d-flex justify-content-end">
                            <button type="button" name="button" class="btn-add-address" onclick="addAddress('{{$data['countries']}}','billing')">
                              {{ __('manage_address')['add_address']}}  <i class="fas fa-plus mx-2"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row addressData">
                      @forelse($data['addresses'] as $key=>$address)
                         @if($address->type == 'billing')
                           <div class="col-md-6 col-sm-12 col-xl-6 mt-3 mb-3 ">
                            <div class="address-box">
                              <div class="circleaddress">
                                <a class="edit-add  d-flex justify-content-center align-item-center" onclick="updateAddress('{{$address->id}}','{{$data['countries']}}')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                              </div>
                              <p class='addressItem{{$address->id}}'>{{$address->name}}, {{$address->address_1}}, {{$address->address_2}}, {{$address->state}},{{$address->city}}, {{$address->postcode}}, {{$address->country}} </p>
                              <div class="address-check mt-5">
                                <label class="check-label">  {{ __('checkout')['billing_address']}}
                                  <input type="radio" name="billing_address_id" value="{{$address->id}}">
                                  <span class="checkmark"></span>
                                </label>
                              </div>
                            </div>
                          </div>
                          @endif
                      @empty
                        <h4 class="text-center my-5">Address not found!</h4>
                      @endforelse

                    </div>
                    <div class="address-check">
                      <label class="check-label">  Delivery address same as billing address
                        <input type="checkbox" id="sameasBillingAddress" onclick="sameasBilling($(this))" name="delivery_same_billing" value="1" >
                        <span class="checkmark"></span>
                      </label>
                    </div>
                  </div>
                </div>

            <!-- Delivery Address -->
                <div class="checkout-box deliveryAdd">
                  <div class="delivery-dtail ">
                    <div class="row">
                        <div class="col-md-8 col-xl-8 col-lg-8">
                          <div class="heading-xs my-1">  {{ __('checkout')['delivery_address']}} </div>
                        </div>
                        <div class="col-md-4 col-xl-4 col-lg-4 d-flex justify-content-end">
                            <button type="button" name="button" class="btn-add-address" onclick="addAddress('{{$data['countries']}}','delivery')">
                              {{ __('manage_address')['add_address']}}  <i class="fas fa-plus mx-2"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row addressData">
                      @forelse($data['addresses'] as $key=>$address)
                        @if($address->type == 'delivery')
                         <div class="col-md-6 col-sm-12 col-xl-6 mt-3 mb-3 ">
                          <div class="address-box">
                            <!-- <a class="edit-add" onclick="updateAddress('{{$address->id}}','{{$data['countries']}}')"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                            <div class="circleaddress">
                              <a class="edit-add  d-flex justify-content-center align-item-center" onclick="updateAddress('{{$address->id}}','{{$data['countries']}}')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>
                            <p class='addressItem{{$address->id}}'>{{$address->name}}, {{$address->address_1}}, {{$address->address_2}},{{$address->state}}, {{$address->city}}, {{$address->postcode}}, {{$address->country}} </p>
                            <div class="address-check mt-5">
                              <label class="check-label">  {{ __('checkout')['delivery_address']}}
                                <input type="radio" name="address_id" value="{{$address->id}}" onclick="calculateTax($(this))">
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                        </div>
                        @endif
                      @empty
                        <h4 class="text-center my-5">Address not found!</h4>
                      @endforelse

                    </div>
                  </div>
                </div>

            <!-- Shipping Method -->
               <div class="checkout-box">
                 <div class="delivery-dtail ">
                   <div class="heading-xs my-1">{{ __('checkout')['shipping_method']}}</div>
                   <div class="row addressData">
                     @forelse($data['shippingMethods'] as $key=>$shipping)
                       <!-- <div class="col-md-4 col-sm-12 col-xl-4 mt-3 mb-3 "> -->
                       <div class="col-lg-6  mt-3 mb-3 ">
                         <div class="address-box shipping shipping-div-{{$shipping->id}}">
                           <div class="row">
                              <div class="col-md-9 col-xl-9 col-sm-9">
                                <p class="shipping-text">{{$shipping->name}} </p>
                              </div>
                           </div>
                           <p class="my-2 priceTxt" >{{config('settingConfig.config_currency')}}{{$shipping->shipping_charge}} </p>
                           <div class="address-check mt-3">
                             <label class="check-label">{{ __('checkout')['select_shipping_method']}}
                               <input type="radio" name="selectedShippingMethod" value="{{$shipping->id}}" onchange="selectShipping('{{$shipping->id}}')" @if(isset($data['cartData']['shipping']) && $data['cartData']['shipping']['id'] == $shipping->id ) checked @endif>
                               <span class="checkmark"></span>
                             </label>
                           </div>
                         </div>
                       </div>

                     @empty
                      <p>{{ __('checkout')['shipping_not_found']}}</p>
                     @endforelse


                   </div>
                 </div>
               </div>

            <!-- Payment  Method -->

              <div class="checkout-box">
                <div class="delivery-dtail ">
                  <div class="heading-xs my-1">  {{ __('checkout')['payment_methods']}}</div>
                  <div class="payment-method-box ">
                   <div class="row">
                     @foreach($data['paymentMethods'] as $paymentMethod)
                       <div class="col-md-4 p-3 col-sm-12 col-xl-4 col-lg-3 {{$paymentMethod->payment_code}}-box payment-box">
                        <a href="javascript:void(0)" onclick="selectedPayment('{{$paymentMethod->payment_code}}')" class="d-flex justify-content-center align-items-center ">
                            <div class="w-25">
                              <img  src="{{asset('/uploads/paymentmethods')}}/{{$paymentMethod->payment_logo}}" alt="" title="" class="payimage"/>
                            </div>
                            <div class="w-75 text-center">
                                <span class="paymentTitle">{{$paymentMethod->name}}</span>
                            </div>
                        </a>
                      </div>
                     @endforeach
                    </div>
                  </div>
                  <input type="hidden" class="payment-method-input" name="payment_method" value="cod">
                  <textarea name="comment" rows="6" cols="80" class="form-control order-comment" placeholder="{{ __('checkout')['enter_order_comments']}}"></textarea>
                </div>

              </div>

            <div class="checkout-box">
            </div>

      </div>
      <div class="ordersummary-blk ">
        <div class="summary-detail">
          <div class="heading-md heading-line head-line">  {{ __('checkout')['order_summary']}}</div>

          <table id="values" class="order__subtotal__table">
              <tbody>
                @forelse($data['orderProducts'] as $key => $product)
                  <tr>
                    <td class="tumb-img"><img class="lazy" data-original="{{asset('uploads')}}/product/{{$product->image}}" alt="" title=""/></td>
                    <td class="thumb-title  ml-3">{{$product->productDescription?->name}}</td>
                    <td class="thumb-quntity"> Qty. {{$product->quantity}}</td>
                    <td class="thumb-price"> {{config('settingConfig.config_currency')}}{{$product->base_price}}</td>
                  </tr>
                @empty
                @endforelse

              </tbody>
          </table>
          <ul class="summary-total">
            <li>
              <div class="total-box">
                <div class="summary-title">{{ __('cart')['sub_total']}}:</div>
                <div class="summary-price">{{config('settingConfig.config_currency')}}{{$data['cartData']['subTotal']}}</div>
              </div>
            </li>
            <li>
              <div class="total-box">
                <div class="summary-title">{{ __('checkout')['shipping_rate']}}:</div>
                <div class="summary-price shipping-rate">@if(isset($data['cartData']['shipping'])) {{config('settingConfig.config_currency')}}{{$data['cartData']['shipping']['charges']}} @else {{config('settingConfig.config_currency')}}0.00 @endif</div>
              </div>
            </li>
            <li class="tax-box">

            </li>
            <li>
              <div class="total-box discount-box">
                <div class="summary-title">{{ __('order_details')['discount']}}</div>
                <div class="summary-price discount-amt">{{config('settingConfig.config_currency')}}{{$data['discount']}}</div>
              </div>
            </li>
            <li>
              <div class="total-box grand-total">
                <div class="summary-title">{{ __('cart')['grand_total']}}:</div>
                @php
                  $grandTotal =  $data['cartData']['grandTotal'];
                  if($data['discount']){
                    $grandTotal = str_replace(',','',$grandTotal);
                    $disc =  str_replace(',','',$data['discount']);
                    $grandTotal = (float)$grandTotal - (float)$data['discount'];
                  }
                 @endphp
                <div class="summary-price grand-total-price">{{config('settingConfig.config_currency')}}{{number_format($grandTotal,2)}}</div>
              </div>
            </li>
          </ul>
        </div>
        @if(config('settingConfig.config_accept_terms_before_order'))
            <label for="checkbox" class="  d-flex justify-content-start align-items-center">
              <input type="checkbox" class="mx-2" name="accept_terms" value="1">
              <a href="{{route('get.cms',['title' => 'return-&-refund-policy'])}}" target="_blank" class="accept_link mx-1"> Return & Refund Policy </a>  and  <a href="{{route('get.cms',['title' => 'terms-and-conditions'])}}"  target="_blank" class="accept_link mx-1"> Terms and Condition </a>  apply.
            </label>
        @endif
        <button type="submit" class="button-block button-place mt-3">{{ __('checkout')['place_order']}} </button>
      </div>
    </div>
   </form>

</section>


{{-- Stripe Input Modal--}}
<div class="modal fade " id="stripe-modal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalaria" aria-hidden="true">
		<div class="  modal-lg modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header border-bottom-0 ">
								<h5></h5>
								<button type="button" onclick="closeCardModal()" class="btn-danger btn-md" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true" > &times;</span>
								</button>
						</div>
						<div class="modal-body mt-1">
              <form  method="POST" id="pay-form" class="datpayment-form require-validation"   data-cc-on-file="false"  data-stripe-publishable-key="{{ $data['STRIPE_KEY']->payment_key }}">
                <div class="dpf-title">
                    Payment  card
                    <div class="accepted-cards-logo"></div>
                </div>
                <div class="dpf-card-placeholder"></div>

                <div class="dpf-input-container mt-5">
                  <div id="card-element" class="mb-5">

                  </div>


                    <button type="submit" class="dpf-submit">
                            <span class="btn-active-state">
                                Pay Now
                            </span>
                            <span class="btn-loading-state">
                                <i class="fa fa-refresh "></i>
                            </span>
                          </button>
                        </div>
              </form>
						</div>
				</div>
		</div>
</div>
{{-- End Stripe Modal--}}

<!--==== END PRODUCT LISTING ====-->

@endsection

<!-- JS (ADD HERE TO REDUCE PAGE LOAD) -->
@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/table.js"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/js/smk-accordion.js"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/js/DatPayment.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //	FAQ
        $(".checkout-accordion").smk_Accordion({
            closeAble: true, //boolean
            //closeOther: false, //boolean
            activeIndex: 1  //second section open
        });

        $('.cod-box').css({"background":'#FFFFFF',"border": "1px solid #F24C62"})

  });

  function doCheckout(e) {
    e.preventDefault();
    try {
      //check address selected
      let getSelectedAddress = $('input[name="address_id"]:checked').val();
      let getSelectedShippingMethod = $('input[name="selectedShippingMethod"]:checked').val();
      let getSelectedPaymentMethod = $('input[name="payment_method"]').val();
      let getSelectedBillingAddress = $('input[name="billing_address_id"]:checked').val();
      let sameasBillingAddress = $('#sameasBillingAddress').is(':checked');

      if(!getSelectedBillingAddress) {
         new RetroNotify({
           style: 'white',
           animate: 'slideTopRight',
           contentHeader: '<i class="fa fa-info"></i> Error',
           contentText: 'Select billing Address',
           closeDelay: 2500
         });
         return false;
     }
     else if(!sameasBillingAddress && !getSelectedAddress) {
          new RetroNotify({
            style: 'white',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-info"></i> Error',
            contentText: 'Select delivery Address',
            closeDelay: 2500
          });
          return false;
      }
      else if(!getSelectedShippingMethod) {
          new RetroNotify({
            style: 'white',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-info"></i> Error',
            contentText: 'Select shipping method',
            closeDelay: 2500
          });
          return false;
      }
      else if(!getSelectedPaymentMethod) {
          new RetroNotify({
            style: 'white',
            animate: 'slideTopRight',
            contentHeader: '<i class="fa fa-info"></i> Error',
            contentText: 'Select payment method',
            closeDelay: 2500
          });
          return false;
      }

      <?php if(config('settingConfig.config_accept_terms_before_order')) { ?>

        let acceptTerms = $('input[name="accept_terms"]:checked').val();
         if(!acceptTerms) {

            new RetroNotify({
              style: 'white',
              animate: 'slideTopRight',
              contentHeader: '<i class="fa fa-info"></i> Error',
              contentText: 'Select Accept Terms & Condition',
              closeDelay: 2500
            });
            return false;
         }
      <?php }  ?>

      if(getSelectedPaymentMethod == 'stripe') {
        $('#stripe-modal').modal('show');
      }
      else if(getSelectedPaymentMethod == 'razorpay') {
        var SITEURL = '{{URL::to('')}}';
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var totalAmount = $('.grand-total-price').text().replace(/^\D|,+/g, '');

        totalAmount = parseFloat(totalAmount);

        var product_id =  1;
        var options = {
        "key": "{{$data['RAZORPAY_KEY']->payment_key}}",
        "amount": (totalAmount*100).toFixed(2), // 2000 paise = INR 20
        "name": '{{env("APP_NAME")}}',
        "description": "Payment",
        "image": "https://otrixcommercepro.otrixcommerce.in/frontend/images/logo.png",
        "handler": function (response){
          if(response && response.razorpay_payment_id){

            $('.tid').val(response.razorpay_payment_id);
             var $form2 = $(".checkoutForm");
              new RetroNotify({
                style: 'green',
                animate: 'slideTopRight',
                contentHeader: '<i class="fa fa-check"></i> Payment Success',
                contentText: 'Payment successfully done',
                closeDelay: 2500
              });
              $form2.get(0).submit();
          }
            //window.location.href = SITEURL +'/'+ 'paysuccess?payment_id='+response.razorpay_payment_id+'&product_id='+product_id+'&amount='+totalAmount;
        },
        "prefill": {
            "contact": "{{config('settingConfig.config_telephone')}}",
            "email":   "{{config('settingConfig.config_email')}}",
          },
          "theme": {
            "color": "{{config('settingConfig.config_web_bg')}}"
          }
          };
          var rzp1 = new Razorpay(options);
          rzp1.open();
      }
      else {
        var $form2 = $(".checkoutForm");
        $form2.get(0).submit();
      }

    } catch (e) {
     throw new Error(e.message);
    }
    return false;
  }

  function closeCardModal(){
    $('#stripe-modal').modal('hide');
  }
</script>
<script type="text/javascript">

         // var payment_form = new DatPayment({
         //     form_selector: '#payment-form',
         //     card_container_selector: '.dpf-card-placeholder',
         //
         //     number_selector: '.dpf-input[data-type="number"]',
         //     date_selector: '.dpf-input[data-type="expiry"]',
         //     cvc_selector: '.dpf-input[data-type="cvc"]',
         //     name_selector: '.dpf-input[data-type="name"]',
         //
         //     submit_button_selector: '.dpf-submit',
         //
         //     placeholders: {
         //         number: '•••• •••• •••• ••••',
         //         expiry: '••/••',
         //         cvc: '•••',
         //         name: 'OTRIX'
         //     },
         //
         //     validators: {
         //         number: function(number){
         //             return Stripe.card.validateCardNumber(number);
         //         },
         //         expiry: function(expiry){
         //             var expiry = expiry.split(' / ');
         //             return Stripe.card.validateExpiry(expiry[0]||0,expiry[1]||0);
         //         },
         //         cvc: function(cvc){
         //             return Stripe.card.validateCVC(cvc);
         //         },
         //         name: function(value){
         //             return value.length > 0;
         //         }
         //     }
         // });

</script>


<script type="text/javascript">

$(function() {
  var stripe = Stripe("{{$data['STRIPE_KEY']->payment_key}}");
  var elements = stripe.elements();
  var style = {
            base: {
              color: "#32325d",
            }
          };

  var card = elements.create("card", { style: style });
  card.mount("#card-element");
  var form = document.getElementById('pay-form');

  form.addEventListener('submit', function(ev) {
    $('.dpf-submit').addClass('loading');
    ev.preventDefault();
    let address = $('input[name="billing_address_id"]:checked').val();
    $.ajax({
      url: "{{url('create-payment-intent')}}",
      type: 'post',
      data:{'_token':'{{ csrf_token() }}','address_id':address },
      dataType: 'json',
      success: function(response) {
            stripe.confirmCardPayment(response.client_secret, {
             payment_method: {
               card: card,
               billing_details: {
                 name: response.name,
                 email: response.email
               }
             },
             setup_future_usage: 'off_session'
           }).then(function(result) {
             $('.dpf-submit').removeClass('loading');
             if (result.error) {

               new RetroNotify({
                 style: 'red',
                 animate: 'slideTopRight',
                 contentHeader: '<i class="fa fa-close"></i> Payment Failed',
                 contentText: result.error.message,
                 closeDelay: 2500
               });

             } else {
               if (result.paymentIntent.status === 'succeeded') {
                   $('.tid').val(result.paymentIntent.id);
                    var $form2 = $(".checkoutForm");
                     new RetroNotify({
                       style: 'green',
                       animate: 'slideTopRight',
                       contentHeader: '<i class="fa fa-check"></i> Payment Success',
                       contentText: 'Payment successfully done',
                       closeDelay: 2500
                     });
                     $form2.get(0).submit();
               }
               return false;
             }
           });
        }
      });
  });
});

function selectedPayment(checkedPayment) {
    $('.payment-box').css({"border":"0px","background":"#F2F2F2"});
    $('.payment-method-input').val(checkedPayment);
    $('.'+checkedPayment+'-box').css({"background":'#FFFFFF',"border": "1px solid #F24C62"})
}

 /*------------------------------------------
 --------------------------------------------
 Stripe Payment Code
 --------------------------------------------
 --------------------------------------------*/


//  var $form = $(".require-validation");
//
//  $('form.require-validation').bind('submit', function(e) {
//      var $form = $(".require-validation"),
//      inputSelector = ['input[type=email]', 'input[type=password]',
//                       'input[type=text]', 'input[type=file]',
//                       'textarea'].join(', '),
//      $inputs = $form.find('.required').find(inputSelector),
//      $errorMessage = $form.find('div.error'),
//      valid = true;
//      $errorMessage.addClass('hide');
//
//      $('.has-error').removeClass('has-error');
//      $inputs.each(function(i, el) {
//        var $input = $(el);
//        if ($input.val() === '') {
//          $input.parent().addClass('has-error');
//          $errorMessage.removeClass('hide');
//          e.preventDefault();
//        }
//      });
//
//      if (!$form.data('cc-on-file')) {
//        e.preventDefault();
//        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
//        let expiryDate = $('.expiremy').val();
//        expiryDate = expiryDate.split('/');
//        let expMonth = expiryDate[0].replace(' ','');
//        let expYear = expiryDate[1].replace(' ','');;
//
//        Stripe.createToken({
//          number: $('.card-number').val(),
//          cvc: $('.card-cvc').val(),
//          exp_month: expMonth,
//          exp_year:expYear
//        }, stripeResponseHandler);
//      }
//
//  });
//
//  /*------------------------------------------
//  --------------------------------------------
//  Stripe Response Handler
//  --------------------------------------------
//  --------------------------------------------*/
//  function stripeResponseHandler(status, response) {
//
//      if (response.error) {
//        Swal.fire({
//             toast: true,
//             title: response.error.message,
//             icon: 'error',
//             timerProgressBar: true,
//             position: 'top-end',
//             showConfirmButton:false,
//             timer: 3000,
//             showCloseButton: false,
//             showCancelButton: false,
//          });
//      } else {
//          /* token contains id, last4, and card type */
//          var token = response['id'];
//          $form.find('input[type=text]').empty();
//          $form2.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
//          $form2.get(0).submit();
//      }
//  }
//
// });


</script>

@endpush
