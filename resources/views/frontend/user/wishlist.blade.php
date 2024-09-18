@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shopping-table.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/shop-listing2.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/usersidemenu.css">
<style media="screen">
  td {
    font-size: 14px;
  }
</style>
@endpush

@section('content')


<!--==== START MAIN ====-->
<section class="mt-3" id="shop-listing">
  <div class="otrixcontainer">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-xl-4 col-lg-4">
            <div class="wrapper">
                @include('frontend.partials.usersidebar')
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xl-8 col-lg-8">
          <div class="orderlist my-3 orderdetailstable">
            <div class="table-responsive-sm">
              <table class="table table-borderless">
                <thead>
                 <tr>
                   <th scope="col" width="50%">Product</th>
                   <th scope="col" width="40%">{{ __('product_details')['price']}} </th>
                   <th scope="col" width="10%">{{ __('account')['action']}}</th>
                 </tr>
               </thead>
               <tbody>
                 @forelse($wishlistData as $key=>$data)
                   <tr class="wishlist-tr">
                     <td>
                       <div class="d-flex justify-content-start align-items-center">
                          <img src="{{asset('/uploads')}}/product/{{$data->image}}" alt="" class="order-detail-product-image">
                          <div class="flex-column mx-3 ">
                            <span class="product-name"> {{$data->productDescription?->name}}</span>
                              <div class="my-2 d-flex flex-row">
                                <div class="p-1 optiontitle ">{{ __('product_details')['model']}}:</div>
                                <div class="p-1 text-bold optionlabel " >{{$data->model}}</div>
                              </div>
                          </div>
                       </div>
                     </td>
                     <td class="mx-2"><span class="wishlist-price">{{config('settingConfig.config_currency')}} {{number_format($data->price,2)}}</span> </td>
                     <td><a href="{{url('product')}}/{{$data->productDescription?->product_id}}" class="button-purple btn-sm ">{{ __('account')['buy_now']}}</a></td>
                   </tr>
                  @empty
                    <tr colspan="5">
                      <h4 class="p-5 text-center text-black">{{ __('account')['wishlist_empty']}}</h4>
                    </tr>
                 @endforelse
               </tbody>
              </table>
            </div>
          </div>


            {{ $wishlistData->appends(['name' => request()->name])->links() }}

        </div>
      </div>
  </div>
</section>
<!--==== END MAIN ====-->

@endsection
