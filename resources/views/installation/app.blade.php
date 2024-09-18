<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="baseURL" content="{{url('/')}}" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- Favicon -->
        <link href="{{ asset('assets') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->
        <!-- css -->
        @stack('css')
        <link href="{{ asset('frontend') }}/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/retronotify.css">

        @include('frontend.layouts.style')



    </head>
    <body class="{{ $class ?? '' }}">
          @yield('content')
            <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="{{ asset('frontend') }}/js/retronotify.js"></script>
            <script type="text/javascript">
              $( document ).ready(function() {
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
              });
            </script>
          @stack('js')
    </body>
</html>
