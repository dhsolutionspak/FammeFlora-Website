<div class="tab-pane active" id="tab-store">
    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_store_name" class="control-label">Store Name</label>
                <input type="text" name="config_store_name" id="config_store_name" value="{{ old('config_store_name', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_store_owner" class="control-label">Store Owner</label>
                <input type="text" name="config_store_owner" id="config_store_owner" value="{{ old('config_store_owner', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_address" class="control-label">Address</label>

                <textarea name="config_address" rows="3"  id="config_address" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_geocode" class="control-label">Geocode</label>
                <input type="text" name="config_geocode"  id="config_geocode" value="{{ old('config_geocode', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_email" class="control-label">Email</label>
                <input type="text" name="config_email"  id="config_email" value="{{ old('config_email', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_telephone" class="control-label">Telephone</label>
                <input type="text" name="config_telephone"  id="config_telephone" value="{{ old('config_telephone', '') }}" class="form-control" />
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label for="config_fax" class="control-label">PostCode</label>
                <input type="text" name="config_fax"  id="config_fax" value="{{ old('config_fax', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="config_image">{{ __('Image') }}</label>
                <input type="file" name="config_image"  id="config_image" value="{{ old('config_image', '') }}" class="form-control" />
            </div>
        </div>
    </div>
</div>
