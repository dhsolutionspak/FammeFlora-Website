@if(Session::get('locale') == 'ar')
<style >
  body{direction: rtl;}

</style>
@endif
<style>
.bg-white,.btn-add-address,.wrapper .sidebar ul li a:hover, .wrapper .sidebar ul li a.active,.quantitybox2 .quantity2,.value-button2,.quantitybox2,.input-text,.quantity-referesh { 
  background:{{config('themeconfig.website_bg')}} !important;
}
.product-box,.brandbox,.blog-box,.blog-right-box,.catebox,.panel-box,.js_product_mainslider,.quantity .qty,.quantitybox,.value-button,.btn-share,
.product-specification,.short-ordering select.shop-right,.column-labels,.summary-detail,.checkout-box,.delivery-dtail,.wrapper .sidebar,.card,.form-control,
.img-round,.orderlist,.order-box,.order-detail-box,.column-labels,.shopping-box{
  background:{{config('themeconfig.product_bg')}} !important;
}
.coupon_input .form-control{
  background:{{config('themeconfig.website_bg')}} !important;
}

.header-top {
  background:{{config('themeconfig.themeColor')}};
}
[class*="button-"] {
    background: {{config('themeconfig.themeColor')}};
  }
[class*="button-"]:hover {
    color: {{config('themeconfig.themeColor')}};
}
.quickview {
  background: {{config('themeconfig.themeColor')}};
}
.btn-subscribe{
  background: {{config('themeconfig.themeColor')}} !important;
}
.view_all {
  color: {{config('themeconfig.themeColor')}};
}
.cart-count{
  background: {{config('themeconfig.themeColor')}};
}
.add-to-cart {
    border: 1px solid {{config('themeconfig.themeColor')}};
    color: {{config('themeconfig.themeColor')}};
}
.add-to-cart:before{background: {{config('themeconfig.themeColor')}};}
.subscribe-wrapper {
    background: {{config('themeconfig.themeColor')}};
  }
  .btn-subscribe:hover {
    background: {{config('themeconfig.themeColor')}};
  }
  .product .price .offer {
    color: {{config('themeconfig.themeColor')}};
  }
  .search-container .submit {
    background: url('{{asset("frontend")}}/images/search-icon.svg')no-repeat top 16px right 17px {{config('themeconfig.themeColor')}};
  }
  .quantity-wrap .add-to-cart {
      background: {{config('themeconfig.themeColor')}};
  }
  .quantity-wrap .add-to-cart:hover {
    color:  {{config('themeconfig.themeColor')}};
  }
  .descirp-tab ul.tabs li.active {
    background: {{config('themeconfig.themeColor')}};
  }
  .submitbtn {
    background: {{config('themeconfig.themeColor')}};
    border: 1px solid {{config('themeconfig.themeColor')}};
  }
  .submitbtn:hover {
    color: {{config('themeconfig.themeColor')}};
  }
  .price-wrap .price span {
    color: #000;
  }
  .button-gray {
    background: #F8F8F8 !important;
    border-color: #F8F8F8 !important;
    color: #121533 !important;
  }
  .coupon_input .btn-subscribe {
    background: {{config('themeconfig.themeColor')}};
  }
  .coupon_input .btn-subscribe:hover {
    border-color:{{config('themeconfig.themeColor')}};
    color:{{config('themeconfig.themeColor')}};
  }
  .button-gray:hover {
    color: #fff !important;
  }
  .button-gray:before {
    background: {{config('themeconfig.themeColor')}};
  }
  .swal2-styled.swal2-confirm {
    background-color: {{config('themeconfig.themeColor')}} !important;
  }
  .info-wrap {
    background: {{config('themeconfig.themeColor')}};
  }
  .fa-home {color: {{config('themeconfig.themeColor')}};}
  .check-label .checkmark:after {background: {{config('themeconfig.themeColor')}};}
  .check-label input:checked ~ .checkmark {border-color: {{config('themeconfig.themeColor')}};}
  .page-item.active .page-link {display: flex;align-items: center;justify-content: center;width: 50px; height: 50px;background-color: {{config('themeconfig.themeColor')}};border-color: {{config('themeconfig.themeColor')}};}
  .pagination li a:hover, .pagination li a.current-page {background: {{config('themeconfig.themeColor')}};}
  .js_product_thumbslider li.slick-current .product_thumbitem {border-color: {{config('themeconfig.themeColor')}};}
  .fa-star {color: {{config('themeconfig.themeColor')}}}
  .scrollTop {background: {{config('themeconfig.themeColor')}} }
  .fa-star-half-o {color: {{config('themeconfig.themeColor')}}}
   a:hover{color: {{config('themeconfig.themeColor')}}}};

</style>
