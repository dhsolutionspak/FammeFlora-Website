@extends('frontend.layouts.app', ['class' => 'bg-white'])

@section('content')
<!--==== START BREADCUMB ====-->
<section class="page-crumb">
  <div class="otrixcontainer">
    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}">{{ __('homepage')['title']}}</a></li>
      <li class="current">{{ __('categories')['bradcum'] }}</li>
    </ul>
  </div>
</section>
<!--==== END BREADCUMB ====-->

<section class="top-categories ">
  <div class="otrixcontainer">
    <div class="top-categories">

      <div class="row">
        <div class="col-md-2 col-lg-2 col-sm-12 col-xl-2 ">
          @if(isset($leftSideBanner) && isset($leftSideBanner->images[0]))
            @include('frontend.partials.sideBanner',['image' => $leftSideBanner->images[0]->image,'link' => $leftSideBanner->images[0]->link])
          @endif
        </div>
        <div class="col-md-8  col-lg-8 col-sm-12 col-xl-8">
          <div class="row">
            @foreach($data as $key=>$value)
              <div class="col-md-3 col-lg-3 col-sm-12 col-xl-3 mb-3 mb-5">
                  <a href="{{ route('category.products',['id' => $value['category_id'] ]) }}" class="catebox">
                    <div class="cate-info">
                      <div class="heading-xs">{{$value['category_description']['name']}}</div>
                    </div>
                    <div class="cate-img gray-circle">
                      <img class="lazy" data-original="{{asset('uploads')}}/category/{{$value['image']}}" alt="" title="" />
                    </div>
                  </a>
               </div>
            @endforeach
          </div>
        </div>
        <div class="col-md-2  col-lg-2  col-sm-12 col-xl-2 ">
          @if(isset($rightSideBanner) && isset($rightSideBanner->images[0]))
            @include('frontend.partials.sideBanner',['image' => $rightSideBanner->images[0]->image,'link' => $rightSideBanner->images[0]->link])
          @endif
        </div>

       </div>
    </div>
  </div>
</section>


@endsection
