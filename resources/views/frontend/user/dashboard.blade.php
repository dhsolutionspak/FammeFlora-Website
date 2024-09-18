@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/usersidemenu.css">
@endpush

@section('content')


<!--==== START MAIN ====-->
<section class="my-3">
      <div class="row">
          <div class="col-md-4 col-sm-12 col-xl-4 ">
              <div class="wrapper">
                  <!--Top menu -->
                  @include('frontend.partials.usersidebar')

              </div>
          </div>
          <div class="col-md-8 col-sm-12 col-xl-8  card p-4 ">
              <div class="wrapper">
                <h3 class="m-3 text-center">{{ __('account')['update_profile']}}</h3>
                <div class="d-flex flex-column">
                    <form   method="post" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="firstName"> {{ __('commoninput')['placeholder_first_name']}} <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="firstName" placeholder="{{ __('commoninput')['your']}} {{ __('commoninput')['placeholder_first_name']}}..." value="{{old('firstName',Auth::guard('customer')->user()->firstname)}}">
                            {!!$errors->first("firstName", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="lastName">  {{ __('commoninput')['placeholder_last_name']}} <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control"  name="lastName" placeholder="{{ __('commoninput')['your']}} {{ __('commoninput')['placeholder_last_name']}}..." value="{{old('lastname',Auth::guard('customer')->user()->lastname)}}">
                            {!!$errors->first("lastName", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="email"> {{ __('commoninput')['email']}} <span class="text-danger"> * </span> </label>
                            <input type="email" class="form-control"  name="email" placeholder="{{ __('commoninput')['placeholder_email']}}..." value="{{old('email',Auth::guard('customer')->user()->email)}}">
                            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="telephone"> {{ __('commoninput')['placeholder_phone']}} <span class="text-danger"> * </span> </label>
                            <input type="text" class="form-control" name="telephone" placeholder="{{ __('commoninput')['your']}} {{ __('commoninput')['placeholder_phone']}}..." value="{{old('telephone',Auth::guard('customer')->user()->telephone)}}">
                            {!!$errors->first("telephone", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="firstName">  {{ __('account')['update_profile_pic']}} <span class="text-danger"> * </span> </label>
                              @if(Auth::guard('customer')->user()->image != null)
                                @if(strpos(Auth::guard('customer')->user()->image, "http://") !== false)
                                    <img src="{{asset('uploads')}}/user/{{Auth::guard('customer')->user()->image}}" alt="profile_picture" width="250">
                                  @else
                                    <img src="{{Auth::guard('customer')->user()->image}}" alt="profile_picture" width="250">
                                @endif
                              @endif
                            </br>
                            <input type="file" name="profile" value="">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="submitbtn ">{{ __('reset_password')['button_reset']}}</button>
                        </div>
                    </form>
                </div>
              </div>
          </div>

      </div>

</section>
<!--==== END MAIN ====-->

@endsection
