@extends('frontend.layouts.app', ['class' => 'bg-white'])
@section('content')

<!--==== START MAIN ====-->
<section class="mt-3" id="shop-listing">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12">
           @forelse($records as $key=>$data)
            <div class="card my-3 order-list">
             <div class="row p-3">
                  <div class="col-md-2 col-sm-2 col-xl-2 col-lg-2 justify-content-center">
                      <img src="{{asset('/uploads')}}/blog/{{$data->image}}" alt="" class="order-product-image" style="width:60%">
                  </div>
                  <div class="col-md-5 col-sm-5 col-xl-5 col-lg-5">
                      <h3 class="product-name" style="color: #00274E;">
                        {{$data->blogDescription?->title}}
                      </h3>
                      <div class="d-flex flex-row">
                        <div class="p-1 ">{{$data->blogDescription?->short_description}}</div>
                      </div>
                  </div>
                  <div class="d-flex flex-column justify-content-center col-md-3 col-sm-3 col-xl-3 col-lg-3">
                    <span class="blog-bottom-text"><i class="fas fa-user" style="color:#536372"></i>  {{$data->author}} </span>
                    <span class="blog-bottom-text my-2 "><i class="fas fa-eye" style="color:#536372"></i>   {{$data->views}} </span>
                    <span class="blog-bottom-text "><i class="fas fa-clock" style="color:#536372"></i>   {{date('d M Y',strtotime($data->created_at))}} </span>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xl-2 col-lg-2 text-center d-inline-flex justify-content-between h-25">
                    <a href="{{ route('blog.detail',['id' => $data->id]) }}" class="blog-bottom-link-right mx-2">Read Post <i class="fas fa-arrow-right" style="color: #F24C62;"></i> </a>
                  </div>
              </div>
            </div>
            @empty
                <div class="d-flex justify-content-center my-5">
                    <i class="fa fa-heart-o " style="color:{{config('settingConfig.config_web_bg')}};  font-size:150px;"></i>
                </div>
                <h4 class="p-5 text-center text-black">{{ __('account')['wishlist_empty']}}</h4>
            @endforelse
            {{ $records->appends(['name' => request()->name])->links() }}
        </div>
      </div>
</section>
<!--==== END MAIN ====-->
@endsection
