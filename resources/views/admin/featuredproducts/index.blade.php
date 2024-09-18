@extends('admin.layouts.app')
@prepend('styles')
<link href="{{ asset('frontend') }}/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endprepend
@section('content')

    <div class="header bg-primary pb-3">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0"> Featured Products</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('featured-product') }}"> Featured Products</a></li>
                                <li class="breadcrumb-item">List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row  ">
            <div class="col">
                <div class="card">
                  <form method="post" id="data-form" action="{{ route('featured-product.store') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('post')
                    <div class="col-md-10  mt-3 ml-8 form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                      <label class="form-control-label" for="parent_id">{{ __('Add Product To Featured ') }}</label>
                      <select class="form-control selectpicker " multiple data-live-search="true" name="product_id[]" >
                          @foreach($data as $key => $value )
                              <option value={{ $value->id }} {{ in_array($value->id,$pluckProducts) ? 'selected' : '' }}>{{ $value->adminproductDescription->name }}</option>
                          @endforeach
                      </select>
                  </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg mb-3"><i class="fa fa-plus"></i> {{ __('Add Selected Products To Featured') }}</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

    <!-- Page content -->
    <div class="container-fluid ">
        <div class="row">
            <div class="col">
                <div class="card">

                    <!-- Card header -->

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                          <thead class="thead-dark">
                          <tr>
                              <th scope="col" class="sort" data-sort="name">Image</th>
                              <th scope="col" class="sort" data-sort="name">Name</th>
                              <th scope="col" class="sort" data-sort="parent_id">Price</th>
                          </tr>
                          </thead>
                          <tbody class="list">
                          @forelse($records as $key => $value)
                              <tr>
                                <td>
                                  @if( $value->image)
                                    <img src="{{asset('/uploads/product').'/'. $value->image}}"  alt="{{$value->name}}"  class="img-thumbnail img-fluid" style=" width: 60px;height: 60px;">
                                  @else
                                    <img src="{{asset('/assets/img/default.png')}}"  alt="{{$value->adminproductDescription->name}}"  class="img-thumbnail img-fluid" style=" width: 60px;height: 60px;">
                                  @endif
                                </td>
                                  <td class="budget">{{  $value->name  }}</td>
                                  <td class="budget">${{ $value->price }}</td>
                              </tr>
                          @empty
                              <tr>
                                  <td colspan="10" class="budget">
                                      No Record Found
                                  </td>
                              </tr>
                          @endforelse
                          </tbody>


                        </table>
                    </div>
                    <!-- Card footer -->

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="{{ asset('frontend') }}/js/select2.min.js" ></script>

    <script>
     $( document ).ready(function() {
        $('selectpicker').selectpicker();
    });
    </script>
@endpush
