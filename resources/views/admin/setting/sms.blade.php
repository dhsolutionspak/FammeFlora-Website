@extends('admin.layouts.app')
@push('styles')
    <style>
        input.error {
            border-color: #f00 !important;
        }

        small.required {
            color:#f00;
        }
    </style>
@endpush
@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="alert alert-success alert-dismissible fade hide global-alert-message submit_success_alert" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-country">SMS Setting </h6>

                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">

                    </div>
                    <div class="card-body">
                        <form  method="post" action="{{ route('setting.update',['id' => 1 ]) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <h4>Twilio SMS Configuration</h4>

                            <div class="pl-lg-4 row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="config_twilio_sid" class="control-label">Twilio SID</label>
                                        <input type="text" name="config_twilio_sid" id="config_sid" value="{{ old('config_twilio_sid', \App\Models\Setting::setInputValue($data,'config_twilio_sid')) }}" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="config_twilio_sid" class="control-label">Twilio Token</label>
                                        <input type="text" name="config_twilio_token" id="config_twilio_token" value="{{ old('config_twilio_token', \App\Models\Setting::setInputValue($data,'config_twilio_token')) }}" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="config_twilio_from" class="control-label">Twilio From</label>
                                        <input type="text" name="config_twilio_from" id="config_twilio_from" value="{{ old('config_twilio_from', \App\Models\Setting::setInputValue($data,'config_twilio_from')) }}" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="config_registerSMSContent" class="control-label">Register SMS Content</label>
                                        <textarea name="config_registerSMSContent" rows="8" cols="80" class="form-control" value="{{old('config_registerSMSContent', \App\Models\Setting::setInputValue($data,'config_registerSMSContent'))}}">{!! \App\Models\Setting::setInputValue($data,'config_registerSMSContent') !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <h3>SMS Alerts</h3>
                            <hr>
                            <div class="pl-lg-4 row">
                                @php
                                    $configAlertMail = \App\Models\Setting::setInputValue($data,'config_alert_sms',[]);
                                    $configAlertMailArray = \App\Models\Setting::stringToArrayConversion($configAlertMail);
                                @endphp
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="config_store_url" class="control-label">Alert SMS</label>
                                        @foreach(config('constant.store_alert_mail') as $key => $val)
                                            <div class="form-check">
                                                <input class="form-check-input" name="config_alert_sms[]" type="checkbox" value="{{ $key }}" id="{{ $key }}" {{ in_array($key,$configAlertMailArray) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $key }}">
                                                    {{ $val }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="setting_type" value="sms">
                            <div class="pl-lg-4 row">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
    <script>
            var storeObj = {
                config_store_name : 'required'
            }


            $("#submit-form").submit(function(event) {
                event.preventDefault();
                validateFormData($(this));
                // $(this).append('productData',productData)
                let url = $(this).attr('action')
                let method = $(this).attr('method')

                var formData = new FormData(document.getElementById('submit-form'));

                $.ajax({
                    url: url,
                    processData: false,
                    contentType: false,
                    type: method,
                    data: formData,
                    success: function (response) {
                        if(response.code == 200 ) {

                            $('.submit_success_alert').removeClass('hide').addClass('show')
                            $('.submit_success_alert button').before(response.msg)

                            setTimeout(function (){
                                window.location.href = response.route
                            },3000)
                        }
                        else {
                            alert('Something went wrong!.Please try again')
                        }
                    }
                })
            })

        function validateFormData (form) {

            form.validate({
                ignore: [],
                errorPlacement: function() {},
                submitHandler: function() {
                },
                invalidHandler: function() {
                    setTimeout(function() {
                        $('.nav-tabs a small.required').remove();
                        var validatePane = $('.tab-content.tab-validate .tab-pane:has(input.error)').each(function() {
                            var id = $(this).attr('id');
                            $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="required">***</small>');
                        });

                        //  $('.tab-content.tab-validate .tab-pane:has(select.error)').each(function() {
                        //     var id = $(this).attr('id');
                        //     $('.nav-tabs').find('a[href^="#' + id + '"]').append(' <small class="required">***</small>');
                        // });
                    });
                },
                rules: {
                    customer_id: 'required',
                    firstname: 'required',
                    lastname: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    telephone: 'required',
                    ...storeObj,
                }
            });

        };

    </script>
@endpush
