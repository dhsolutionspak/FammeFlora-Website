<div class="tab-pane" id="tab-general">
    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_store_url" class="control-label">Store URL</label>
                <input type="text" name="config_store_url" id="config_store_url" value="{{ old('config_store_url', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_ssl_url" class="control-label">SSL URL</label>
                <input type="text" name="config_ssl_url" id="config_ssl_url" value="{{ old('config_ssl_url', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_ssl_url" class="control-label">SSL URL</label>
                <input type="text" name="config_ssl_url" id="config_ssl_url" value="{{ old('config_ssl_url', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_meta_title" class="control-label">Meta Title</label>
                <input type="text" name="config_meta_title" id="config_meta_title" value="{{ old('config_meta_title', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="config_meta_tag_description" class="control-label">Meta Tag Description</label>
                <textarea name="config_meta_tag_description" rows="3"  id="config_meta_tag_description" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="config_meta_tag_keywords" class="control-label">Meta Tag Keywords</label>
                <textarea name="config_meta_tag_keywords" rows="3"  id="config_meta_tag_keywords" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>
