@extends('admin.layouts.app')

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block">Blogs</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blogs</a></li>
                                <li class="breadcrumb-item">List</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                      <a href="{{ route('blog.add') }}" class="btn btn-lg btn-neutral fade-class"><i class="fas fa-plus fa-lg"></i> New</a>

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
                    <!-- Card header -->

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
                                <th scope="col" width="10%">Image</th>
                                <th scope="col" width="20%">Title</th>
                                  <th scope="col" class="sort"  width="10%">Action</th>
                              </tr>
                            </thead>
                            <tbody class="list">
                              @forelse($data as $record)
                                <tr>
                                    <td >
                                      @if($record->image)
                                      <img class="avatar user-thumb rounded-circle" src="{{asset('uploads/blog').'/'.$record->image}}" alt="avatar" style="height:60px;width:60px">
                                      @else
                                      <img class="avatar user-thumb rounded-circle" src="{{asset('assets/images/media/image_not_found.png')}}" alt="avatar" style="height:60px;width:60px">
                                      @endif
                                    </td>
                                    <td>{{$record->adminblogDescription?->title}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item " type="button"  href="{{ route('blog.edit',['id' => $record->id]) }}" >Edit</a>
                                                <a class="dropdown-item deleteData" type="button"  href="javascript:void(0)" data-url="{{ route('blog.delete',['id' => $record->id]) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="budget">
                                            No Record Found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        {{ $data->appends([])->links() }}
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
