@extends('admin.layouts.app')
<link href="{{ asset('frontend') }}/css/select2.min.css" rel="stylesheet">
@section('content')
<div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">SMS Marketing</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('manufacturer') }}">SMS Marketing</a></li>
                                <li class="breadcrumb-item">Add</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-left">
                     @if(!empty($AlertMsg))
                        <div class="alert alert-danger"> {{ $AlertMsg}}</div>
                    @endif
                    {{--@if(\Auth::user()->is_admin != 1)
                       <a href="{{ route('manufacturer.add') }}" class="btn"><i class="fas fa-plus fa-sm"></i>Add</a>
                    @endif --}}
                        {{-- a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
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
                            <form method="post" action="{{ route('smsmarketing.send') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('post')

                                <h6 class="heading-small text-muted mb-4">{{ __('Send SMS') }}</h6>

                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="pl-lg-4 row">
                                <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="form-control-label" for="status">{{ __('Mobile Number') }}</label>
                                                <select name="telephone_arr[]" id="select_emailIds" class="db-store-multiple topstoreselect" required="required"
                                                multiple="multiple">
                                                    <option value="1">All</option>
                                                    {{-- <option value="" disabled selected>Select Number</option> --}}
                                                    @foreach($telephonesRecords as $key=>$value)
                                                        @if(!empty($value->country_code))
                                                          <option value="{{$value->country_code}}{{$value->telephone }}">{{ $value->telephone }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                        <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', '') }}" autofocus>

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>


                                    <div class="col-md-6 form-group{{ $errors->has('textmessege') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-textmessege">{{ __('Text Messege') }}</label>
                                        <input type="text" name="textmessege" id="textmessege" value="{{ old('textmessege', '') }}" placeholder="{{ __('Enter textmessege') }}" class="form-control form-control-alternative{{ $errors->has('textmessege') ? ' is-invalid' : '' }}" autofocus>
                                        @if ($errors->has('textmessege'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('textmessege') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    {{-- <div class="col-md-12 form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Email Body') }}</label>
                                        <textarea name="email_body"  class="ckeditor form-control-alternative" placeholder="{{ __('Enter Newslatter Content') }}" value="{{ old('email_body','') }}">{!! old('email_body','') !!}</textarea>
                                    </div> --}}

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Send') }}</button>
                                        {{-- <a href="{{ route('manufacturer') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a> --}}
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
<script src="{{ asset('frontend') }}/js/select2.min.js" ></script>
<script>
  $('#select_emailIds').select2();
</script>
<script src="//cdn.ckeditor.com/4.4.7/standard-all/ckeditor.js"></script>
<script src="http://cdn.ckeditor.com/4.4.7/standard-all/adapters/jquery.js"></script>
@endpush
