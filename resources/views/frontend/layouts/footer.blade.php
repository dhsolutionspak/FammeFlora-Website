<footer id="footer" class="bg-gray" >
	<div class="cookie-overlay p-4 col-md-4 col-xl-4 col-lg-4 col-sm-12 d-none mx-3 ">
		<h4 class="my-2 text-black">We use cookie</h4>
		<div class="row">
			<div class="mx-1">
				Our website uses cookies to provide your browsing experience and
			 relevant information. Before continuing to use our website, you agree &
			 accept of our  <a href="{{url('cms/privacy-policy')}}">Privacy Policy</a>.
			</div>
		</div>
		<button class="button-block btn  mt-3 accept-cookies">Accept Cookie</button>
	</div>
	@php
		$mobile = config('settingConfig.config_talk_to_expert_mobile');
		$Arr = config('settingConfig.config_talk_to_expert');
		$text = json_decode($Arr,true);
		if(array_key_exists(session()->get('currentLanguage'),$text)){
			$text = $text[session()->get('currentLanguage')];
		}
		else {
			$text = '';
		}
	@endphp
		<div class="se-pre-con "></div>

		<!--Start footer bottom -->
		<div @if(Route::current()->getName() != 'customer.getregister' && Route::current()->getName() != 'customer.getlogin' ) class="footer-bottom" @endif>

			<!--Start Chat -->
			<div class="chat-section">
				<div class="@if(config('settingConfig.config_layout') == 'fullwidthlayout') container-fluid mx-5 mx-sm-0 @else otrixcontainer @endif">
					<div class="row">
						<div class="col-md-8 col-xl-8 col-lg-8 col-sm-12">
							  <p class="chat-section-title">{{ __('homepage')['talk_expert'] }}</p>
								<p class="chat-subtext">
									Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter.
								</p>
						</div>
						<div class="col-md-1 col-xl-2 col-lg-1 "></div>
						<div class="mt-3 mt-md-0 mt-xl-0 mt-lg-0 col-md-3 col-xl-2 col-lg-3 ">
							@php
								$mobile = config('settingConfig.config_talk_to_expert_mobile');
								$Arr = config('settingConfig.config_talk_to_expert');
								$text = json_decode($Arr,true);
								if(array_key_exists(session()->get('currentLanguage'),$text)){
									$text = $text[session()->get('currentLanguage')];
								}
								else {
									$text = 'Hello';
								}
								$wurl = "https://api.whatsapp.com/send?phone=$mobile&text=".urlencode($text); @endphp
							<a href="{{$wurl}}" target="_blank" class="button-block">{{ __('homepage')['chat_with_expert'] }} <i class="fas fa-chevron-right mx-2"></i></a>
						</div>
					</div>
				</div>
			</div>

			<!--End Chat -->

			<div class="@if(config('settingConfig.config_layout') == 'fullwidthlayout') container-fluid mx-5 mx-sm-0 @else otrixcontainer @endif">

				<div class="row my-1">
					<div class="col-md-4 col-sm-12 col-xl-4 footerLink ">
						<ul class="ft-navigation-fr-link ">
							<li><span class="text-capitalize footer-heading"><b> {{ __('common')['address'] }}</b></span> </li>
							<li><font color="#767787" style=""><i class="fa fa-map-marker"></i>
								{{config('settingConfig.config_address')}}
							</font></li>
							<li><a href=""><font color="#767787" style="">
								<i class="fa fa-envelope"></i>
								{{config('settingConfig.config_email')}}
								</font>
																	</a>
							 </li>
							<li><font color="#767787" style=""><i class="fa fa-whatsapp"></i> {{config('settingConfig.config_telephone')}}</font> </li>
							<li><font color="#767787" style=""><i class="fa fa-paper-plane" style=""></i> {{config('settingConfig.config_store_name')}}</font> </li>
						</ul>
						<div class="social-col">
							<ul class="social-link-otrix flex-wrapper">
								@if(!empty(config('settingConfig.config_fb_url')))
			            <li><a href="{{config('settingConfig.config_fb_url')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			          @endif
			          @if(!empty(config('settingConfig.config_linkedin_url')))
			            <li><a href="{{config('settingConfig.config_linkedin_url')}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
			          @endif
			          @if(!empty(config('settingConfig.config_twitter_url')))
			            <li><a href="{{config('settingConfig.config_twitter_url')}}" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
			          @endif
			          @if(!empty(config('settingConfig.config_insta_url')))
			            <li><a href="{{config('settingConfig.config_insta_url')}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
			          @endif
			          @if(!empty(config('settingConfig.config_youtube_url')))
			            <li><a href="{{config('settingConfig.config_youtube_url')}}" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a> </li>
			          @endif
							</ul>
						</div>
					</div>

						<div class=" col-md-2 col-sm-12 col-xl-2 footerLink my-5 my-md-0 my-lg-0 my-xl-0">
							<ul class="ft-navigation-fr-link ">
								<li><span class="text-capitalize footer-heading"><b> {{ __('common')['information'] }}</b></span> </li>
								@foreach($commonData['cmsPages'] as $cms)
									<li><a href="{{route('get.cms',['title' => Str::lower(str_replace(' ','-', $cms->title))])}}">{{$cms->title}}</a> </li>
								@endforeach
							</ul>
						</div>
						<div class=" col-md-2 col-sm-12 col-xl-2 mb-3 mb-mb-0 mb-lg-0 mb-xl-0 footerLink">
							<ul class="ft-navigation-fr-link ">
								<li><span class="text-capitalize footer-heading"><b> {{ __('common')['account'] }}</b></span> </li>
								<li><a href="{{route('user-dashboard')}}" >{{ __('common')['myaccount'] }}</a> </li>
								<li><a href="{{route('get-orders')}}">{{ __('common')['order_history'] }}</a> </li>
								<li><a href="{{route('get.wishlist')}}">{{ __('common')['wishlist'] }}</a> </li>
								<li><a href="{{route('contact_us')}}">{{ __('common')['contactus'] }}</a> </li>
								<li><a href="#">{{ __('common')['return'] }} (coming soon)</a> </li>
							</ul>
						</div>
						<div class="col-md-4 col-sm-12 col-xl-4 col-lg-4 ">
							<span class="text-capitalize footer-heading"><b> {{ __('common')['getintouch'] }}</b></span>
							<form action="{{route('submit.newslatter')}}" method="post" class="subscirbe_news mb-3">
								@csrf
								<input type="email" name="email" class="form-control" placeholder="{{ __('common')['email_address'] }}" />
								<input type="submit" value="{{ __('common')['subscribe'] }}" class="btn-subscribe" />
						  </form>

							<p style="font-family: 'Jost';font-style: normal;font-weight: 400;font-size: 14px;line-height:5mm" class="mb-3">Subscribe to our Newsletter to receive early discount offers,
