<div class="sidebar mb-5">
  <div class="profile">
    @if(Auth::guard('customer')->user()->image != null)
      @if(strpos(Auth::guard('customer')->user()->image, "http://") !== false)
          <img src="{{asset('uploads')}}/user/{{Auth::guard('customer')->user()->image}}" alt="profile_picture">
        @else
          <img src="{{Auth::guard('customer')->user()->image}}" alt="profile_picture" >
      @endif
    @endif
      <h3>{{Auth::guard('customer')->user()->firstname}}</h3>
      <p>{{Auth::guard('customer')->user()->email}}</p>
    </div>
    <ul class="mt-5">
    <li>
        <a href="{{route('user-dashboard')}}" class="@if(Route::current()->getName()  =='user-dashboard') active @endif">
            <div class="img-round mx-2">
              <img src="{{asset('/frontend')}}/images/side-user.png" alt="">
            </div>
            <span class="item">{{ __('account')['title'] }}</span>
        </a>
    </li>
    <li>
      <a href="{{route('get-orders')}}" class="@if(Route::current()->getName()  =='get-orders') active @endif">
            <div class="img-round mx-2">
              <img src="{{asset('/frontend')}}/images/add-to-cart.png" alt="">
            </div>
            <span class="item">{{ __('account')['label_order'] }}</span>
        </a>
    </li>
    <li>
      <a href="{{route('get.wishlist')}}" class="@if(Route::current()->getName()  =='get.wishlist') active @endif">
            <div class="img-round mx-2">
              <img src="{{asset('/frontend')}}/images/little-heart.png" alt="">
            </div>
            <span class="item">{{ __('account')['label_wishlist'] }}</span>
        </a>
    </li>
    <li>
      <a href="{{route('get.address')}}" class="@if(Route::current()->getName()  =='get.address') active @endif">
            <div class="img-round mx-2">
              <img src="{{asset('/frontend')}}/images/address.png" alt="">
            </div>
            <span class="item">{{ __('account')['label_manage_address'] }}</span>
        </a>
    </li>
    <li>
      <a href="{{route('getchange.password')}}" class="@if(Route::current()->getName()  =='getchange.password') active @endif">
            <div class="img-round mx-2">
              <img src="{{asset('/frontend')}}/images/change-password.png" alt="">
            </div>
            <span class="item">{{ __('account')['label_change_password'] }}</span>
        </a>
    </li>
    <li>
      <a href="{{ route('customer.logout') }}" >
            <div class="img-round mx-2">
              <img src="{{asset('/frontend')}}/images/logout.png" alt="">
            </div>
            <span class="item">{{ __('account')['label_logout'] }}</span>
        </a>
    </li>



</ul>
</div>
