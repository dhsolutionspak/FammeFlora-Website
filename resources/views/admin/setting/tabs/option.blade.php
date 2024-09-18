<div class="tab-pane" id="tab-option">
    <h3>Taxes</h3>
    <hr>
    <div class="pl-lg-4 row">
        <div class="col-md-4 form-group">
            <label for="config_price_with_tax" class="control-label">Display Price With Tax : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_price_with_tax" id="config_price_with_tax" value="Yes"> Yes
                </label>
              &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_price_with_tax" id="config_price_with_tax" value="No" checked> No
                </label>
            </div>
        </div>
    </div>

    <h3>Account</h3>
    <hr>
    <div class="pl-lg-4 row">

        <div class="col-md-4 form-group">
            <label for="config_log_customer_online" class="control-label">Log Customer Online : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_log_customer_online" id="config_log_customer_online" value="Yes"> Yes
                </label>
                &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_log_customer_online" id="config_log_customer_online" value="No" checked> No
                </label>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <label for="config_log_customer_searches" class="control-label">Log Customer Searches : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_log_customer_searches" id="config_log_customer_searches" value="Yes"> Yes
                </label>
                &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_log_customer_searches" id="config_log_customer_searches" value="No" checked> No
                </label>
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label for="config_ssl_url" class="control-label">Customer Group</label>
                <select name="config_customer_group" class="form-control" id="config_customer_group">
                    <option value="default">Default</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_max_login_attempt" class="control-label">Max Login Attempt</label>
                <input type="text" name="config_max_login_attempt" id="config_max_login_attempt" value="{{ old('config_max_login_attempt', '') }}" class="form-control" />
            </div>
        </div>
    </div>

    <h3>Account</h3>
    <hr>
    <div class="pl-lg-4 row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="config_invoice_prefix" class="control-label">Invoice Prefix</label>
                <input type="text" name="config_invoice_prefix" id="config_invoice_prefix" value="{{ old('config_invoice_prefix', '') }}" class="form-control" />
            </div>
        </div>

        <div class="col-md-4 form-group">
            <label for="config_weight_on_cart_page" class="control-label">Display Weight Cart On Page : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_weight_on_cart_page" id="config_weight_on_cart_page" value="Yes"> Yes
                </label>
                &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_weight_on_cart_page" id="config_weight_on_cart_page" value="No" checked> No
                </label>
            </div>
    </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_checkout_terms" class="control-label">Checkout Terms</label>
                <select name="config_checkout_terms" id="config_checkout_terms" class="form-control">
                    @foreach(config('constant.checkout_terms') as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_order_status" class="control-label">Order Status</label>
                <select name="config_order_status" id="config_order_status" class="form-control">
                    @foreach(config('constant.order_status') as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="config_fraud_order_status" class="control-label">Fraud Order Status</label>
                <select name="config_fraud_order_status" id="config_fraud_order_status" class="form-control">
                    @foreach(config('constant.order_status') as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <h3>Stock</h3>
    <hr>
    <div class="pl-lg-4 row">
        <div class="col-md-4 form-group">
            <label for="config_stock_display" class="control-label">Display Stock : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_stock_display" id="config_stock_display" value="Yes"> Yes
                </label>
                &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_stock_display" id="config_stock_display" value="No" checked> No
                </label>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <label for="config_show_out_of_stock_warning" class="control-label">Show Out Of Stock Warning : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_show_out_of_stock_warning" id="config_show_out_of_stock_warning" value="Yes"> Yes
                </label>
                &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_show_out_of_stock_warning" id="config_show_out_of_stock_warning" value="No" checked> No
                </label>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <label for="config_checkout_stock" class="control-label">Stock Checkout : </label>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_checkout_stock" id="config_checkout_stock" value="Yes"> Yes
                </label>
                &nbsp; &nbsp;
                <label class="radio-inline">
                    <input class="form-check-input" type="radio" name="config_checkout_stock" id="config_checkout_stock" value="No" checked> No
                </label>
            </div>
        </div>
    </div>
</div>
