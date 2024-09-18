@extends('installation.app', ['class' => 'bg-white'])
@section('content')
  <div class="container pt-5">
      <div class="d-flex justify-content-center mt-5">
        <div class="card p-3">
          <div class="card-body install-card-body h-100 w-100 z-3 position-relative">
            <center>
              <img src="{{asset('frontend')}}/images/logo.png" alt="" height="50">
            </center>
            <h1 class="my-3 text-center">Otrixweb - Ecommerce Website & Admin Panel Installation</h1>
            <p class="text-center">Fill form witth admin panel credentials and Website & Admin Panel </p>
            <ol class="list-group rounded-2">

              <form method="post" action="{{ route('configuresystem') }}"  autocomplete="off">
                  @csrf
                  @method('post')

                  <div class="pl-lg-4 row">
                      <div class="col-md-6 form-group{{ $errors->has('db_host') ? ' has-danger' : '' }}">
                          <label class="form-control-label my-3" for="input-name">{{ __('App Name') }}</label>
                          <input type="text" name="app_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('app_name') ? ' is-invalid' : '' }}" placeholder="{{ __('App Name') }}" value="{{ old('app_name', '') }}" autofocus>
                          @if ($errors->has('app_name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('app_name') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="col-md-6 form-group{{ $errors->has('admin_name') ? ' has-danger' : '' }}">
                          <label class="form-control-label my-3" for="input-name">{{ __('Admin Name') }}</label>
                          <input type="text" name="admin_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('admin_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Admin Name') }}" value="{{ old('admin_name', '') }}" autofocus>
                          @if ($errors->has('admin_name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('admin_name') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="pl-lg-4 row">
                        <div class="col-md-6 form-group{{ $errors->has('admin_email') ? ' has-danger' : '' }}">
                            <label class="form-control-label my-3" for="input-name">{{ __('Admin Email') }}</label>
                            <input type="text" name="admin_email" id="input-name" class="form-control form-control-alternative{{ $errors->has('admin_email') ? ' is-invalid' : '' }}" placeholder="{{ __('Admin Email') }}" value="{{ old('admin_email', '') }}" autofocus>
                            @if ($errors->has('admin_email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('admin_email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('admin_password') ? ' has-danger' : '' }}">
                            <label class="form-control-label my-3" for="input-name">{{ __('Admin Password') }}</label>
                            <input type="password" name="admin_password" id="input-name" class="form-control form-control-alternative{{ $errors->has('admin_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Admin Password') }}" value="{{ old('admin_password', '') }}" autofocus>
                            @if ($errors->has('admin_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('admin_password') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>


                <center>
                  <button type="submit" class="btn btn-small btn-success my-3">
                    Configure System
                  </button>
                </center>
              </form>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
