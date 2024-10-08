@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-country">Attribute Group</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product-attribute-group') }}">Attribute Group</a></li>
                                <li class="breadcrumb-item">Add</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('product-attribute-group.add') }}" class="btn btn-lg btn-neutral fade-class"><i class="fas fa-plus fa-lg"></i> New</a>
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
                            <h3 class="mb-0">{{ __('Edit') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('product-attribute-group.update',['id' => $data->id ]) }}"  autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Edit Attribute Group ') }}</h6>

                            <div class="pl-lg-4 row">
                              <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                  <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                  @foreach(getLanguages() as $key=>$language)
                                   @foreach($data->attributeGroupMultipleDescription as $key=>$languagedata)
                                   @if($language->id == $languagedata->language_id)
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">{{$languagedata->language_name}} </span>
                                      </div>
                                      <input type="text" value="{{ old('name', $languagedata->name) }}" name="multilanguage[{{$languagedata->id}}][name]" class="form-control form-control-alternative{{ $errors->has('multilanguage.*.name') ? ' is-invalid' : '' }}" placeholder="{{_('Name')}}" aria-label="Name" aria-describedby="basic-addon1">
                                      @if ($errors->has('multilanguage.*.name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('multilanguage.*.name') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                    @endif
                                  @endforeach
                                  @php
                                    $find = array_search($language->id, array_column($data->attributeGroupMultipleDescription->toArray(), 'language_id'));
                                  @endphp
                                  @if($find === false)
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">{{$language->language_name}} </span>
                                    </div>
                                    <input type="text" name="multilanguage[{{$language->id}}][name]" class="form-control form-control-alternative{{ $errors->has('multilanguage.*.name') ? ' is-invalid' : '' }}" placeholder="{{_('Name')}}" aria-label="Name" aria-describedby="basic-addon1">
                                    @if ($errors->has('multilanguage.*.name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('multilanguage.*.name') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  @endif
                                @endforeach
                              </div>

                                <div class="col-md-4 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="status">{{ __('Status') }}</label>
                                    <select class="form-control" name="status">
                                        @foreach(config('constant.status') as $key => $value )
                                            <option value={{ $key }} {{ $data->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="pl-lg-4 row">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('product-attribute-group') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