latest news, sales and promo information.</p>
							<br/>
							<tr>
								<td><img src="{{asset('assets/img/icons/paymentsicons.png')}}" alt="" height="50"></td>
							</tr>
						</div>
					</div>

				<!-- footer navigation	-->

			</div>
		</div>

		<!--End footer bottom -->

		<!-- Start Copyright -->
		<div class="copyright">
			<div class="@if(config('settingConfig.config_layout') == 'fullwidthlayout') container-fluid mx-5 mx-sm-0 @else otrixcontainer @endif">
				<div class="flex-wrapper">
					<div class="copy-col">
						<p>Copyright © {{date('Y')}}, All Rights Reserved</p>
					</div>
					<div class="term-col">

					</div>


				</div>
			</div>
		</div>
		<!-- End Copyright -->

{{-- Product Detail Modal--}}
<div class="modal fade " id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalaria" aria-hidden="true">
		<div class="  modal-lg modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header border-bottom-0 ">
								<h5></h5>
								<button type="button" onclick="closeProductModal()" class="btn btn-outline-danger btn-md" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true" > &times;</span>
								</button>
						</div>
						<div class="modal-body mt-1">
								<div class="d-flex flex-column">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-lg-4 col-xl-4 bg-white">
													<img src="" alt="" title="" class="modalImg"/>
											</div>
											<div class="col-md-12 col-sm-12 col-lg-8 col-xl-8 ">
												<div class=" heading-sm mb-4 modal-product-title"></div>
												<div class="stock-wrap">
				                    <div class="stock-info">
				                        <ul class="stock-list">
				                            <li>
				                                <div class="stockbox">
				                                    <p><span class="stock-title">{{ __('product_details')['stock'] }}:</span> <span class="info  font-weight-bold modal-stock"></span></p>
				                                </div>
				                            </li>
				                            <li>
				                                <div class="stockbox">
				                                    <p><span class="stock-title">{{ __('product_details')['model'] }}:</span> <span class="info modal-model"></span></p>
				                                </div>
				                            </li>
				                        </ul>
				                    </div>

				                    <div class="prod-brand">
				                        <img src="" alt="brand logo" title="brand logo" class="modal-brand-logo"/>
				                    </div>
				                </div>

												<ul class="prod-all-deatil product-modal-ul">

				                    <li>
				                        <div class="probox">
				                            <div class="prod-head">{{ __('product_details')['category'] }}:</div>
				                            <div class="prod-info category-modal-title"></div>
				                        </div>
				                    </li>

			                      <hr>
			                      </ul>
											</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>
{{-- End Product Detail Modal--}}

</footer>
