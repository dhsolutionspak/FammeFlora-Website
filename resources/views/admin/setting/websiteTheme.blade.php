@extends('admin.layouts.app')

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
                        <h6 class="h2 text-black d-inline-block mb-country">Theme Setting </h6>

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
                        <form  method="post" action="{{ route('setting.update',['id' => 7 ]) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                @foreach($themes as $key=>$theme )
                                  @if(isset($theme['themename']))
                                    <a href="#0"  onclick="setSelectedTheme(this,'{{$theme['themename']}}')" class="col-3 p-3 themeBox" @if($theme['isCurrentTheme'] == 1) style="border:1px solid #00274E;border-radius:5px" @endif>
                                      <div class="d-flex justify-content-center align-items-center" style="height:200px;background:{{$theme['themeColorCode']}};border-radius:5px">
                                        <h3 class="text-center p-2 text-white ">{{$theme['themename']}}</h3>
                                      </div>
                                        <div class="form-group my-2">
                                        <label for="config_meta_title" class="control-label text-dark">Website Background Color</label>
                                        <input type="text" name="website_bg[{{$theme['themename']}}][]" value="{{$theme['website_bg']}}" placeholder="Product Box Background Color" class="form-control ">
                                        </div>                                                                
                                        <div class="form-group my-2">
                                        <label for="config_meta_title" class="control-label text-dark">Product Card Background Color</label>
                                        <input type="text" name="productbg[{{$theme['themename']}}][]" value="{{$theme['product_bg']}}" placeholder="Website Background Color" class="form-control ">
                                        </div>
                                    </a>
                                    @endif
                                @endforeach
                             </div>
                             <input type="hidden" id="selectedTheme" name="selectedTheme" value="{{$selectedTheme['themename']}}">
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
<script type="text/javascript">
    function setSelectedTheme(that,theme) {
      $('.themeBox').removeAttr('style');
      $(that).css({
        "border":"1px solid #00274E","border-radius":"5px"
      });
      $('#selectedTheme').val(theme)
    }
</script>
@endpush
