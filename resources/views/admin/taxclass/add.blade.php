@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">Tax Class</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('tax-class') }}">Tax Class</a></li>
                                <li class="breadcrumb-item">Add</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('tax-class.add') }}" class="btn btn-lg btn-neutral fade-class"><i class="fas fa-plus fa-lg"></i> New</a>
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
                        <form method="post" action="{{ route('tax-class.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Add Tax Class ') }}</h6>

                            <div class="pl-lg-4 row">
                                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', '') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" rows="4" cols="80" class="form-control"></textarea>
                                </div>

                            </div>

                            <div class="pl-lg-4 row">

                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush" id="tbl">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">Tax Rate</th>
                                            <th scope="col" class="" data-sort=""></th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        <tr class="tr_clone">
                                            <td class="budget">
                                              <select class="form-control" name="tax_rate_id[]" id="tax_rate_id0">
                                                <option value="">Select Tax Rate</option>
                                                @foreach($taxRates as $taxRate)
                                                  <option value="{{$taxRate->id}}">{{$taxRate->name}}</option>
                                                @endforeach
                                              </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" id="DeleteButton" ><icon class="fa fa-minus" /></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td style="text-align:right" colspan="5">
                                                <button type="button" class="btn btn-primary " id="addRowButton" ><icon class="fa fa-plus" /></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('tax-class') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
        var counter = 1;
        $(document).on('click', '#addRowButton', function() {

              let countryHtml = `<tr class="tr_clone">
              <td class="budget">
                <select class="form-control" name="tax_rate_id[]" id=tax_rate_id${counter} >`
                countryHtml += `<option value="">Select Tax Rate</option>`
                <?php foreach ($taxRates as $key => $taxRate) { ?>
                  countryHtml += `<option value="<?php echo $taxRate->id ?>"><?php echo $taxRate->name ?></option>`
                <?php  } ?>
                countryHtml +=   `</select>
                </td>
                
                <td>
                    <button class="btn btn-danger" id="DeleteButton" ><icon class="fa fa-minus" /></button>
                </td>
            </tr>`
            $('#tbl').append(
              countryHtml
            );
            counter += 1;
        });

        $("#tbl").on("click", "#DeleteButton", function() {
            $(this).closest("tr").remove();
            counter -= 1;
        });

    </script>
@endpush
