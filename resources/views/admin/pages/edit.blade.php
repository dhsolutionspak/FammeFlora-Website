@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-country">Page</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pages') }}">Page</a></li>
                            <li class="breadcrumb-item">Edit</li>
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
                            <h3 class="mb-0">{{ __('Edit') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('pages.update',['id' => $data->id]) }}"  autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Edit Page ') }}</h6>

                            <div class="pl-lg-4 row">
                                  <div class="col-md-6 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                      <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', $data->title) }}" autofocus required>

                                      @if ($errors->has('title'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('title') }}</strong>
                                          </span>
                                      @endif
                                  </div>

                                  <div class="col-md-6 form-group{{ $errors->has('heading') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="address_format">{{ __('Heading') }}</label>
                                      <input type="text" name="heading" id="address_format" class="form-control form-control-alternative{{ $errors->has('heading') ? ' is-invalid' : '' }}" placeholder="{{ __('Heading') }}" value="{{ old('heading', $data->heading) }}" required>

                                      @if ($errors->has('heading'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('heading') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="pl-lg-4 row">
                                <div class="col-md-12">
                                  <textarea class="ckeditor form-control" name="description" value="{{ old('description',  $data->description) }}">{!! $data->description !!}</textarea>
                                  @if ($errors->has('description'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('description') }}</strong>
                                      </span>
                                  @endif
                                </div>
                              </div>

                            </div>

                            <div class="pl-lg-4 row">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('pages') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/adapters/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endpush
