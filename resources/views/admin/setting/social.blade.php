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
                        <h6 class="h2 text-black d-inline-block mb-country">Social Media Setting </h6>

                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        {{--                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
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
                            <input type="hidden" name="setting_type" value="social">

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
