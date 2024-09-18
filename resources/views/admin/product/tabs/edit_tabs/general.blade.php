<div class="tab-pane active" id="tab-general">
    <ul class="language nav nav-tabs  mb-5" id="languageTab" role="tablist">
      @foreach(getLanguages() as $key=>$language)
        <li class="nav-item">
          <a class="nav-link  @if($key == 0) text-primary font-weight-bold text-lg active @endif" id="language-tab{{$language->id}}" data-toggle="tab" href="#language{{$language->id}}" role="tab" aria-controls="{{$language->language_name}}" aria-selected="true">{{$language->language_name}}</a>
        </li>
      @endforeach
    </ul>

    <div class="tab-content tab-validate" style="margin-top:20px;">

      @foreach(getLanguages() as $key=>$lang)
        <div class="tab-pane @if($key == 0) active @endif" id="language{{$lang->id}}">
         <h4 class="ml-3 mb-3 text-info"> Enter data in {{$lang->language_name}} </h4>
          @foreach($data['data']->productMultipleDescription as $key2=>$language)
            @if($lang->id == $language->language_id)
              <div >
               <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-name">{{ __('Product Name') }}*</label>
                <input type="text" name="multilanguage[{{$language->id}}][name]"  class="form-control productName{{$language->id}} form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $language->name ) }}" autofocus onkeyup="onProductNameChange('{{$language->id}}')">

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="chatGPTButton{{$language->id}} mx-3 mb-4 d-none">
              <button class="btn-chatgpt btn btn-md btn-dark" onclick="getContentFromChatGPT('{{$language->id}}')"><i class="fas fa-robot"></i>  Get Content From ChatGPT</button>
            </div>
            <div class="col-md-12 form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-name">{{ __('Product Short Description') }}</label>
                <textarea name="multilanguage[{{$language->id}}][short_description]"  class="form-control short_description" placeholder="{{ __('Product Short Description') }}" value="{{ old('short_description','') }}">{!! old('short_description',$language->short_description) !!}</textarea>
                @if ($errors->has('short_description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('short_description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-12 form-group{{ $errors->has('product_description') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-name">{{ __('Product Description') }}</label>
                <textarea name="multilanguage[{{$language->id}}][description]" id="editor{{$language->id}}"  class="ckeditor{{$language->id}} form-control" placeholder="{{ __('Product Description') }}" value="{{ old('description',$language->description ) }}">{!! $language->description  !!}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          @endif
        @endforeach
        @php
          $find = array_search($lang->id, array_column($data['data']->productMultipleDescription->toArray(), 'language_id'));
        @endphp
        @if($find === false)
          <div class="col-md-12 form-group{{ $errors->has('multilanguage.*.name') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Product Name') }}*</label>
              <input type="text"  name="multilanguage[{{$lang->id}}][name]"  class="form-control  productName{{$lang->id}} form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', '') }}" autofocus required  onkeyup="onProductNameChange('{{$lang->id}}')">
              @if ($errors->has('multilanguage.*.name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('multilanguage.*.name') }}</strong>
                  </span>
              @endif
          </div>

          <div class="chatGPTButton{{$lang->id}} mx-3 mb-4 d-none">
            <button class="btn-chatgpt btn btn-md btn-dark" onclick="getContentFromChatGPT('{{$lang->id}}')"><i class="fas fa-robot"></i>  Get Content From ChatGPT</button>
          </div>

          <div class="col-md-12 form-group{{ $errors->has('short_description') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Product Short Description') }}</label>
              <textarea name="multilanguage[{{$lang->id}}][short_description]"  class="form-control short_description{{$lang->id}}" placeholder="{{ __('Product Short Description') }}" value="{{ old('short_description','') }}">{!! old('short_description','') !!}</textarea>
              @if ($errors->has('short_description'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('short_description') }}</strong>
                  </span>
              @endif
          </div>

          <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Product Description') }}</label>
              <textarea name="multilanguage[{{$lang->id}}][description]"  id="editor{{$lang->id}}"  class="ckeditor{{$lang->id}} form-control" placeholder="{{ __('Product Description') }}" value="{{ old('description','') }}">{!! old('description','') !!}</textarea>
              @if ($errors->has('description'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
          </div>

        @endif
      </div>
    @endforeach



        <div class="col-md-12 form-group{{ $errors->has('main_image') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-maiin">{{ __('Image') }}</label>
            <input type="file" name="main_image" id="input-maiin" class="form-control form-control-alternative{{ $errors->has('main_image') ? ' is-invalid' : '' }}" value="{{ old('main_image', '') }}" >
            <a target="_blank" href="{{ url(config('constant.file_path.product')."/$product->image") }}">View Image</a>

            @if ($errors->has('main_image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('main_image') }}</strong>
                </span>
            @endif
        </div>

  </div>
</div>
