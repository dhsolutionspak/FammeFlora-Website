<div class="tab-pane active" id="tab-general">
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

      <div class="col-md-12 form-group{{ $errors->has('multilanguage.*.name') ? ' has-danger' : '' }}">
          <label class="form-control-label" for="input-name">{{ __('Product Name') }}*</label>
          <input type="text"  name="multilanguage[{{$language->id}}][name]"  class="form-control  productName{{$language->id}} form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', '') }}" autofocus required  onkeyup="onProductNameChange('{{$language->id}}')">
          @if ($errors->has('multilanguage.*.name'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('multilanguage.*.name') }}</strong>
              </span>
          @endif
      </div>

      <div class="chatGPTButton{{$language->id}} mx-3 mb-4 d-none">
        <button class="btn-chatgpt btn btn-md btn-dark" onclick="getContentFromChatGPT('{{$language->id}}')"><i class="fas fa-robot"></i>  Get Content From ChatGPT</button>
      </div>

      <div class="col-md-12 form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
          <label class="form-control-label" for="input-name">{{ __('Product Short Description') }}</label>
          <textarea name="multilanguage[{{$language->id}}][short_description]"  class="form-control short_description{{$language->id}}" placeholder="{{ __('Product Short Description') }}" value="{{ old('short_description','') }}">{!! old('short_description','') !!}</textarea>
          @if ($errors->has('short_description'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('short_description') }}</strong>
              </span>
          @endif
      </div>

      <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
          <label class="form-control-label" for="input-name">{{ __('Product Description') }}</label>
          <textarea name="multilanguage[{{$language->id}}][description]"  id="editor{{$language->id}}"  class="ckeditor{{$language->id}} form-control" placeholder="{{ __('Product Description') }}" value="{{ old('description','') }}">{!! old('description','') !!}</textarea>
          @if ($errors->has('description'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('description') }}</strong>
              </span>
          @endif
      </div>

    </div>
  @endforeach
</div>

  <div class="col-md-12 form-group{{ $errors->has('main_image') ? ' has-danger' : '' }}">
      <label class="form-control-label" for="input-email">{{ __('Image') }}</label>
      <input type="file" name="main_image" id="input-email" class="form-control form-control-alternative{{ $errors->has('main_image') ? ' is-invalid' : '' }}" value="{{ old('main_image', '') }}" >

      @if ($errors->has('main_image'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('main_image') }}</strong>
          </span>
      @endif
  </div>




</div>
