@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">Geo Zone</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('geozone') }}">Geo Zone</a></li>
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ route('geozone.add') }}" class="btn btn-lg btn-neutral fade-class"><i class="fas fa-plus fa-lg"></i> New</a>
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
                            <h3 class="mb-0">{{ __('Edit') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('geozone.update',['id' => $data->id]) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Edit Geo Zone ') }}</h6>

                            <div class="pl-lg-4 row">
                                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $data->name) }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" rows="4" cols="80" class="form-control">{{$data->description}}</textarea>
                                </div>
                            </div>



                            <div class="pl-lg-4 row">

                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush" id="tbl">
                                        <thead class="thead-dark">
                                        <tr>
                                          <th scope="col" class="sort" data-sort="name">Country</th>
                                          <th scope="col" class="sort" data-sort="state">State</th>
                                          <th scope="col" class="" data-sort=""></th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        @forelse($geoZones as $key => $value)
                                            <tr class="tr_clone">
                                                <td class="budget">
                                                  <select class="form-control" name="country_id[]" id="country_id{{$key}}">
                                                    @foreach($countries as $country)
                                                      <option value="{{$country->id}}" @if($country->id == $value->country_id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                  </select>
                                                </td>
                                                <td class="budget">
                                                  <select class="form-control" name="state_id[]" id="state_id{{$key}}">
                                                      <option value="0">All States</option>
                                                  </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" id="DeleteButton" ><icon class="fa fa-minus" /></button>
                                                </td>
                                            </tr>
                                        @empty
                                          <tr class="tr_clone">
                                              <td class="budget">
                                                <select class="form-control" name="country_id[]" id="country_id0">
                                                  @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                  @endforeach
                                                </select>
                                              </td>
                                              <td class="budget">
                                                <select class="form-control" name="state_id[]" id="state_id0">
                                                  <option value="0">All States</option>
                                                </select>
                                              </td>
                                              <td>
                                                  <button class="btn btn-danger" id="DeleteButton" ><icon class="fa fa-minus" /></button>
                                              </td>
                                          </tr>
                                        @endforelse

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
                                    <a href="{{ route('geozone') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
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
        var counter = '{{count($geoZones)}}';

        let countryHtml = `<tr class="tr_clone">
        <td class="budget">
          <select class="form-control" name="country_id[]" id=country_id${counter} onchange="fetchStates(this.value,${counter})">`
          countryHtml += `<option value="">Select Country</option>`
          <?php foreach ($countries as $key => $country) { ?>
          countryHtml += `<option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>`
          <?php  } ?>
          countryHtml +=   `</select>
          </td>
          <td class="budget">
            <select class="form-control" name="state_id[]" id=state_id${counter}>`
            countryHtml += `<option value="0">All States</option>`
            countryHtml +=   `</select>
            </td>
          <td>
              <button class="btn btn-danger" id="DeleteButton" ><icon class="fa fa-minus" /></button>
          </td>
      </tr>`

        $(document).on('click', '#addRowButton', function() {
            $('#tbl').append(countryHtml);
            counter += 1;
        });

        $("#tbl").on("click", "#DeleteButton", function() {
            $(this).closest("tr").remove();
            counter -= 1;
        });

      <?php foreach($geoZones as $key => $value) { ?>
           fetchStates('{{$value->country_id}}','{{$key}}','{{$value->state_id}}')
      <?php } ?>

        function fetchStates(val,id,state_id = 0) {

          if(val > 0) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('fetch-states')}}",
                type: 'post',
                dataType: 'JSON',
                data:{'country_id' : val,'_token': CSRF_TOKEN},
                success: function (response) {
                  if(response.data.length > 0) {
                      $('#state_id'+id).empty();

                      let selectOptionHtml = '<option value="0">All States</option>';

                      $.each(response.data, function(key, value) {
                        if(state_id != 0) {
                          selectOptionHtml += `<option value="${value.state_id}"`;
                            if(value.state_id == state_id) {
                               selectOptionHtml +=`selected="true"`;
                            }
                              selectOptionHtml +=`>${value.name}</option>`
                            }
                            else {
                              selectOptionHtml += `<option value="${value.state_id}">${value.name}</option>`
                            }
                        });
                        $('#state_id'+id).append(selectOptionHtml);

                    }
                }
            })
          }
          else {
            alert('Please Select Country')
          }
        }

    </script>
@endpush
