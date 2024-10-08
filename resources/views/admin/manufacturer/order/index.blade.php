@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block">Order</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('order') }}">Order</a></li>
                                <li class="breadcrumb-item">List</li>
                            </ol>
                        </nav>
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
                <div class="card-header border-0">
                    <h3 class="mb-3">Filter</h3>
                    <form action="{{ route('order') }}">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <input type="text" name="name" id="name" value="{{ request()->name }}" class="form-control form-control-alternative" placeholder="Search..." autofocus>
                            </div>
                            <div class="col-md-3 form-group">
                                <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                                <a href="{{ route('order') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid mt--6 mb--1">
            <div class="row">
                <div class="col">
                    <div class="card">
                      <div class="card-header border-0">
                          <h3 class="mb-3">Filter Orders</h3>
                          <button type="button" onclick="window.location.href = '{{route('order').'?filterStatus=all'}}'" class="btn @if(!Request::get('filterStatus') || Request::get('filterStatus') == 'all') btn-outline-info @else btn-info @endif "><i class="fa fa-list" aria-hidden="true"></i> All</button>
                          <button type="button" onclick="window.location.href = '{{route('order').'?filterStatus=pending'}}'" class="btn @if( Request::get('filterStatus') == 'pending') btn-outline-primary @else  btn-primary @endif"><i class="fa fa-clock" aria-hidden="true"></i> Pending</button>
                          <button type="button" onclick="window.location.href = '{{route('order').'?filterStatus=processing'}}'" class="btn @if( Request::get('filterStatus') == 'processing')btn-outline-dark @else btn-dark @endif"><i class="fa fa-tasks"></i> Processing</button>
                          <button type="button" onclick="window.location.href = '{{route('order').'?filterStatus=shipped'}}'" class="btn @if( Request::get('filterStatus') == 'shipped') btn-outline-warning @else btn-warning @endif"><i  class="fa fa-truck"></i> Shipped</button>
                          <button type="button" onclick="window.location.href = '{{route('order').'?filterStatus=cancel'}}'" class="btn @if( Request::get('filterStatus') == 'cancel') btn-outline-danger @else btn-danger @endif"><i class="fa fa-exclamation-triangle"></i> Cancel</button>
                          <button type="button" onclick="window.location.href = '{{route('order').'?filterStatus=completed'}}'" class="btn @if( Request::get('filterStatus') == 'completed') btn-outline-success @else btn-success @endif"><i class="fa fa-check"></i> Completed</button>
                      </div>
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
                              <th scope="col">Order ID</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Status</th>
                              <th scope="col">Date</th>
                              <th scope="col">Total</th>
                              <th scope="col" class="sort">Action</th>
                            </tr>
                            </thead>
                            <tbody class="list">

                            @forelse($records as $key => $value)

                                <tr>
                                    <td>  #{{$value->invoice_prefix}} {{$value->invoice_no}}</td>
                                    <td class="budget">{{ $value->firstname }} {{ $value->lastname }}</td>
                                    <td class="budget">{{ $value->orderStatus ? $value->orderStatus->name : null}}</td>
                                    <td>{{date('d M Y  ',strtotime($value->order_date))}}</td>
                                    <td class="budget">${{ number_format($value->grand_total,2)  }}</td>

                                    <td class="">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('order.view',['id' => $value->id]) }}">View</a>
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
