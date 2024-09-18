<div class="tab-pane" id="tab-option">
    <h3>Taxes</h3>
    <hr>
    <div class="pl-lg-4 row">
        <div class="col-md-4 form-group">
            <label for="config_price_with_tax" class="control-label">Display Price With Tax : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_price_with_tax" id="config_price_with_tax" value="Yes" {{ \App\Models\Setting::setInputValue($data,'config_price_with_tax') == "Yes" ? 'checked' : '' }} > Yes
                </label>
              &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_price_with_tax" id="config_price_with_tax" value="No" {{ \App\Models\Setting::setInputValue($data,'config_price_with_tax') == "No" ? 'checked' : '' }}> No
                </label>
            </div>
        </div>
    </div>

    <h3>Account</h3>
    <hr>
    <div class="pl-lg-4 row">



        <div class="col-md-4">
            <div class="form-group">
                <label for="config_max_login_attempt" class="control-label">Max Login Attempt</label>
                <input type="text" name="config_max_login_attempt" id="config_max_login_attempt" value="{{ old('config_max_login_attempt', \App\Models\Setting::setInputValue($data,'config_max_login_attempt')) }}" class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_invoice_prefix" class="control-label">Invoice Prefix</label>
                <input type="text" name="config_invoice_prefix" id="config_invoice_prefix" value="{{ old('config_invoice_prefix', \App\Models\Setting::setInputValue($data,'config_invoice_prefix')) }}" class="form-control" />
            </div>
        </div>



        <div class="col-md-4">
            <div class="form-group">
                <label for="config_checkout_terms" class="control-label">Checkout Terms</label>
                <select name="config_checkout_terms" id="config_checkout_terms" class="form-control">
                    @foreach(config('constant.checkout_terms') as $key => $val)
                        <option value="{{ $key }}" {{ \App\Models\Setting::setInputValue($data,'config_checkout_terms') == $key ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="pl-lg-4 row">


        <div class="col-md-4">
            <div class="form-group">
                <label for="config_order_status" class="control-label">Order Status</label>
                <select name="config_order_status" id="config_order_status" class="form-control">
                    @foreach(config('constant.order_status') as $key => $val)
                        <option value="{{ $key }}" {{ \App\Models\Setting::setInputValue($data,'config_order_status') == $key ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_fraud_order_status" class="control-label">Fraud Order Status</label>
                <select name="config_fraud_order_status" id="config_fraud_order_status" class="form-control">
                    @foreach(config('constant.order_status') as $key => $val)
                        <option value="{{ $key }}" {{ \App\Models\Setting::setInputValue($data,'config_fraud_order_status') == $key ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


</div>
