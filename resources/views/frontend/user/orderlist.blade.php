@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/DatPayment.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/usersidemenu.css">

@endpush

@section('content')


<!--==== START MAIN ====-->
<section class="mt-3" id="shop-listing">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-xl-4 ">
            <div class="wrapper">
                @include('frontend.partials.usersidebar')
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xl-8">
          <div class="card">
            <h3 class="m-3  text-left heading-xs">{{ __('account')['label_order']}}</h3>
          </div>
          <div class="orderlist">
            <div class="table-responsive-sm">
              <table class="table table-borderless">
                <thead>
                 <tr>
                   <th scope="col" width="15%">Invoice No</th>
                   <th scope="col" width="15%">Order Date</th>
                   <th scope="col" width="15%">Amount</th>
                   <th scope="col" width="15%">Status</th>
                   <th scope="col" width="40%" align="center">Action</th>
                 </tr>
               </thead>
               <tbody>
                 @forelse($orders as $key=>$order)
                   <tr class="order-list">
                     <td>#{{$order->id}}</td>
                     <td>{{date('d M Y',strtotime($order->order_date))}}</td>
                     <td>{{config('settingConfig.config_currency')}} {{$order->grand_total}}</td>
                     <td>{{$order->orderStatus ? $order->orderStatus->name : 'N/A'}}</td>
                     <td>
                       <a href="{{url('order-details')}}/{{$order->id}}" class="button-purple btn-sm ">{{ __('order_details')['title']}}</a>
                       <a href="{{url('order-download-pdf')}}/{{$order->id}}" class="button-block btn-block-rate btn-sm "> {{ __('order_details')['download_pdf']}} </a>
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
          <div class="my-3">
            {{ $orders->appends(['name' => request()->name])->links() }}
          </div>

        </div>
      </div>
</section>
<!--==== END MAIN ====-->

@endsection
