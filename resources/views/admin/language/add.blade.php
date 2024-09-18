@extends('admin.layouts.app')
@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">Language</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('language') }}">Language</a></li>
                                <li class="breadcrumb-item">Add</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('language.add') }}" class="btn btn-lg btn-neutral fade-class"><i class="fas fa-plus fa-lg"></i> New</a>
                        {{--                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
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
                                <h3 class="mb-0">{{ __('Add') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('language.store') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('post')

                                <h6 class="heading-small text-muted mb-4">{{ __('Add Language ') }}</h6>

                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="pl-lg-4 row">


                                    <div class="col-md-3 form-group{{ $errors->has('language_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Language Name') }}</label>
                                        <input type="text" name="language_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('language_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Language Name') }}" value="{{ old('language_name', '') }}" autofocus>

                                        @if ($errors->has('language_name'))
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('language_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-2 form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Code') }}</label>
                                        <input type="text" name="code" id="code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __('Code (example:en-gb,ar)') }}" value="{{ old('code', '') }}" autofocus>

                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-2 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="status">{{ __('Status') }}</label>
                                        <select class="form-control" name="status">
                                            @foreach(config('constant.status') as $key => $value )
                                            <option value={{ $key }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-2 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="default_lang">{{ __('Default Language') }}</label>
                                        <select class="form-control" name="default_lang">
                                            @foreach(config('constant.languages') as $key => $value )
                                            <option value={{ $key }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-2 form-group{{ $errors->has('sort_order') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Sort Order') }}</label>
                                        <input type="text" name="sort_order" id="sort_order" class="form-control form-control-alternative{{ $errors->has('sort_order') ? ' is-invalid' : '' }}" placeholder="{{ __('Sort order') }}" value="{{ old('sort_order', '') }}" autofocus>
                                    </div>

                                    <div class="col-md-3 form-group{{ $errors->has('language_flag') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="default_lang">{{ __('Language Flag') }}</label>
                                      <input type="file" class="form-control" name="language_flag" value="">
                                      @if ($errors->has('language_flag'))
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('language_flag') }}</strong>
                                      </span>
                                      @endif
                                    </div>


                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('language') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
