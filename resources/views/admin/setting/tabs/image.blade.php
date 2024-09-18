    <div class="pl-lg-4 row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="config_store_image">{{ __('Store Logo') }}</label>
                <input type="file" name="config_store_image"  id="config_store_image" value="{{ old('config_store_image', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="config_icon_image">{{ __('Icon') }}</label>
                <input type="file" name="config_icon_image"  id="config_icon_image" value="{{ old('config_icon_image', '') }}" class="form-control" />
            </div>
        </div>
    </div>
