<div class="tab-pane active" id="tab-general">
    <ul class="language nav nav-tabs  mb-5" id="languageTab" role="tablist">
      @foreach(getLanguages() as $key=>$language)
        <li class="nav-item">
          <a class="nav-link  @if($key == 0) text-primary font-weight-bold text-lg active @endif" id="seo-language{{$language->id}}" data-toggle="tab" href="#seolanguage{{$language->id}}" role="tab" aria-controls="{{$language->language_name}}" aria-selected="true">{{$language->language_name}}</a>
        </li>
      @endforeach
    </ul>

    <div class="tab-content tab-validate my-3" >
     @foreach(getLanguages() as $key=>$lang)
      <div class="tab-pane @if($key == 0) active @endif" id="seolanguage{{$lang->id}}">
        <div class="chatGPTButton{{$lang->id}} mx-3 mb-4 d-none">
          <button class="btn-chatgpt btn btn-md btn-dark" onclick="getSeoContentFromChatGPT('{{$lang->id}}')"><i class="fas fa-robot"></i>  Get Seo Content From ChatGPT</button>
        </div>
        <h4 class="ml-3 mb-3 text-info"> Enter data in {{$lang->language_name}} </h4>
        @foreach($data['data']->productMultipleDescription as $key=>$language)
          @if($lang->id == $language->language_id)
          <div class="col-md-12 form-group{{ $errors->has('multilanguage.*.meta_title') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Meta Title') }}</label>
              <input type="text"  name="multilanguage[{{$language->id}}][meta_title]"  class="form-control meta_title{{$language->id}} form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Meta Title') }}" value="{{ old('meta_title', $language->meta_title) }}" autofocus >
              @if ($errors->has('multilanguage.*.meta_title'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('multilanguage.*.meta_title') }}</strong>
                  </span>
              @endif
          </div>

          <div class="col-md-12 form-group{{ $errors->has('multilanguage.*.meta_keyword') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Meta Keyword') }}</label>
              <input type="text"  name="multilanguage[{{$language->id}}][meta_keyword]"  class="form-control meta_keyword{{$language->id}} form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Meta Keyword') }}" value="{{ old('meta_keyword', $language->meta_keyword) }}" autofocus >
              @if ($errors->has('multilanguage.*.meta_keyword'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('multilanguage.*.meta_keyword') }}</strong>
                  </span>
              @endif
          </div>

          <div class="col-md-12 form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Meta Description') }}</label>
              <textarea name="multilanguage[{{$language->id}}][meta_description]"  class="meta_description{{$language->id}} form-control" placeholder="{{ __('Meta Description') }}" value="{{ old('meta_description','') }}">{!! old('meta_description',$language->meta_description) !!}</textarea>
              @if ($errors->has('meta_description'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('meta_description') }}</strong>
                  </span>
              @endif
          </div>
          @endif
        @endforeach

        @php
          $find = array_search($lang->id, array_column($data['data']->productMultipleDescription->toArray(), 'language_id'));
        @endphp
        @if($find === false)
          <div class="col-md-12 form-group{{ $errors->has('multilanguage.*.meta_title') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Meta Title') }}</label>
              <input type="text"  name="multilanguage[{{$lang->id}}][meta_title]"  class="form-control meta_title{{$lang->id}}  form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Meta Title') }}" value="{{ old('meta_title', '') }}" autofocus >
              @if ($errors->has('multilanguage.*.meta_title'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('multilanguage.*.meta_title') }}</strong>
                  </span>
              @endif
          </div>

          <div class="col-md-12 form-group{{ $errors->has('multilanguage.*.meta_keyword') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Meta Keyword') }}</label>
              <input type="text"  name="multilanguage[{{$lang->id}}][meta_keyword]"  class="form-control meta_keyword{{$lang->id}}  form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Meta Keyword') }}" value="{{ old('meta_keyword', '') }}" autofocus >
              @if ($errors->has('multilanguage.*.meta_keyword'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('multilanguage.*.meta_keyword') }}</strong>
                  </span>
              @endif
          </div>

          <div class="col-md-12 form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="input-name">{{ __('Meta Description') }}</label>
              <textarea name="multilanguage[{{$lang->id}}][meta_description]"  class="meta_description{{$lang->id}} form-control" placeholder="{{ __('Meta Description') }}" value="{{ old('meta_description','') }}">{!! old('meta_description','') !!}</textarea>
              @if ($errors->has('meta_description'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('meta_description') }}</strong>
                  </span>
              @endif
          </div>

        @endif

      </div>
      @endforeach

  </div>
</div>
