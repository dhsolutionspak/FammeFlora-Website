<section class="customer_sec" class="paragraph">
			<!-- customer section -->
			<div class="customer-wrapper">
			<!-- end customer review slider -->
			</div>
			<!-- customer section -->

			<!-- start Subscribe	-->
			<div class="subscribe-wrapper">
				<img src="{{asset('frontend')}}/images/shape.png" alt="" title="" class="shape-left"/>
				<div class="subcirbe-inner text-center">
					<div class="heading-xlg whiteclr">{{ __('common')['subscribe_news'] }}</div>
					<p></p>
					  <form action="{{route('submit.newslatter')}}" method="post" class="subscirbe_news">
							@csrf
							<input type="email" name="email" class="form-control" placeholder="{{ __('common')['email_address'] }}" />
							<input type="submit" value="{{ __('common')['subscribe'] }}" class="btn-subscribe" />
					  </form>

				</div>
				<img src="{{asset('frontend')}}/images/shape-rgiht.png" alt="" title="" class="shape-right"/>
			</div>
			<!-- start Subscribe	-->

	</section>
