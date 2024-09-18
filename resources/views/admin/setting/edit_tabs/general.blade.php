<div class="tab-pane" id="tab-general">
    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_store_url" class="control-label">Website Theme Color</label>
                <input type="text" name="config_web_bg" id="config_web_bg" value="{{ old('config_web_bg', \App\Models\Setting::setInputValue($data,'config_web_bg')) }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_meta_title" class="control-label">Meta Title</label>
                <input type="text" name="config_meta_title" id="config_meta_title" value="{{ old('config_meta_title', \App\Models\Setting::setInputValue($data,'config_meta_title')) }}" class="form-control" />
            </div>
        </div>



        <div class="col-md-6">
            <div class="form-group">
                <label for="config_meta_tag_description" class="control-label">Meta Tag Description</label>
                <textarea name="config_meta_tag_description" rows="3"  id="config_meta_tag_description" class="form-control">{{ \App\Models\Setting::setInputValue($data,'config_meta_tag_description') }}</textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="config_meta_tag_keywords" class="control-label">Meta Tag Keywords</label>
                <textarea name="config_meta_tag_keywords" rows="3"  id="config_meta_tag_keywords" class="form-control">{{ \App\Models\Setting::setInputValue($data,'config_meta_tag_keywords') }}</textarea>
            </div>
        </div>
    </div>

    <h3>Social Site</h3>
    <div class="pl-lg-4 row">
      <div class="col-md-4">
        <div class="form-group">
            <label for="config_ssl_url" class="control-label">Facebook URL</label>
            <input type="text" name="config_fb_url" id="config_fb_url" value="{{ old('config_fb_url', \App\Models\Setting::setInputValue($data,'config_fb_url')) }}" class="form-control" />
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label for="config_ssl_url" class="control-label">Linkedin URL</label>
            <input type="text" name="config_linkedin_url" id="config_linkedin_url" value="{{ old('config_linkedin_url', \App\Models\Setting::setInputValue($data,'config_linkedin_url')) }}" class="form-control" />
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label for="config_ssl_url" class="control-label">Twitter URL</label>
            <input type="text" name="config_twitter_url" id="config_twitter_url" value="{{ old('config_twitter_url', \App\Models\Setting::setInputValue($data,'config_twitter_url')) }}" class="form-control" />
        </div>
      </div>


      <div class="col-md-4">
        <div class="form-group">
            <label for="config_ssl_url" class="control-label">Instagram URL</label>
            <input type="text" name="config_insta_url" id="config_insta_url" value="{{ old('config_insta_url', \App\Models\Setting::setInputValue($data,'config_insta_url')) }}" class="form-control" />
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label for="config_ssl_url" class="control-label">Youtube URL</label>
            <input type="text" name="config_youtube_url" id="config_youtube_url" value="{{ old('config_youtube_url', \App\Models\Setting::setInputValue($data,'config_youtube_url')) }}" class="form-control" />
        </div>
      </div>
    </div>

</div>
