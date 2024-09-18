@extends('admin.layouts.app')

@section('content')
@php @endphp

<div class="header bg-primary pb-1">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-black d-inline-block mb-0">Category</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
              <li class="breadcrumb-item">Add</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('category.add') }}" class="btn btn-lg btn-neutral fade-class"><i
              class="fas fa-plus fa-lg"></i> New</a>
          {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="align-items-center d-flex flex-wrap gap-5 justify-content-between mb-2 pb-1">
    <h4><i class="icofont-plugin"></i> Add New Category</h4>
  </div>
  <form method="post" class="row" action="{{ route('category.store') }}" enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    @method('post')
    <div class="col-lg-7 col-md-7 col-sm-12">
      <div class="card mb-30">
        <div class="card-header bg-white border-bottom2">
          <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Category Information</h4>
          </div>
        </div>
        <div class="card-body">
          <ul class="language nav nav-tabs  mb-5" id="languageTab" role="tablist">
            @foreach(getLanguages() as $key=>$language)
            <li class="nav-item">
              <a class="nav-link  @if($key == 0) text-primary font-weight-bold text-lg active @endif"
                id="language-tab{{$language->id}}" data-toggle="tab" href="#language{{$language->id}}" role="tab"
                aria-controls="{{$language->language_name}}" aria-selected="true">{{$language->language_name}}</a>
            </li>
            @endforeach
          </ul>
          <div class="tab-content tab-validate" style="margin-top:20px;">
            @foreach(getLanguages() as $key=>$language)
            <div class="tab-pane @if($key == 0) active @endif" id="language{{$language->id}}">
              <h4 class="ml-3 mb-3 text-info"> Enter data in {{$language->language_name}} </h4>
              <div class="pl-lg-4 row">

                <div class="col-md-6 form-group{{ $errors->has('multilanguage.*.name') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                  <input type="text" name="multilanguage[{{$language->id}}][name]" id="input-name"
                    class="form-control form-control-alternative{{ $errors->has('multilanguage.*.name') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Enter Name') }}" value="{{ old('name', '') }}" autofocus>
                  @if ($errors->has('multilanguage.*.name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('multilanguage.*.name') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-name">{{ __('Meta Title') }}</label>
                  <input type="text" name="multilanguage[{{$language->id}}][meta_title]" id="meta_title"
                    class="form-control form-control-alternative{{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Meta Title') }}" value="{{ old('meta_title', '') }}" autofocus>

                  @if ($errors->has('meta_title'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('meta_title') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('meta_keyword') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-name">{{ __('Meta Keyword') }}</label>
                  <input type="text" name="multilanguage[{{$language->id}}][meta_keyword]" id="meta_keyword"
                    class="form-control form-control-alternative{{ $errors->has('meta_keyword') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Meta Keyword') }}" value="{{ old('meta_keyword', '') }}" autofocus>

                  @if ($errors->has('meta_keyword'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('meta_keyword') }}</strong>
                  </span>
                  @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
                  <label class="form-control-label" for="input-name">{{ __('Meta Description') }}</label>
                  <textarea name="multilanguage[{{$language->id}}][meta_description]" id="meta_description"
                    class="form-control form-control-alternative{{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Meta Description') }}" value="{{ old('meta_description', '') }}"
                    rows="3"></textarea>
                  @if ($errors->has('meta_description'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('meta_description') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-12">
      <div class="card mb-30">
        <div class="card-header bg-white border-bottom2">
          <div class="d-sm-flex justify-content-between align-items-center">
            <h4>Category Data</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="pl-lg-4 row">
            <div class="col-md-6 form-group{{ $errors->has('parent_id') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="parent_id">{{ __('Parent Category') }}</label>
              <select class="form-control" name="parent_id">
                <option value="0">Select</option>
                @foreach($parentCategory as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
              </select>
              @if ($errors->has('parent_id'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('parent_id') }}</strong>
              </span>
              @endif
            </div>


            <div class="col-md-6 form-group{{ $errors->has('sort_order') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Sort Order') }}</label>
              <input type="number" min="1" name="sort_order" id="sort_order" value="{{ old('sort_order', '') }}"
                class="form-control form-control-alternative{{ $errors->has('sort_order') ? ' is-invalid' : '' }}"
                autofocus>
              @if ($errors->has('sort_order'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sort_order') }}</strong>
              </span>
              @endif
            </div>

            <div class="col-md-6 form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-email">{{ __('Image') }}</label>
              <input type="file" name="image" id="input-email"
                class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}"
                value="{{ old('image', '') }}" required>

              @if ($errors->has('image'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('image') }}</strong>
              </span>
              @endif
            </div>

            <div class="col-md-6 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
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

          </div>
        </div>
      </div>
    </div>

    <div
      class="bottom-btn bg-white  d-flex align-items-center justify-content-sm-end gap-10 flex-wrap justify-content-center">
      <button type="submit" name="submit" value="1" class="btn btn-success" tabindex="4">
        Save Category
      </button>
    </div>
  </form>
</div>



@endsection

@push('js')

<!-- JavaScript -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/alertify.min.css">
<!-- Default theme -->
<link href="{{ asset('frontend') }}/css/default.min.css" rel="stylesheet">

<script type="text/javascript">
  let next  =false;
$('.btnNext').click(function() {
  var tabIdx = $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').attr('data-id');
  if(tabIdx == 2) {
    var productName = $("[name='name']").val();
    if(productName == '') {
      alertify.alert('Required', 'Name Required', function(){  });
      next = false;
    }
    else {
      next = true
    }
  }

  if(next) {
    $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
  }

  if(tabIdx  > 2) {
    $('#btnPrev').removeClass('d-none')
  }
});


$(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
  var idx = $(this).index('a[data-toggle="tab"]');

  if(idx == 1) {
    var productName = $("[name='name']").val();
    if(productName == '') {
        alertify.alert('Required', 'Name Required', function(){  });
        return false;
    }
  }

  if(idx == 1) {
    var productName = $("[name='name']").val();
    if(productName == '') {
      $('.alert').alert()
    }
  }

  if(idx  > 0) {
    $('#btnPrev').removeClass('d-none')
  }
  if(idx  == 0) {
    $('#btnPrev').addClass('d-none')
  }
    if(idx == 6) {
      $('#btnNxt').addClass('d-none');
      $('#btnSave').removeClass('d-none');
    }
  else {
    $('#btnNxt').removeClass('d-none');
    $('#btnSave').addClass('d-none');
  }
});




</script>
@endpush