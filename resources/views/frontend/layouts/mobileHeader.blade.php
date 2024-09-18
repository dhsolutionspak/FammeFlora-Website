<div class="otrixcontainer mobile-header">
  <!-- <div class="head-center"> -->

    <div class="head-center">
      <div class="row">
            <div class="col  col-xs-2 mx-auto d-flex justify-content-start align-items-start">
              <a class="togglebtn " ><span></span></a>
            </div>
            <div class="col col-xs-3 mx-auto d-flex justify-content-center align-items-center">
              <a href="{{url('/')}}" class="disblock">
                <img src="{{asset('uploads')}}/store/{{config('settingConfig.config_store_image')}}" alt="Logo" class="logo" height="35">
              </a>
            </div>

            <div class="col col-xs-7 mx-1  d-flex justify-content-end align-items-center sm-top">
              <div class="row  ">
                <a class="e-cart col col-xs-3"  @if(Auth::guard('customer')->check())  href="{{route('user-dashboard')}}" @else href="{{route('customer.getlogin')}}"  @endif >
                    <div class="cart-bar">
                        <span><img src="{{asset('frontend')}}/images/account.png" alt="" title="" height="20" width="20" /> </span>
                    </div>
                    <span class="menu-icon-text d-none">{{ __('common')['account'] }}</span>
                </a>
                <a href="{{ route('shopping.cart')}}"  class="e-cart col col-xs-3 @if(app()->getLocale() == 'ar') ml-3 @else mr-3 @endif">
                    <div class="cart-bar">
                        <span class="cart-count basket-count">{{$commonData['cartCount']}}</span>
                        <span><img src="{{asset('frontend')}}/images/cart.png" alt="" title="" height="20" width="20" /> </span>
                    </div>
                    <span class="menu-icon-text d-none">{{ __('common')['your_cart'] }}</span>
                </a>
                <a href="#"  class="e-cart col col-xs-3 ">

                </a>

             </div>
            </div>

            <div id="mobile-button-for-popup" onclick="showSearchForm()" class="search col col-xs-1"><i class="fa fa-search" aria-hidden="true"></i></div>
          </div>
      <form class="expanding-search-form d-none" id="mobile-search-form">

        <input class="search-input "  id="global-search"  type="search" placeholder="{{ __('common')['search_product'] }}" onkeyup="searchData(this.value)">
        <input type="hidden" name="search_category" class="searchCat" value="0">
        <div class="search-dropdown ">
          <a class="button dropdown-toggle" type="button"
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="toggle-active">{{ __('common')['select_category'] }}  &nbsp&nbsp</span>
            <i class="fa fa-solid fa-caret-down"></i>
          </a>
           <ul class="dropdown-menu">
            <li class="menu-active"><a href="#">{{ __('common')['select_category'] }}</a></li>
            @foreach($commonData['categories'] as $key=>$parent)
              <li onclick="setSearchCategory('{{$parent->category_id}}')"><a href="#">{{$parent->categoryDescription?->name}}</a></li>
            @endforeach
          </ul>
        </div>
        <label class="search-label" for="global-search">
              <span class="sr-only">Global Search</span>
          </label>
        <button class="button search-button" type="button">
              <span class="fa  fa-search">
                  <span class="sr-only">Search</span>
              </span>
          </button>
          <i class="fa fa-close" onclick="closeSearchForm()"></i>
      </form>
      <div id="searchData">

      </div>

  </div>
</div>

