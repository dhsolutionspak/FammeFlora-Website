@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-country">Options</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product-option') }}">Options</a></li>
                                <li class="breadcrumb-item">Add</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('product-option.add') }}" class="btn btn-sm btn-neutral">New</a>
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
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('product-option.store') }}"  autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Add Options ') }}</h6>

                            <div class="pl-lg-4 row">
                                <div class="col-md-4 form-group{{ $errors->has('multilanguage.*.name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>

                                    @foreach(getLanguages() as $key=>$language)
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">{{$language->language_name}} </span>
                                        </div>
                                        <input type="text" name="multilanguage[{{$language->id}}][name]" class="form-control form-control-alternative{{ $errors->has('multilanguage.*.name') ? ' is-invalid' : '' }}" placeholder="{{_('Name')}}" aria-label="Name" aria-describedby="basic-addon1">
                                        @if ($errors->has('multilanguage.*.name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('multilanguage.*.name') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    @endforeach


                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="status">{{ __('Type') }}</label>
                                    <select class="form-control type" name="type">
                                        @foreach(config('constant.product_option') as $key => $value )
                                            <optgroup label={{ $key }}>
                                                @foreach(config('constant.product_option')[$key] as $key => $value )
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="status">{{ __('Status') }}</label>
                                    <select class="form-control" name="status">
                                        @foreach(config('constant.status') as $key => $value )
                                            <option value={{ $key }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="pl-lg-4 row">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('product-option') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
    <script>
        var typeForOptionValue = ['Select','Radio','Checkbox']
        var counter = 1;

        $(document).on('change','.type',function(){

            if(typeForOptionValue.includes($(this).val())) {
                $('.row_value_tbl').show()
                $(".row_value_tbl input").prop('required',true);
            } else {
                $('.row_value_tbl').hide()
                $(".row_value_tbl input").prop('required',false);
            }
        })


        $(document).on('click', '#addRowButton', function() {
            $('#tbl').append(`<tr class="tr_clone">
            <td><input type="text" name="option_value[name][]" id=name${counter} class="form-control form-control-alternative" required></td>
            <td><input type="file" name="option_value[image][]" id=image${counter} class="form-control form-control-alternative" required></td>
            <td class="budget"> <input type="number" min="1" name="option_value[sort_order][]" id=sort_order${counter} class="form-control form-control-alternative" required></td>
            <td>
                <button class="btn btn-danger" id="DeleteButton" ><icon class="fa fa-minus" /></button>
            </td>
        </tr>`);

            counter += 1;
        });

        $("#tbl").on("click", "#DeleteButton", function() {
            $(this).closest("tr").remove();
            counter -= 1;
        });
    </script>
@endpush
