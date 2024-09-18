@extends('frontend.layouts.app', ['class' => 'bg-purple'])
@section('content')

<!--==== START CONTENT ====-->
<section class="my-5" >
  <div class="row row2 login-box">
      <div class="col-md-4 col-xl-4 col-sm-12 ">
        <div class="login-form">
          <div class="heading-xs my-2 text-center">{{ __('login')['login_now'] }}</div>
          <span class="text-center">Enter your email address and password to access {{config('settingConfig.config_store_name')}} account</span>
            <form  method="post" action="{{ route('customer.login') }}" class="my-3">
                @if(Session::has('autherror'))
                    <div class="text-center bg-danger p-2 my-2 round">
                      <strong class="text-white">{!! \Session::get('autherror') !!}!</strong>
                  </div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label"> {{ __('commoninput')['email'] }} <span class="text-danger"> * </span> </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('commoninput')['placeholder_email'] }}" value="{{old('email')}}">
                    {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group">
                    <label for="password" class="form-label"> {{ __('commoninput')['placeholder_password'] }} <span class="text-danger"> * </span> </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('commoninput')['your'] }} {{ __('commoninput')['placeholder_password'] }}..." value="{{old('password')}}">
                    {!!$errors->first("password", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="text-center">
                    <button type="submit" id="submitlogin" value="submitlogin" class="submitbtn btn-lg">{{ __('registration')['button_login'] }}</button>
                </div>
                <div class="signup-section mt-2">{{ __('login')['label_registration_info'] }} <a href="{{route('customer.getregister')}}" class="sign-up "> {{ __('login')['button_registration'] }}</a>.</div>
                @if(config('settingConfig.config_social_status'))
                  <div class="d-flex mt-3">
                    <a class="google-login" href="{{ url('auth/google') }}"><i class="fab fa-google"></i>  Google Login</a>
                    <a  class="facebook-login" href="{{ url('auth/facebook') }}"><i class="fab fa-facebook-f"></i>  Facebook Login</a>
                  </div>
                @endif

            </form>
        </div>
      </div>
      <div class="d-none d-md-block d-xl-block d-xl-block col-md-8 col-lg-8 col-xl-8 ">
        <img src="{{asset('frontend')}}/images/login-bg.png" alt="">
      </div>
  </div>
</section>
<!--==== END CONTENT ====-->

<style media="screen">
.row2 {
 --bs-gutter-x: 0rem;
}
</style>
@endsection
