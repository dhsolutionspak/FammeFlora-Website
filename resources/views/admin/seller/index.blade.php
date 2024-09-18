@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block">User</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user') }}">Seller</a></li>
                                <li class="breadcrumb-item">List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-3">Filter</h3>
                        <form action="{{ route('user') }}">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    {{--                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>--}}
                                    <input type="text" name="name" id="name" value="{{ request()->first_name }}" class="form-control form-control-alternative" placeholder="Search..." autofocus>
                                </div>
                                <div class="col-md-3 form-group">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                                    <a href="{{ route('user') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <form method="POST" id="my_form" action="{{ route('seller') }}">
                            @csrf
                            <table class="table align-items-center table-flush">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">No</th>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">Email</th>
                                    <th scope="col" class="sort" data-sort="name">Phone</th>
                                    <th scope="col" class="sort" data-sort="name">Store Name</th>
                                    <th scope="col" class="sort" data-sort="name">Store Phone</th>
                                    <th scope="col" class="sort" data-sort="name">Store Address</th>
                                    <th scope="col" class="sort" data-sort="name">Store Country</th>
                                    <th scope="col" class="sort" data-sort="name">Store State</th>
                                    <th scope="col" class="sort" data-sort="name">Store City</th>
                                    <th scope="col" class="sort" data-sort="name">Store Zipcode</th>
                                    <th scope="col" class="sort" data-sort="name">Store Meta Keywords</th>
                                    <th scope="col" class="sort" data-sort="name">Store Meta Description</th>
                                    <th scope="col" class="sort" data-sort="name">Store SEO</th>
                                    <th scope="col" class="sort" data-sort="name">Facebook Link</th>
                                    <th scope="col" class="sort" data-sort="name">Google Link</th>
                                    <th scope="col" class="sort" data-sort="name">Twiiter Link</th>
                                    <th scope="col" class="sort" data-sort="name">Instagram Link</th>
                                    <th scope="col" class="sort" data-sort="name">Is Approved</th>
                                    {{-- <th scope="col" class="sort" data-sort="status">Status</th> --}}
                                    <th scope="col" class="sort">Action</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $i = 0; ?>
                                @forelse($records as $key => $value) 
                                    <?php $i++ ?>
                                    <tr>
                                        <td class="budget">{{ $i }}</td>
                                        <td class="budget">{{ $value->firstname. ' '. $value->lastname }}</td>
                                        <td class="budget">{{ $value->email }}</td>
                                        <td class="budget">{{ $value->telephone }}</td>
                                        <td class="budget">{{ $value->store_name }}</td>
                                        <td class="budget">{{ $value->store_phone }}</td>
                                        <td class="budget">{{ $value->store_address }}</td>
                                        <td class="budget">{{ $value->store_country }}</td>
                                        <td class="budget">{{ $value->store_state }}</td>
                                        <td class="budget">{{ $value->store_city }}</td>
                                        <td class="budget">{{ $value->store_zipcode }}</td>
                                        <td class="budget">{{ $value->store_meta_keywords }}</td>
                                        <td class="budget">{{ $value->store_meta_description }}</td>
                                        <td class="budget">{{ $value->store_seo }}</td>
                                        <td class="budget">{{ $value->facebook_link }}</td>
                                        <td class="budget">{{ $value->google_link   }}</td>
                                        <td class="budget">{{ $value->twitter_link }}</td>
                                        <td class="budget">{{ $value->instagram_link }}</td>
                                        <td class="budget">
                                            @if($value->is_approve == 1)
                                                <span class="badge badge-success">Approved</span>   
                                            @elseif($value->is_approve == 0)
                                                <input type="hidden" name="seller_id" value={{ $value->id }}>
                                                <button type="submit" name="approve" value="approve"  class="btn btn-success btn-sm">Approve</button>
                                                <button type="submit" name="reject" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                            @elseif($value->is_approve == 2)
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif   
                                        </td>

                                        {{-- <td class="budget"><span class="p-2  @if($value->status == 1) badge bg-success text-white  @else  badge bg-danger text-white @endif">{{  config('constant.status')[$value->status] }} </span></td> --}}

                                        <td class="">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('user.edit',['id' => $value->id]) }}">Edit</a>
                                                    <a class="dropdown-item deleteData" type="button"  href="javascript:void(0)" data-url="{{ route('user.delete',['id' => $value->id]) }}">Delete</a>
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
                        </form>    
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
