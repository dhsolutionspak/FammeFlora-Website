@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/usersidemenu.css">

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
          <div class="delivery-dtail ">
            <div class="heading-sm">{{ __('manage_address')['title']}}</div>
            <div class="row addressData">
              @forelse($address as $key=>$addrs)
                <div class="col-md-6 col-sm-12 col-xl-6 mt-3 mb-3 ">
                  <div class="address-box bg-white  removeAdd{{$addrs->id}}">
                    <div class="circleaddress" style="right:60px;">
                      <a class="edit-add  d-flex justify-content-center align-item-center" onclick="updateAddress('{{$addrs->id}}','{{$countires}}')" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                    <div class="circleaddress delete-address">
                      <a class="edit-add  d-flex justify-content-center align-item-center"  onclick="deleteAddress('{{$addrs->id}}')"><i class="fas fa-times" aria-hidden="true"></i></a>
                    </div>
                    <a class="edit-add" onclick="deleteAddress('{{$addrs->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <a class="edit-add"  onclick="updateAddress('{{$addrs->id}}','{{$countires}}')"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <p class='addressItem{{$addrs->id}}'>{{$addrs->name}}, {{$addrs->address_1}}, {{$addrs->address_2}}, {{$addrs->city}}, {{$addrs->postcode}}, {{$addrs->country}} </p>
                  </div>
                </div>
              @empty
              <div class="col-md-6 col-sm-12 col-xl-6 ">
                  <div class="add-new-address bg-white">
                  <div class="fileinputs" style="    width: 150px;cursor:pointer" onclick="addAddress('{{$countires}}')">
                    <div class="fakefile">
                      <div class="fakebtn"><img src="{{asset('/frontend')}}/images/plus.png" alt="" title="" > </div>
                      <span id="filevalue">{{ __('manage_address')['add_address']}}</span>
                    </div>
                  </div>
                </div>
              </div>
              @endforelse

              <div class="col-md-6 col-sm-12 col-xl-6 ">
                  <div class="add-new-address bg-white">
                  <div class="fileinputs bg-white" style="    width: 150px;cursor:pointer" onclick="addAddress('{{$countires}}')">
                    <div class="fakefile">
                      <div class="fakebtn"><img src="{{asset('/frontend')}}/images/plus.png" alt="" title="" > </div>
                      <span id="filevalue">{{ __('manage_address')['add_address']}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
<!--==== END MAIN ====-->

@endsection
