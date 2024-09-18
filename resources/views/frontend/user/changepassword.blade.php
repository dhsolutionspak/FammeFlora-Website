@extends('frontend.layouts.app', ['class' => 'bg-white'])
@push('css')
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/usersidemenu.css">
@endpush

@section('content')
<!--==== START MAIN ====-->
<section class="mt-3" id="shop-listing">
  <div class="otrixcontainer">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-xl-4 col-lg-4">
            <div class="wrapper">
                @include('frontend.partials.usersidebar')
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xl-8 col-lg-8">
          <div class="wrapper card p-5">
            <h3 class="m-3 text-center">{{ __('account')['label_change_password'] }}</h3>
            <div class="d-flex flex-column">
                <form   method="post" action="{{ route('change.password') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="old"> {{ __('reset_password')['placeholder_old_password'] }} <span class="text-danger"> * </span> </label>
                        <input type="password" class="form-control"  name="current_password" placeholder=" {{ __('reset_password')['placeholder_old_password'] }}" value="">
                        {!!$errors->first("current_password", "<span class='text-danger'>:message</span>")!!}
                    </div>
                    <div class="form-group">
                        <label for="new"> {{ __('reset_password')['placeholder_new_password'] }}  <span class="text-danger"> * </span> </label>
                        <input type="password" class="form-control"  name="new_password" placeholder="{{ __('reset_password')['placeholder_new_password'] }}" value="">
                        {!!$errors->first("new_password", "<span class='text-danger'>:message</span>")!!}
                    </div>
                    <div class="form-group">
                        <label for="confrim">{{ __('reset_password')['placeholder_confirm_password'] }} <span class="text-danger"> * </span> </label>
                        <input type="password" class="form-control"  name="confirm_password" placeholder="{{ __('reset_password')['placeholder_confirm_password'] }}" value="">
                        {!!$errors->first("confirm_password", "<span class='text-danger'>:message</span>")!!}
                    </div>
                    <div class="text-center">
                        <button type="submit" class="submitbtn ">{{ __('reset_password')['button_reset'] }}</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
<!--==== END MAIN ====-->

@endsection
