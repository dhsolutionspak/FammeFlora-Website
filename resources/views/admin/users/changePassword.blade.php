@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-country">User Change Password</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
                                <li class="breadcrumb-item">Change Password</li>
                            </ol>
                        </nav>
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
                            <h3 class="mb-0">{{ __('Change Password') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.updatePassword') }}"  autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Update User Password ') }}</h6>

                            <div class="pl-lg-4 row">
                                <div class="col-md-4 form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-old_password">{{ __('Old Password') }}</label>
                                    <input type="password" name="old_password" id="input-old_password" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Old Password') }}" value="{{ old('old_password', '') }}" autofocus>

                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('new_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-new_password">{{ __('New Password') }}</label>
                                    <input type="password" name="new_password" id="input-new_password" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="{{ old('new_password', '') }}" autofocus>

                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('confirm_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-confirm_password">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="confirm_password" id="input-confirm_password" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}" value="{{ old('confirm_password', '') }}" autofocus>

                                    @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="pl-lg-4 row">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('user') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
@endpush
