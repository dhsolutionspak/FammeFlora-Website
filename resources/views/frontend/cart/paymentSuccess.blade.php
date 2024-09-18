@extends('frontend.layouts.app', ['class' => 'bg-white'])
@section('content')

<!--==== START CONTENT ====-->
<section class="my-5" id="shop-listing">
    <div class="col-12 text-center">
      <img src="{{asset('frontend')}}/images/congratulation.png" alt="" width="250">
      <h2 class="notfoundtxt mt-3 mb-3 text-black">{{ __('checkout')['order_confirm']}}</h2>
      <p>{{ __('checkout')['payment_desc']}}</p>
      @if(Auth::guard('customer')->check())
        <a href="{{ route('get-orders') }}" class="button-block mt-5">{{ __('checkout')['view_order']}} </a>
      @endif
    </div>

</section>
<!--==== END CONTENT ====-->


@endsection
