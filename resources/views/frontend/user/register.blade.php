@extends('frontend.layouts.app', ['class' => 'bg-purple'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
@endpush

@section('content')


<!--==== START CONTENT ====-->
<section class="my-5" >
  <div class="row row2 login-box">
    <div class="col-md-4 col-xl-4 col-sm-12 ">
        <div class="login-form">
          <div class="heading-xs my-2 text-center">{{ __('registration')['register_now'] }}</div>
            <form name="my-3 " method="post" action="{{ route('customer.register') }}" id="search-form">
                @csrf

              @if (\Session::has('registererror'))
                <div class="alert bg-danger">
                    <ul>
                        <li>
                        <span class="text-white">	{!! \Session::get('registererror') !!}</span>
                        </li>
                    </ul>
                </div>
              @endif
                @csrf
                <div class="form-group">
                    <label for="firstName"> {{ __('commoninput')['placeholder_first_name'] }} <span class="text-danger"> * </span> </label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="{{ __('commoninput')['your'] }} {{ __('commoninput')['placeholder_first_name'] }}..." value="{{old('firstName')}}">
                    {!!	$errors->first("firstName", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group">
                    <label for="lastName"> {{ __('commoninput')['placeholder_last_name'] }} <span class="text-danger"> * </span> </label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="{{ __('commoninput')['your'] }} {{ __('commoninput')['placeholder_last_name'] }}...">
                    {!!	$errors->first("lastName", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group">
                    <label for="email"> {{ __('commoninput')['email'] }} <span class="text-danger"> * </span> </label>
                    <input type="email" class="form-control" id="signupemail" name="signupemail" placeholder="{{ __('commoninput')['placeholder_email'] }}...">
                    {!!$errors->first("signupemail", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group ">
                    <label for="telephone">  {{ __('commoninput')['placeholder_phone'] }} <span class="text-danger"> * </span> </label>
                    <br>
                    <input type="text" class="form-control " id="mobile_code" name="telephone" placeholder="{{ __('commoninput')['your'] }} {{ __('commoninput')['placeholder_phone'] }}...">
                    {!!$errors->first("telephone", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group">
                    <label for="password"> {{ __('commoninput')['placeholder_password'] }} <span class="text-danger"> * </span> </label>
                    <input type="password" class="form-control" id="signuppassword" name="signuppassword" placeholder="{{ __('commoninput')['your'] }} {{ __('commoninput')['placeholder_password'] }}...">
                    {!!$errors->first("signuppassword", "<span class='text-danger'>:message</span>")!!}
                </div>
                <div class="form-group">
                    <label for="comfirmPassword"> {{ __('commoninput')['placeholder_confirm_password'] }} <span class="text-danger"> * </span> </label>
                    <input type="password" class="form-control" id="comfirmPassword" name="comfirmPassword" placeholder="{{ __('commoninput')['your'] }} {{ __('commoninput')['placeholder_confirm_password'] }}...">
                    {!!$errors->first("comfirmPassword", "<span class='text-danger'>:message</span>")!!}
                </div>
                <input type="hidden" name="country_code" value="" id="country_code_input">
                <div class="text-center">
                    <button type="button" id="btn-submit-form"  class="submitbtn btn-lg"> {{ __('login')['button_registration'] }}</button>
                </div>

                <div class="sing-in mt-2">{{ __('registration')['label_login_info'] }} <a href="{{route('customer.getlogin')}}" class="sing-in "> {{ __('registration')['button_login'] }}</a>.</div>
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
        <img src="{{asset('frontend')}}/images/login-bg.png" alt="" style="height:100%">
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
<!-- JS (ADD HERE TO REDUCE PAGE LOAD) -->
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script type="text/javascript">
const input = document.querySelector("#mobile_code");
let inputInt =  window.intlTelInput(input, {
  initialCountry: "in",
   separateDialCode: true,
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js",
 });

 $(function() {
     //hang on event of form with id=myform
     $('#btn-submit-form').click(function(e) {
         //prevent Default functionality
         e.preventDefault();

         let countryCode = inputInt.getSelectedCountryData();
         $('#country_code_input').val('+'+countryCode.dialCode);
         $('#search-form').submit();
  });
});



</script>
@endpush
