@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">Payment Method</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('payment-methods') }}">Payment Methods</a></li>
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('payment-methods.update',['id' => $data->id]) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Edit Payment Method ') }}</h6>

                            <div class="pl-lg-4 row">
                                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $data->name) }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group{{ $errors->has('is_active') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="is_active">{{ __('Status') }}</label>
                                    <select class="form-control" name="is_active">
                                        @foreach(config('constant.status') as $key => $value )
                                            <option value={{ $key }} {{ $data->is_active == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('is_active'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('is_active') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="pl-lg-4 row">
                                <div class="col-md-6 form-group{{ $errors->has('payment_key') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-payment_key">{{ __('Payment Key') }}</label>
                                    <input type="text" name="payment_key" id="input-payment_key" class="form-control form-control-alternative{{ $errors->has('payment_key') ? ' is-invalid' : '' }}" placeholder="{{ __('Payment Key') }}" value="{{ old('payment_key', $data->payment_key) }}" autofocus>

                                    @if ($errors->has('payment_key'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payment_key') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('payment_secret') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-payment_secret">{{ __('Payment Secret') }}</label>
                                    <input type="text" name="payment_secret" id="input-payment_secret" class="form-control form-control-alternative{{ $errors->has('payment_secret') ? ' is-invalid' : '' }}" placeholder="{{ __('Payment Secret') }}" value="{{ old('payment_secret', $data->payment_secret) }}" autofocus>

                                    @if ($errors->has('payment_secret'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payment_secret') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>

                              <div class="pl-lg-4 row">
                                  <div class="col-md-6 form-group{{ $errors->has('payment_code') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-name">{{ __('Payment Code') }}</label>
                                      <input type="text" name="payment_code" id="input-payment_code" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Payment Code') }}" value="{{ old('payment_code', $data->payment_code) }}" autofocus>

                                      @if ($errors->has('payment_code'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('payment_code') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                  <div class="col-md-6 form-group{{ $errors->has('payment_mode') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="payment_mode">{{ __('Payment Mode') }}</label>
                                      <select class="form-control" name="payment_mode">
                                        <option value="sandbox">Sandbox</option>
                                        <option value="live">Live</option>
                                      </select>
                                      @if ($errors->has('payment_mode'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('payment_mode') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="pl-lg-4 row">


                                  <div class="col-md-6 form-group{{ $errors->has('merchant_email') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-merchant_email">{{ __('Merchant Email') }}</label>
                                      <input type="text" name="merchant_email" id="input-merchant_email" class="form-control form-control-alternative{{ $errors->has('merchant_email') ? ' is-invalid' : '' }}" placeholder="{{ __('Merchant Email') }}" value="{{ old('merchant_email', $data->merchant_email) }}" autofocus>
                                      @if ($errors->has('merchant_email'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('merchant_email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                  <div class="col-md-6 form-group{{ $errors->has('payment_url') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-payment_url">{{ __('Payment URL') }}</label>
                                      <input type="text" name="payment_url" id="input-payment_url" class="form-control form-control-alternative{{ $errors->has('payment_url') ? ' is-invalid' : '' }}" placeholder="{{ __('Payment URL') }}" value="{{ old('payment_url', $data->payment_url) }}" autofocus>
                                      @if ($errors->has('payment_url'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('payment_url') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                  <div class="col-md-6 form-group{{ $errors->has('payment_logo') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-payment_logo">{{ __('Payment Logo') }}</label>
                                      <input type="file" name="payment_logo" value="" class="form-control">
                                      <img src="{{asset('/uploads/paymentmethods')}}/{{$data->payment_logo}}" alt="" class="my-5">
                                      @if ($errors->has('payment_logo'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('payment_logo') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                  <div class="col-md-6 form-group{{ $errors->has('sort_order') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-sort_order">{{ __('Sort Order') }}</label>
                                      <input type="text" name="sort_order" id="input-sort_order" class="form-control form-control-alternative{{ $errors->has('payment_secret') ? ' is-invalid' : '' }}" placeholder="{{ __('Sort Order') }}" value="{{ old('sort_order', $data->sort_order) }}" autofocus>

                                      @if ($errors->has('sort_order'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('sort_order') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="{{ route('payment-methods') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
