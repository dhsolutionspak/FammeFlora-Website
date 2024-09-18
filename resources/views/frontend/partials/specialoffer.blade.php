<section class="   ">
			<div class="flex-wrapper title-row ">
				<div class="cust_left">
					<div class="short-intro">
						<div class="heading-lg">{{ __('homepage')['dod'] }}</div>
					</div>
				</div>
			</div>
			
			<div id="special-offer-product">
				<ul class="product releted-product-js slick-arrow">
					@foreach($data['dodProducts'] as $key=>$value)
						@php
							$price = $value->price;
							$special = 0;
							$offTxt = '';
							$date = Carbon\Carbon::parse($value->created_at);
							$now = Carbon\Carbon::now();
							$diff = $date->diffInDays($now);

							if($value->special) {
								$endDate = Carbon\Carbon::createFromFormat('m/d/Y',$value->special->end_date);
								$startDate = Carbon\Carbon::createFromFormat('m/d/Y', $value->special->start_date);
								$todayDate = Carbon\Carbon::createFromFormat('m/d/Y', date('m/d/y'));
								if($startDate->gte($todayDate) && $todayDate->lte($endDate)) {
									$special = $value->special->price;
									$offTxt = calculatePercentage($price,$special);
								}
						}

							$stars = $value->review_avg  ? (int)$value->review_avg : 0;
							$starResult = "";
							for ( $i = 1; $i <= 5; $i++ ) {
									if ( round( $stars - .25 ) >= $i ) {
										$starResult .=   " <i class='fa fa-star'></i>";
									} elseif ( round( $stars + .25 ) >= $i ) {
												$starResult .=  " <i class='fa fa-star-half-o' ></i>";
									} else {
											  $starResult .=  " <i class='fa fa-star' style='color:#BCC7D1'></i>";
									}
							}
						@endphp

					<li>
						<div class="product-box slider-product-box  mb-3 mt-3 ">
							<a href="{{route('product.details',['id' => $value->id])}}" class="prod-img">
								<img class="lazy" data-original="{{asset('uploads')}}/product/{{$value->image}}" alt="" title="" />
							</a>
							<div class="quickview ">
								<div class="d-flex justify-content-center ">
									<a href="javascript:void(0);" class="quickviewtext" data-product="{{$value->id}}">Quick View</a>
								</div>
							</div>
							@if($value->quantity ==  0)
								<span class="latest-badge out-stock">{{ __('common')['label_out_of_stock'] }}</span>
							@endif
							@if($value->quantity !=  0 && $offTxt == '' && $diff < 15 )
								<span class="latest-badge ">{{ __('common')['label_new'] }}</span>
							@endif
							@if($value->quantity !=  0 && $offTxt != '')
								<span class="latest-badge discount-badge">{{$offTxt}}</span>
							@endif

							<div class="floating-bar">
								<div class="floating-add-to-cart  d-flex justify-content-center">
									<input type="hidden" name="productID" value="{{$value->id}}">
									<a href="javascript:void(0);" class="btn-add-to-cart d-flex align-items-center">
										<img src="{{asset('frontend')}}/images/add-to-cart.png" alt="" title="" class="add-to-cart-img" />
									</a>
								</div>
								@if(Auth::guard('customer')->check())
                    @if(in_array($value->id, getWishlist()))
                    <div class="floating-wishlist fill-wishlist  d-flex justify-content-center">
                      <a href="javascript:void(0);" class="d-flex align-items-center" onclick="addToWish(this,'{{$value->id}}')">
                        <i class="fas fa-heart" ></i>
                      </a>
                    </div>
                    @else
                    <div class="floating-wishlist  d-flex justify-content-center">
                      <a href="javascript:void(0);" class=" d-flex align-items-center" onclick="addToWish(this,'{{$value->id}}')">
                        <img src="{{asset('frontend')}}/images/little-heart.png" alt="" title="" class="" />
                      </a>
                    </div>
                    @endif
                @else
                	<div class="floating-wishlist  d-flex justify-content-center">
                    <a href="javascript:void(0);" class=" d-flex align-items-center" onclick="addToWish('{{$value->id}}')" >
                      <img src="{{asset('frontend')}}/images/little-heart.png" alt="" title="" class="" />
                    </a>
                  </div>
                @endif
							</div>

							<!-- <a href="javascript:void(0);"  class="@if(Auth::guard('customer')->check() && in_array($value->id, getWishlist())) add-to-wishlist-fill @else  add-to-wishlist @endif wishlist{{$value->id}} wishlist{{$value->id}}" data-title="Add to Wishlist"  onclick="addToWish('{{$value->id}}')"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
							<div class="mx-2 mb-3 mt-4" >
						  	<div class="product-detail">
							 	<p class="modeltext mt-1  mb-1">{{$value->category->name}}</p>
								<a href="{{route('product.details',['id' => $value->id])}}" class="prod-title mb-3 ">{{$value->productDescription->name}}</a>
								<!-- <p class="modeltext mt-1  mb-3">{{$value->model}}</p> -->
								@if($special > 0)
									<div class="price">
										<span class="specialPrice">{{config('settingConfig.config_currency')}}{{number_format($special,2)}}</span>
										<span class="originalPrice">{{config('settingConfig.config_currency')}}{{number_format( $value->price,2)}}</span>
									</div>
								@else
									<div class="price">{{config('settingConfig.config_currency')}}{{ $value->price}} <span class="offer">{{$offTxt}}</span></div>
								@endif
								<ul class="rating mt-3 ">
									{!! $starResult !!}
								</ul>
							</div>


							</div>
							<div  class=" clockdiv  d-flex justify-content-center">
									<div class="w-100">
										<span class="days{{$value->id}}" ></span>
										<div class="smalltext mx-2">Days</div>
									</div>
									<div class="w-100">
										<span >:</span>
									</div>
									<div class="w-100">
										<span class="hours{{$value->id}}" ></span>
										<div class="smalltext mx-2">Hours</div>
									</div>
									<div class="w-100">
										<span >:</span>
									</div>
									<div class="w-100">
										<span class="minutes{{$value->id}}" ></span>
										<div class="smalltext mx-2">Minutes</div>
									</div>
									<div class="w-100">
										<span >:</span>
									</div>
									<div class="w-100">
										<span class="seconds{{$value->id}}" ></span>
										<div class="smalltext mx-2">Seconds</div>
									</div>
								</div>
						</div>

					</li>

					@endforeach

				</ul>
			</div>

	</section>
