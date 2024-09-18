@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block">Payment Methods</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('payment-methods') }}">Payment Methods</a></li>
                                <li class="breadcrumb-item">List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        {{--                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
  <div class="container-fluid mt--6 mb--1">
      <div class="row">
          <div class="col">
              <div class="card">

              </div>
            </div>
          </div>
        </div>

    <!-- Page content -->
    <div class="container-fluid ">
        <div class="row">
            <div class="col">
                <div class="card">

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Logo</th>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="name">Payment Mode</th>
                                <th scope="col" class="sort" data-sort="status">Sort Order</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col" class="sort">Action</th>
                            </tr>
                            </thead>
                            <tbody class="list">

                            @forelse($records as $key => $value)
                                <tr>
                                    <td class="budget"> @if($value->payment_logo)
                                          <img src="{{asset('/uploads/paymentmethods').'/'.$value->payment_logo}}"  alt="{{$value->name}}"  class="img-thumbnail img-fluid" style=" width: 100px;height: 60px;">
                                        @else
                                          <img src="{{asset('/assets/img/default.png')}}"  alt="{{$value->name}}"  class="img-thumbnail img-fluid" style=" width: 60px;height: 60px;">
                                        @endif
                                      </td>
                                    <td class="budget">{{ $value->name }}</td>
                                    <td class="budget">{{ $value->payment_mode }}</td>
                                    <td class="budget">{{ $value->sort_order }}</td>
                                    <td class="budget"><span class="p-2  @if($value->is_active == 1) badge bg-success text-white  @else  badge bg-danger text-white @endif">{{  config('constant.status')[$value->is_active] }} </span></td>

                                    <td class="">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('payment-methods.edit',['id' => $value->id]) }}">Edit</a>
                                            </div>
                                        </div>
                                    </td>
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
                    <div class="card-footer py-4">
                        {{ $records->appends(['name' => request()->name])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        $(document).on('click','.deleteData',function(){
            let alertMessage = "Are You Sure,You want to delete it ?"
            let routeUrl = $(this).data('url')
            deleteData(alertMessage, routeUrl)
        })
    </script>
@endpush
