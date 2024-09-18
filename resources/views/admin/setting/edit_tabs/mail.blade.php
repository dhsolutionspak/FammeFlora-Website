    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_mail_engine" class="control-label">Mail Engine</label>
                <select class="form-control" name="config_mail_engine">
                  <option value="smtp">SMTP</option>
                  <option value="mailgun">Mailgun</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_hostname" class="control-label">SMTP Hostname</label>
                <input type="text" name="config_smtp_hostname" id="config_smtp_hostname" value="{{ old('config_smtp_hostname', \App\Models\Setting::setInputValue($data,'config_smtp_hostname')) }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_username" class="control-label">SMTP Username</label>
                <input type="text" name="config_smtp_username" id="config_smtp_username" value="{{ old('config_smtp_username', \App\Models\Setting::setInputValue($data,'config_smtp_username')) }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_password" class="control-label">SMTP Password</label>
                <input type="text" name="config_smtp_password" id="config_smtp_password" value="{{ old('config_smtp_password', \App\Models\Setting::setInputValue($data,'config_smtp_password')) }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_port" class="control-label">SMTP Port</label>
                <input type="text" name="config_smtp_port" id="config_smtp_port" value="{{ old('config_smtp_port', \App\Models\Setting::setInputValue($data,'config_smtp_port')) }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_timeout" class="control-label">SMTP Timeout</label>
                <input type="text" name="config_smtp_timeout" id="config_smtp_timeout" value="{{ old('config_smtp_timeout', \App\Models\Setting::setInputValue($data,'config_smtp_timeout')) }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_encryption" class="control-label">Email Encryption</label>
                <input type="text" name="config_encryption" id="config_encryption" value="{{ old('config_encryption', \App\Models\Setting::setInputValue($data,'config_encryption')) }}" class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_from" class="control-label">Email From Address</label>
                <input type="email" name="config_from" id="config_from" value="{{ old('config_from', \App\Models\Setting::setInputValue($data,'config_from')) }}" class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_from" class="control-label">Email From Name</label>
                <input type="text" name="config_from_name" id="config_from_name" value="{{ old('config_from_name', \App\Models\Setting::setInputValue($data,'config_from_name')) }}" class="form-control" />
            </div>
        </div>
    </div>


    <h3>Mail Alerts</h3>
    <hr>
    <div class="pl-lg-4 row">
        @php
            $configAlertMail = \App\Models\Setting::setInputValue($data,'config_alert_mail',[]);
            $configAlertMailArray = \App\Models\Setting::stringToArrayConversion($configAlertMail);
        @endphp
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_store_url" class="control-label">Alert Mail</label>
                @foreach(config('constant.store_alert_mail') as $key => $val)
                    <div class="form-check">
                        <input class="form-check-input" name="config_alert_mail[]" type="checkbox" value="{{ $key }}" id="{{ $key }}" {{ in_array($key,$configAlertMailArray) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $key }}">
                            {{ $val }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