<!-- Mobile Menu -->
<div class="head-menu">
  <div class="@if(config('settingConfig.config_layout') == 'fullwidthlayout') container-fluid mx-5 mx-sm-0 @else otrixcontainer @endif">
    <!-- <div class="d-flex justify-content-center"> -->
    <div class="row head-menu-content">
        <!-- <div class="w-75"> -->
        <div class="col-lg-10">
          <div class="bottom_head">
            <div class="menu_link">
              <nav>
                <form action="{{url('search-product')}}" method="get" class="d-flex mx-2 justify-content-center align-items-center mobile-search-form  d-lg-none d-xl-none" >
                  <input class="search-input-mobile search-input-mobile "  type="text" placeholder="{{ __('common')['search_product'] }}" name="search" required>
                    <a class="mx-2" type="submit" onclick="searchMobile()">
                      <i class="fa fa-search" ></i>
                    </a>
                  </form>
               <ul>
                <li class="has-sub d-lg-none d-xl-none">
                  <a href="javascript:void(0);">{{session()->get('language_name')}}</a>
                   <div class="mega-menu submenu">
                     <div class="menu-wrap">
                         <div class="menu-col">
                             <ul class="submenu-link">
                               @foreach($commonData['languages'] as $lang)
                                  <li data-languageid="{{$lang->id}}" data-language="{{$lang->code}}"  class="langBtn">
                                    <a href="javascript:void(0);" >{{$lang->language_name}}</a>
                                  </li>
                                @endforeach
                             </ul>
                         </div>
                       </div>
                    </div>
                  </li>
                @foreach($commonData['categories'] as $key=>$parent)
                  <li class="has-sub">
                    <a href="{{ route('category.products',['id' => $parent->category_id]) }}">{{$parent->categoryDescription?->name}}</a>
                     @if($parent->children && is_array($parent->children))
                     <div class="mega-menu submenu">
                       <div class="menu-wrap">
                         <div class="col4">
                           <div class="menu-col">
                               <ul class="submenu-link">
                                   @foreach($parent->children as $key=>$child)
                                    <li><a href="{{ route('category.products',['id' => $child->category_id]) }}">{{$child->categoryDescription?->name}}</a> </li>
                                   @endforeach
                               </ul>
                           </div>
                          </div>
                         </div>
                      </div>
                     @endif
                  </li>
                @endforeach
                @if(Auth::guard('customer')->check())
                    <li class="d-md-none d-lg-none d-xl-none"><a href="{{route('user-dashboard')}}" class="logout">{{ __('common')['myaccount'] }}</a> </li>
                    <li class="d-md-none d-lg-none d-xl-none"><a href="{{url('/contact_us')}}" class="contact-us">{{ __('common')['contact_us'] }}</a> </li>
                    <li class="d-md-none d-lg-none d-xl-none"><a href="{{ route('customer.logout') }}" class="logout">{{ __('common')['logout'] }}</a> </li>
                @else
                    <li class="d-md-none d-lg-none d-xl-none"><a href="{{route('customer.register')}}" class="sign-up signupbtn">{{ __('common')['create_account'] }}</a> </li>
                    <li class="d-md-none d-lg-none d-xl-none"><a href="{{route('customer.getlogin')}}" class="sing-in loginbtn" >{{ __('common')['sign_in'] }}</a> </li>
                    <li class="d-md-none d-lg-none d-xl-none"><a href="{{url('/contact_us')}}" class="contact-us">{{ __('common')['contact_us'] }}</a> </li>
                @endif

                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-2  d-flex justify-content-end">
            <div class="language-box ">
              @php $langFlag = session()->get('language_flag'); @endphp
              <img src="{{ url(config('constant.file_path.language')."/$langFlag") }}" alt="" class="language-img">
              <span class="language-txt">{{session()->get('language_name')}}
                <a class="btn language-toggle" >
                  <i class="fa fa-solid fa-caret-down"></i>
                </a>
              </span>
            </div>
            <ul class="language-menu d-none">
               @foreach($commonData['languages'] as $lang)
                 <li data-languageid="{{$lang->id}}" data-language="{{$lang->code}}"  class="langBtn">
                   <a href="javascript:void(0);">{{$lang->language_name}}</a>
                 </li>
               @endforeach
            </ul>
        </div>
    </div>

  </div>
</div>
