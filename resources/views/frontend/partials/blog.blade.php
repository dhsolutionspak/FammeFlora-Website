<section class="new-product mt-3 mb-5 ">
    <div class="flex-wrapper title-row title-space my-1">
      <div class="cust_left">
        <div class="short-intro">
          <div class="heading-lg">{{ __('homepage')['blog'] }}</div>
        </div>
      </div>
      <div class="cust_right">
        <a href="{{ route('blog.all') }}" class=" view_all">{{ __('homepage')['view_all_blog'] }} <i class="fas fa-chevron-right mx-2"></i></a>
      </div>
    </div>

    <div class="row ">
      <div class="col-md-12 col-lg-6 col-sm-12 p-2  ">
        <div class="blog-box">
          <div class="blog-img">
            <img class="lazy" data-original="{{asset('uploads')}}/blog/{{$data['blogs'][0]->image}}" alt="">
          </div>
          <div class="mx-3 my-3">
            <p class="blog-heading">
              <a href="{{ route('blog.detail',['id' => $data['blogs'][0]->id]) }}">
                {{$data['blogs'][0]?->blogDescription?->title}}
              </a>
              </p>
            <span class="blog-shortdesc">{{$data['blogs'][0]?->blogDescription?->short_description}}</span>
          </div>
          <div class="row blog-bottom-box ">
            <div class="d-flex justify-content-center  py-3 col-md-4 col-xl-4 col-lg-4">
                <span class="blog-bottom-text"> <i class="fas fa-user" style="color:#536372"></i>  Otrixadmin</span>
            </div>
            <div class="d-flex justify-content-center  py-3 col-md-4 col-xl-4 col-lg-4">
                <span class="blog-bottom-text"> <i class="fas fa-clock" style="color:#536372"></i> {{date('d M Y',strtotime($data['blogs'][0]->created_at))}} </span>
            </div>
            <!-- <div class="d-flex justify-content-end ">
                <a href="{{ route('blog.detail',['id' => $data['blogs'][0]->id]) }}" class="blog-bottom-link mx-2">Read Post <i class="fas fa-arrow-right" style="color: #F24C62;"></i> </a>
            </div> -->
          </div>

        </div>
      </div>
      <div class="col-md-12 col-lg-6 col-sm-12 p-2  ">
        @forelse($data['blogs'] as $key=>$blog)
          @if($key > 0 )
              <div class="row blog-right-box mx-2 mb-4">
                <div class="col-md-3 col-lg-3 col-xl-3 d-flex align-items-center">
                    <img class="lazy" data-original="{{asset('uploads')}}/blog/{{$blog->image}}" alt="" width="100%">
                </div>
                <div class="col-md-9 col-lg-9 col-xl-9">
                  <div class="mx-3 my-3">
                    <p class="blog-heading">
                      <a href="{{ route('blog.detail',['id' => $blog->id]) }}">
                        {{$blog->blogDescription?->title}}
                      </a>

                    </p>
                    <span class="blog-shortdesc"> {{Str::words($blog->blogDescription?->short_description, '18') }}</span>
                  </div>
                  <div class="row  mb-3">
                    <div class="d-flex justify-content-center px-2  col-md-6 col-xl-6 col-lg-6">
                        <span class="blog-bottom-text"> <i class="fas fa-user" style="color:#536372"></i>  Otrixadmin</span>
                    </div>
                    <div class="d-flex justify-content-center px-2 col-md-6 col-xl-6 col-lg-6">
                        <span class="blog-bottom-text"> <i class="fas fa-clock" style="color:#536372"></i> {{date('d M Y',strtotime($blog->created_at))}} </span>
                    </div>
                  </div>

                </div>
              </div>
          @endif
        @empty
          <p class="text-center ">No Blog Found!</p>
        @endforelse
      </div>
    </div>

</section>
