<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="{{route('dashboard')}}">
                <img src="{{asset('uploads')}}/store/{{config('settingConfig.config_store_image')}}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link @if(Request::is('admin/dashboard')) active @endif" href="{{ route('dashboard') }}">
                            <i class="ni ni-tv-2"></i> {{ __('Dashboard') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-catelog" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fa fa-list-alt fa-lg"></i>
                            <span class="nav-link-text" > {{ __('Catalog') }} </span>
                        </a>
                        <ul class="nav nav-sm flex-column">
                            <div class="collapse" id="navbar-catelog">
                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-category" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-tasks fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Categories') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-category">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('category.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('category') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-products" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fas fa-box fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Products') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-products">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('product.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('product') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-coupon" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-percent"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Coupon') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-coupon">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('coupon.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('coupon') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#navbar-product-option" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fa fa-list-alt fa-lg"></i>
                                      <span class="nav-link-text" style="color: #f4645f;">
                                      {{ __('Options') }}
                                  </span>
                                  </a>
                                  <ul class="nav nav-sm flex-column">
                                      <div class="collapse" id="navbar-product-option">
                                          <li class="nav-item">
                                              <a class="nav-link" href="{{ route('product-option.add') }}">
                                                  <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                              </a>
                                          </li>
                                          <li class="nav-item">
                                              <a class="nav-link" href="{{ route('product-option') }}">
                                                  <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                              </a>
                                          </li>
                                      </div>
                                  </ul>
                              </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-manufacturer" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fas fa-industry fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Manufacturers') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-manufacturer">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('manufacturer.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('manufacturer') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-product-attribute-group" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-th fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Attribute Group') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-product-attribute-group">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('product-attribute-group.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('product-attribute-group') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-product-attribute" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-th fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Product Attribute') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-product-attribute">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('product-attribute.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('product-attribute') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-review" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                    <i class="fas fa-star"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Reviews') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-review">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('review') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-system" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-laptop fa-lg"></i>
                            <span class="nav-link-text" > {{ __('System') }} </span>
                        </a>
                        <ul class="nav nav-sm flex-column">
                            <div class="collapse" id="navbar-system">

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-shipping-rate" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-shipping-fast"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Shipping') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-shipping-rate">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('shipping.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('shipping') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-length-class" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fas fa-ruler-vertical fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Length Class') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-length-class">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('length-class.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('length-class') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-weight-class" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-weight fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Weight Class') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-weight-class">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('weight-class.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('weight-class') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-order-status" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fas fa-tag fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Order Status') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-order-status">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('order-status.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('order-status') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-stock-status" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fas fa-cubes fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Stock Status') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-stock-status">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('stock-status.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('stock-status') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-country" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-globe-asia fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Countries') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-country">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('country.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('country') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-state" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-city fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('States') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-state">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('state.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('state') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-geo-zone" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-map fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Geo Zones') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-geo-zone">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('geozone.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('geozone') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-tax-rate" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-percentage fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Tax Rate') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-tax-rate">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('tax-rate.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('tax-rate') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-tax-class" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                      <i class="fas fa-calculator fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Tax Class') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-tax-class">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('tax-class.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('tax-class') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-language-class" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fas fa-language fa-lg"></i>
                                        <span class="nav-link-text" >
                                        {{ __('Language') }}
                                    </span>
                                    </a>
                                    <ul class="nav nav-sm flex-column">
                                        <div class="collapse" id="navbar-language-class">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('language.add') }}">
                                                    <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('language') }}">
                                                    <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('setting.label') }}">
                                                    <i class="fa fa-minus fa-lg"></i>  {{ __('Frontend Labels') }}
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>


                            </div>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-ai" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-robot fa-lg"></i>
                            <span class="nav-link-text" > {{ __('AI Section') }} </span>
                        </a>
                        <div class="collapse" id="navbar-ai">
                         <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('get.AI-image-similarity')}}">
                                        <i class="fa fa-minus fa-lg"></i> {{ __('Image Similarity') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                      <a class="nav-link" href="{{route('get.AI-chatGPT')}}">
                                          <i class="fa fa-minus fa-lg"></i> {{ __('ChatGPT') }}
                                      </a>
                                  </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-blog" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-blog fa-lg"></i>
                            <span class="nav-link-text" >
                                {{ __('Blog') }}
                            </span>
                        </a>

                        <div class="collapse" id="navbar-blog">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blog.add') }}">
                                        <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blog') }}">
                                        <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-customer" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-user-tie fa-lg"></i>
                            <span class="nav-link-text" >
                                {{ __('Customer') }}
                            </span>
                        </a>

                        <div class="collapse" id="navbar-customer">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.add') }}">
                                        <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer') }}">
                                        <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-sales" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-sort-amount-up-alt fa-lg"></i>
                            <span class="nav-link-text" > {{ __('Sales') }} </span>
                        </a>
                        <ul class="nav nav-sm flex-column">
                            <div class="collapse" id="navbar-sales">
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ route('order') }}">
                                      <i class="fa fa-minus"></i> {{ __('Orders') }}
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#">
                                      <i class="fa fa-minus"></i> {{ __('Selling Reports (coming soon)') }}
                                  </a>
                                </li>
                            </div>
                        </ul>
                    </li>


                    <li class="nav-item">
                      <a class="nav-link" href="#navbar-notification" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                          <i class="fas fa-bullhorn fa-lg"></i>
                          <span class="nav-link-text" >
                              {{ __('Marketing') }}
                          </span>
                      </a>

                      <div class="collapse" id="navbar-notification">
                          <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('newslatter.add') }}">
                                    <i class="fa fa-envelope fa-lg"></i> {{ __('Email Marketing') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('smsmarketing.add') }}">
                                    <i class="fa fa-sms fa-lg"></i> {{ __('Sms Marketing') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('notifications') }}">
                                    <i class="fa fa-bell fa-lg"></i> {{ __('Send Notification') }}
                                </a>
                            </li>
                          </ul>
                      </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-user" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fa fa-users fa-lg"></i>
                            <span class="nav-link-text" >{{ __('User') }}</span>
                        </a>
                        <div class="collapse" id="navbar-user">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.add') }}">
                                        <i class="fa fa-plus fa-lg"></i>  {{ __('Add') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user') }}">
                                      <i class="fa fa-list-alt fa-lg"></i>   {{ __('List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#navbar-cms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                              <i class="fa fa-edit fa-lg"></i>
                              <span class="nav-link-text" >{{ __('CMS') }}</span>
                          </a>
                          <div class="collapse" id="navbar-cms">
                              <ul class="nav nav-sm flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="{{ route('pages') }}">
                                          <i class="fa fa-list fa-lg"></i>  {{ __('Manage CMS') }}
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="{{ route('trending_dod') }}">
                                          <i class="fab fa-ideal"></i>  {{ __('Deals Of The Day') }}
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="{{ route('homepage_category') }}">
                                          <i class="fas  fa-box"></i>  {{ __('Homepage Category') }}
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="{{ route('featured-product') }}">
                                          <i class="fas fa-bolt"></i>  {{ __('Featured Products') }}
                                      </a>
                                  </li>
                              </ul>
                          </div>

                      </li>

              <li class="nav-item">
                  <a class="nav-link" href="#navbar-role-permission" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                      <i class="fas fa-user-secret fa-lg"></i>
                      <span class="nav-link-text" > {{ __('Roles & Permissions') }} </span>
                  </a>
                  <ul class="nav nav-sm flex-column">
                      <div class="collapse" id="navbar-role-permission">
                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-role" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                <i class="fas fa-user fa-lg"></i>
                                <span class="nav-link-text" >
                                {{ __('Role') }}
                            </span>
                            </a>
                            <ul class="nav nav-sm flex-column">
                                <div class="collapse" id="navbar-role">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('role.add') }}">
                                            <i class="fa fa-plus fa-lg"></i> {{ __('Add') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('role') }}">
                                            <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#navbar-permission" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                              <i class="fas fa-hand-rock fa-lg"></i>
                                <span class="nav-link-text" >
                                {{ __('Permission') }}
                            </span>
                            </a>
                            <ul class="nav nav-sm flex-column">
                                <div class="collapse" id="navbar-permission">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('permission') }}">
                                            <i class="fa fa-list-alt fa-lg"></i> {{ __('List') }}
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        </div>
                      </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-Support" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-headset fa-lg"></i>
                            <span class="nav-link-text" > {{ __('Support') }} </span>
                        </a>

                        <div class="collapse" id="navbar-Support">
                          <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('contact-us')}}">
                                        <i class="fas fa-pen "></i> {{ __('Contact Us') }}
                                    </a>
                                </li>
                              </ul>
                      </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-designs" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-fill-drip fa-lg"></i>
                            <span class="nav-link-text" > {{ __('Appearance') }} </span>
                        </a>
                        <div class="collapse" id="navbar-designs">
                         <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('banner') }}">
                                        <i class="fa fa-minus fa-lg"></i> {{ __('Banners & Sliders') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                      <a class="nav-link" href="#">
                                          <i class="fa fa-minus fa-lg"></i> {{ __('Themes (coming soon)') }}
                                      </a>
                                  </li>
                              </ul>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if(Request::is('admin/payment-methods')) active @endif" href="{{route('payment-methods')}}">
                            <i class="fas fa-credit-card"></i> {{ __('Payment Methods') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fa fa-cog fa-lg"></i>
                            <span class="nav-link-text" >{{ __('Settings') }}</span>
                        </a>
                        <div class="collapse" id="navbar-settings">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('setting.general') }}">
                                        <i class="fa fa-minus fa-lg"></i>  {{ __('General Setting') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('setting.email') }}">
                                        <i class="fa fa-minus fa-lg"></i>  {{ __('Email Setting') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('setting.sms') }}">
                                        <i class="fa fa-minus fa-lg"></i>  {{ __('SMS Setting') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('setting.socialmedia')}}">
                                        <i class="fa fa-minus fa-lg"></i>  {{ __('Social Media Setting') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('setting.seo')}}">
                                        <i class="fa fa-minus fa-lg"></i>  {{ __('Seo Setting') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('setting.websiteTheme')}}">
                                        <i class="fa fa-minus fa-lg"></i>  {{ __('Website Theme') }}
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link @if(Request::is('admin/dashboard')) active @endif" href="{{route('clear.app.cache')}}">
                            <i class="fas fa-eraser"></i> {{ __('Clear Application Cache') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if(Request::is('admin/dashboard')) active @endif" href="{{route('clear.cache')}}">
                            <i class="fas fa-eraser"></i> {{ __('Clear Website Cache') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
