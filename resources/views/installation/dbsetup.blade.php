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
            <p class="text-center">Fill form with valid database credentials</p>
            <ol class="list-group rounded-2">

              <form method="post" action="{{ route('db.store') }}"  autocomplete="off">
                  @csrf
                  @method('post')

                  <div class="pl-lg-4 row">
                      <div class="col-md-6 form-group{{ $errors->has('db_host') ? ' has-danger' : '' }}">
                          <label class="form-control-label my-3" for="input-name">{{ __('Database Host') }}</label>
                          <input type="text" name="db_host" id="input-name" class="form-control form-control-alternative{{ $errors->has('db_host') ? ' is-invalid' : '' }}" placeholder="{{ __('Database Host') }}" value="{{ old('db_host', '') }}" autofocus>
                          @if ($errors->has('db_host'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('db_host') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="col-md-6 form-group{{ $errors->has('db_name') ? ' has-danger' : '' }}">
                          <label class="form-control-label my-3" for="input-name">{{ __('Database Name') }}</label>
                          <input type="text" name="db_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('db_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Database Name') }}" value="{{ old('db_host', '') }}" autofocus>
                          @if ($errors->has('db_name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('db_name') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="pl-lg-4 row">
                        <div class="col-md-6 form-group{{ $errors->has('db_username') ? ' has-danger' : '' }}">
                            <label class="form-control-label my-3" for="input-name">{{ __('Database Username') }}</label>
                            <input type="text" name="db_username" id="input-name" class="form-control form-control-alternative{{ $errors->has('db_host') ? ' is-invalid' : '' }}" placeholder="{{ __('Database Username') }}" value="{{ old('db_username', '') }}" autofocus>
                            @if ($errors->has('db_username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('db_username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('db_password') ? ' has-danger' : '' }}">
                            <label class="form-control-label my-3" for="input-name">{{ __('Database Password') }}</label>
                            <input type="password" name="db_password" id="input-name" class="form-control form-control-alternative{{ $errors->has('db_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Database Password') }}" value="{{ old('db_password', '') }}" autofocus>
                            @if ($errors->has('db_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('db_password') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>


                <center>
                  <button type="submit" class="btn btn-small btn-success my-3">
                    Configure Database
                  </button>
                </center>
              </form>
            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
