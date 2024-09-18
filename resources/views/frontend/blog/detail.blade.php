@extends('frontend.layouts.app', ['class' => 'bg-white'])
@section('content')

<!--==== START BREADCUMB ====-->
<section class="page-crumb">
    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
        <li class="current">Blog Detail</li>
    </ul>
</section>
<!--==== END BREADCUMB ====-->

<!--==== START CONTENT ====-->
<section class="mt-3" >
  <div class="row">
      <div class="col-md-12 col-xl-8 col-lg-8">
        <div class="blog-image">
          <img src="{{asset('uploads')}}/blog/{{$data['blog']->image}}" alt="" >
        </div>
        <div class="my-3 d-flex justify-content-start align-items-center">
            <span class="blog-bottom-text"><i class="fas fa-user" style="color:#536372"></i>  {{$data['blog']->author}} </span>
            <span class="blog-bottom-text mx-5"><i class="fas fa-clock" style="color:#536372"></i>   {{date('d M Y',strtotime($data['blog']->created_at))}} </span>
        </div>
        <hr>
        <div class="my-3">
          {!! $data['blog']->blogDescription?->description !!}
        </div>
      </div>
      <div class="col-md-12 col-xl-4 col-lg-4">
          <div class="recent-blog-right-box">
            <div class="mt-0 mx-3  heading-xs heading-line">
              Recent Blog Post
            </div>
            @forelse($data['recentBlog'] as $key=>$blog)
              @if($key > 0 )
                  <div class="row  mx-2 ">
                    <div class="col-md-3 col-lg-3 col-xl-3 d-flex align-items-center">
                        <img src="{{asset('uploads')}}/blog/{{$blog->image}}" alt="" width="100%">
                    </div>
                    <div class="col-md-9 col-lg-9 col-xl-9">
                      <div class="mx-3 my-3">
                        <a href="{{ route('blog.detail',['id' => $blog->id]) }}" class="recent-blog-heading">{{$blog->blogDescription?->title}}</a>
                        <p class="recent-blog-shortdesc">{{ \Illuminate\Support\Str::limit($blog->short_description, 40, $end='...') }}</p>
                      </div>
                    </div>
                  </div>
              @endif
            @empty
              <p class="text-center ">No Blog Found!</p>
            @endforelse
        </div>

        <div class="author-box my-5">
          <div class="text-center">
              <img src=" {{asset('frontend')}}/images/profile.png " alt="profile_picture">
              <div class="heading-xs  mt-3 mb-2">
                  {{$data['blog']->author}}
              </div>
              <!-- <div>Founder & CEO of OtrixWeb</div>
              <div class="my-3">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</div> -->
              <div class="d-flex justify-content-center mt-5 mb-2 social-col">
  							<ul class="social-link-otrix flex-wrapper">
  								@if(!empty(config('settingConfig.config_fb_url')))
  			            <li><a href="{{config('settingConfig.config_fb_url')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
  			          @endif
  			          @if(!empty(config('settingConfig.config_linkedin_url')))
  			            <li><a href="{{config('settingConfig.config_linkedin_url')}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
  			          @endif
  			          @if(!empty(config('settingConfig.config_twitter_url')))
  			            <li><a href="{{config('settingConfig.config_twitter_url')}}" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
  			          @endif
  			          @if(!empty(config('settingConfig.config_insta_url')))
  			            <li><a href="{{config('settingConfig.config_insta_url')}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
  			          @endif
  			          @if(!empty(config('settingConfig.config_youtube_url')))
  			            <li><a href="{{config('settingConfig.config_youtube_url')}}" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a> </li>
  			          @endif
  							</ul>
  						</div>
          </div>
        </div>
        @php
          $title = $data['blog']->title;
          $short_url =url()->current();
          $url = url()->current();

          $twitter_params =
         '?text=' . urlencode($title) . '+-' .
         '&amp;url=' . urlencode($short_url) .
         '&amp;counturl=' . urlencode($url) .
         '';

          $link = "http://twitter.com/share" . $twitter_params . "";

          $text = $title.' '.$data['blog']->short_description;
          $produtURL =url()->current();
          $wurl = "https://api.whatsapp.com/send?text=".urlencode($text.' URL:'.$produtURL);
          @endphp
        <div class="share-box mb-5">
          <div class="text-left">
              <div class="heading-xs heading-line mt-3 mb-2">
                  Share This Post
              </div>
              <div class="mb-3 ctnect-link d-flex justify-content-center " style="position:inherit;margin-top:20px;">
                  <ul class="social-link">
                      <li><a href="https://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
                      <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}"  target="_blank" class="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i> </a> </li>
                      <li><a href="{{$link}}" class="twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> </a> </li>
                      <li><a href="{{$wurl}}" data-action="share/whatsapp/share" target="_blank" class="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
                  </ul>
              </div>
            </div>
        </div>

      </div>
  </div>
</section>
<!--==== END CONTENT ====-->


@endsection
