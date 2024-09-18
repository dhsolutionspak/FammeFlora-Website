<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="baseURL" content="{{url('/')}}" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="assetURL" content="{{asset('uploads')}}">
        <meta name="frontendAssetURL" content="{{asset('frontend')}}">
        <meta name="isLogin" content="{{ Auth::guard('customer')->check() }}">
        <meta name="currency" content="{{config('settingConfig.config_currency')}}">
        <meta name="currentRoute" content="{{Route::currentRouteName()}}">
        <meta name="direction" content="{{Session::get('locale') == 'ar' ? true : false}}" >
        <meta name="image-loader" content="{{config('constant.image_loader')}}" >
        <meta name="author" content="{{config('settingConfig.config_store_owner')}}">

        {!! SEOMeta::generate() !!}
        <!-- Favicon -->
        <link rel="icon" href="{{asset('uploads')}}/store/{{config('settingConfig.config_icon_image')}}" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->
        <!-- Icons -->
        <link href="{{ asset('assets') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('assets') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <!-- <link type="text/css" href="{{ asset('assets') }}/css/otrixweb.css?v=1.0.0" rel="stylesheet"> -->

        <!-- css -->
        @stack('css')
        <!-- <link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/slick.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/animate.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/common.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/menu.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/product.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/home.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/proctuct-detail.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/loading.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/retronotify.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" >
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        <script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js" ></script>

        @include('frontend.layouts.style')

    </head>
    <body class="{{ $class ?? '' }}">

          @include('frontend.layouts.header')
          <div class="@if(config('settingConfig.config_layout') == 'fullwidthlayout') container-fluid mx-5 mx-sm-0 @else otrixcontainer @endif">
            @yield('content')
          </div>
          @include('frontend.layouts.footer')
          <a class="scrollTop mx-5 d-none d-md-block d-lg-blocl d-xl-block" href="#top"><i class="fa fa-chevron-up"></i></a>

        <script type="text/javascript" src="{{ asset('frontend') }}/cjs/sweetalert2@11.js" ></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/script.js" ></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/slick.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/home.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/product.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/wow.min.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/retronotify.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/lazyload.min.js"></script>
        <script type="text/javascript" src="{{ asset('frontend') }}/js/sweetalert2@11.js" ></script>

        @include('frontend.layouts.commonjs')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
        <script type="text/javascript">
          jQuery(document).ready(function() {
              $(".se-pre-con").fadeOut("slow");
          });
        </script>



      @stack('js')
    </body>
</html>
