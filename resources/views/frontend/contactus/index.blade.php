@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/contactus.css">
</style>
@endpush
@section('content')
<!--==== START BREADCUMB ====-->
<section class="page-crumb">

    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
      <li class="current">{{ __('contact_us')['title']}}</li>
    </ul>

</section>
<!--==== END BREADCUMB ====-->

<section class="content">
    <section class="otrix-section">
  		<div class="container">
  			<div class="row justify-content-center">
  				<div class="col-md-12">
  					<div class="wrapper">
  						<div class="row no-gutters">
  							<div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
  								<div class="contact-wrap w-100 p-md-5 p-4">
  									<div id="form-message-warning" class="mb-4"></div>
  				      		<div id="form-message-success" class="mb-4">
  				            Your message was sent, thank you!
  				      		</div>
  									<form action="{{route('post-contact-us')}}" method="POST" id="contactForm" name="contactForm" class="contactForm">
                      @csrf
                  		<div class="row">
  											<div class="col-md-6">
  												<div class="form-group">
  													<label class="label" for="name">{{ __('contact_us')['full_name']}}</label>
  													<input type="text" class="form-control" name="name" id="name" placeholder="{{ __('contact_us')['full_name']}}" value="{{old('name',Auth::guard('customer')->check() ? Auth::guard('customer')->user()->firstname : null)}}">
                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}

                        	</div>
  											</div>
  											<div class="col-md-6">
  												<div class="form-group">
  													<label class="label" for="email">{{ __('commoninput')['email']}}</label>
  													<input type="email" class="form-control" name="email"  placeholder="{{ __('commoninput')['placeholder_email']}}" value="{{old('email',Auth::guard('customer')->check() ? Auth::guard('customer')->user()->email : null)}}">
                            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}

                        	</div>
  											</div>
  											<div class="col-md-12">
  												<div class="form-group">
  													<label class="label" for="subject">{{ __('contact_us')['subject']}}</label>
  													<input type="text" class="form-control" name="subject" id="subject" placeholder="{{ __('contact_us')['subject']}}">
                            {!!$errors->first("subject", "<span class='text-danger'>:message</span>")!!}
                        	</div>
  											</div>
  											<div class="col-md-12">
  												<div class="form-group">
  													<label class="label" for="#">{{ __('contact_us')['message']}}</label>
  													<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="{{ __('contact_us')['message']}}"></textarea>
                            {!!$errors->first("message", "<span class='text-danger'>:message</span>")!!}
                        	</div>
  											</div>
  											<div class="col-md-12">
  												<div class="form-group">
                            <button type="submit" class="button-block btn-lg" name="button">{{ __('contact_us')['send_message']}}</button>
  													<div class="submitting"></div>
  												</div>
  											</div>
  										</div>
  									</form>
  								</div>
  							</div>
  							<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
  								<div class="info-wrap w-100 p-md-5 p-4">
  									<h3>{{ __('contact_us')['in_touch']}}</h3>
  									<p class="mb-4">{{ __('contact_us')['open_suggestion']}}</p>
  				        	<div class="dbox w-100 d-flex align-items-start">
  				        		<div class="icon d-flex align-items-center justify-content-center ">
  				        			<span class="fa fa-map-marker"></span>
  				        		</div>
  				        		<div class="text pl-3">
  					            <p><span>{{ __('checkout')['address']}}:</span> {{config('settingConfig.config_address')}}</p>
  					          </div>
  				          </div>
  				        	<div class="dbox w-100 d-flex align-items-center">
  				        		<div class="icon d-flex align-items-center justify-content-center">
  				        			<span class="fa fa-phone"></span>
  				        		</div>
  				        		<div class="text pl-3">
  					            <p><span>{{ __('contact_us')['phone']}}:</span> <a href="tel://{{config('settingConfig.config_telephone')}}">{{config('settingConfig.config_telephone')}}</a></p>
  					          </div>
  				          </div>
  				        	<div class="dbox w-100 d-flex align-items-center">
  				        		<div class="icon d-flex align-items-center justify-content-center">
  				        			<span class="fa fa-paper-plane"></span>
  				        		</div>
  				        		<div class="text pl-3">
  					            <p><span>{{ __('commoninput')['email']}}:</span> <a href="mailto:{{config('settingConfig.config_email')}}">	{{config('settingConfig.config_email')}}</a></p>
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
</section>


@endsection
