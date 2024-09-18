@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-country">Blog</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                                <li class="breadcrumb-item">Add</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
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
                        <form method="post" action="{{ route('blog.store') }}"  autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Add Blog ') }}</h6>


                            <div class="card-body">
                              <ul class="language nav nav-tabs  mb-5" id="languageTab" role="tablist">
                                @foreach(getLanguages() as $key=>$language)
                                  <li class="nav-item">
                                    <a class="nav-link  @if($key == 0) text-primary font-weight-bold text-lg active @endif" id="language-tab{{$language->id}}" data-toggle="tab" href="#language{{$language->id}}" role="tab" aria-controls="{{$language->language_name}}" aria-selected="true">{{$language->language_name}}</a>
                                  </li>
                                @endforeach
                              </ul>
                              <div class="tab-content tab-validate" style="margin-top:20px;">
                                @foreach(getLanguages() as $key=>$language)
                                  <div class="tab-pane @if($key == 0) active @endif" id="language{{$language->id}}">
                                    <h4 class="ml-3 mb-3 text-info"> Enter data in {{$language->language_name}} </h4>
                                    <div class="pl-lg-4 row">

                                        <div class="col-md-6 form-group{{ $errors->has('multilanguage.*.title') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Blog Title') }}</label>
                                            <input type="text" name="multilanguage[{{$language->id}}][title]" id="input-name" class="form-control blogTitle{{$language->id}} form-control-alternative{{ $errors->has('multilanguage.*.name') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter Blog Title') }}" value="{{ old('title', '') }}" autofocus onkeyup="onBlogTitle('{{$language->id}}')">
                                            @if ($errors->has('multilanguage.*.title'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('multilanguage.*.title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                      </div>
                                        <div class="chatGPTButton mx-3 mb-4 d-none">
                                          <button class="btn-chatgpt btn btn-md btn-dark" onclick="getContentFromChatGPT('{{$language->id}}')"><i class="fas fa-robot"></i>  Get Content From ChatGPT</button>
                                        </div>

                                        <div class="pl-lg-4 row">
                                          <div class="col-md-6 form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-short_description">{{ __('Short Description') }}</label>
                                            <textarea name="multilanguage[{{$language->id}}][short_description]" id="short_description" class="form-control form-control-alternative{{ $errors->has('short_description') ? ' is-invalid' : '' }} short_description{{$language->id}}" placeholder="{{ __('Short Description') }}" value="{{ old('short_description', '') }}" rows="3"></textarea>
                                            @if ($errors->has('short_description'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('short_description') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                      </div>
                                      <div class="pl-lg-4 row">
                                        <div class="col-md-8 form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Blog Description') }}</label>
                                            <textarea name="multilanguage[{{$language->id}}][description]"  id="editor{{$language->id}}"  class="ckeditor{{$language->id}} form-control" placeholder="{{ __('Product Description') }}" value="{{ old('description','') }}">{!! old('description','') !!}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                      </div>

                                  </div>
                                @endforeach
                              </div>
                              <div class="pl-lg-4 row">
                               <div class="col-md-6 form-group">
                                   <label for="example-text-input" class="col-form-label">Blog Image</label>
                                   <br>
                                   <input type="file" name="image"/>

                                       @if ($errors->has('image'))
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $errors->first('image') }}</strong>
                                           </span>
                                       @endif
                                 </div>
                              </div>
                            </div>

                            <div class="pl-lg-4 row">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('blog') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
   <?php foreach (getLanguages() as $key=>$language) { ?>
     $('.ckeditor<?php echo $language->id ?>').ckeditor();
 <?php    } ?>
});

//chatGPT stuff
<?php  if(isset($chatGPT) && $chatGPT->enable)  { ?>
  function onBlogTitle(language) {
    if (this.timer) {
        window.clearTimeout(this.timer);
    }
    this.timer = window.setTimeout(function() {
      promoteChatGPT(language)
    }, 1000);
  }

  function promoteChatGPT(language) {
      if($('.blogTitle'+language).val().length > 3) {
          $('.chatGPTButton').removeClass('d-none')
      }
      else {
          $('.chatGPTButton').addClass('d-none')
      }
  }

  //get content from chat GPT
  function getContentFromChatGPT(language) {
      let keyword = $('.blogTitle'+language).val();

      $(".btn-chatgpt").attr("disabled", true);

      $('.btn-chatgpt').html(`<img src="{{asset('frontend/images')}}/artificial-intelligence.gif" height="50" />
          <p classs=" font-weight-600 ">Please Wait...</p>
      `)

      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
         url: "{{route('get-content-from-chatGPT')}}",
         type: 'post',
         data:{'keyword' :keyword,'type' : 'blog' ,'language' : language,'_token': CSRF_TOKEN},
         success: function (response) {
              $(".btn-chatgpt").removeAttr("disabled", true);
              $('.btn-chatgpt').html(`<i class="fas fa-robot"></i> Get Content From ChatGPT`);
              //set short description
              $('.short_description'+language).val(response.short_desc)
              //set description
              CKEDITOR.instances['editor'+language].insertHtml(response.long_desc)

            }
        })
      }


<?php } ?>
</script>

@endpush
