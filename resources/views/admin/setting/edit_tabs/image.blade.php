<div class="tab-pane" id="tab-image">
    <div class="pl-lg-4 row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="config_store_image">{{ __('Store Logo') }}</label>
                <input type="file" name="config_store_image"  id="config_store_image" value="{{ old('config_store_image', '') }}" class="form-control" />
                @php
                    $configStoreImage = \App\Models\Setting::setInputValue($data,'config_store_image')
                @endphp

                @if($configStoreImage)
                    <a target="_blank" href="{{ url(config('constant.file_path.store')."/$configStoreImage") }}">View Image</a>
                @endif

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="config_icon_image">{{ __('Favicon Icon') }}</label>
                <input type="file" name="config_icon_image"  id="config_icon_image" value="{{ old('config_icon_image', '') }}" class="form-control" />
                @php
                    $configIconImage = \App\Models\Setting::setInputValue($data,'config_icon_image')
                @endphp

                @if($configIconImage)
                    <a target="_blank" href="{{ url(config('constant.file_path.store')."/$configIconImage") }}">View Image</a>
                @endif

            </div>
        </div>
    </div>
</div>
