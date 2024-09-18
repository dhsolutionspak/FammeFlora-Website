<div class="tab-pane" id="tab-mail">
    <h3>General</h3>
    <hr>
    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_mail_engine" class="control-label">Mail Engine</label>
                <input type="text" name="config_mail_engine" id="config_mail_engine" value="{{ old('config_mail_engine', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_mail_parameters" class="control-label">Mail Parameters</label>
                <input type="text" name="config_mail_parameters" id="config_mail_parameters" value="{{ old('config_mail_parameters', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_hostname" class="control-label">SMTP Hostname</label>
                <input type="text" name="config_smtp_hostname" id="config_smtp_hostname" value="{{ old('config_smtp_hostname', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_username" class="control-label">SMTP Username</label>
                <input type="text" name="config_smtp_username" id="config_smtp_username" value="{{ old('config_smtp_username', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_password" class="control-label">SMTP Password</label>
                <input type="text" name="config_smtp_password" id="config_smtp_password" value="{{ old('config_smtp_password', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_port" class="control-label">SMTP Port</label>
                <input type="text" name="config_smtp_port" id="config_smtp_port" value="{{ old('config_smtp_port', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_smtp_timeout" class="control-label">SMTP Timeout</label>
                <input type="text" name="config_smtp_timeout" id="config_smtp_timeout" value="{{ old('config_smtp_timeout', '') }}" class="form-control" />
            </div>
        </div>
      

    </div>

    <h3>Mail Alerts</h3>
    <hr>
    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_store_url" class="control-label">Alert Mail</label>
                @foreach(config('constant.store_alert_mail') as $key => $val)
                    <div class="form-check">
                        <input class="form-check-input" name="config_alert_mail[]" type="checkbox" value="{{ $key }}" id="{{ $key }}">
                        <label class="form-check-label" for="{{ $key }}">
                            {{ $val }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
