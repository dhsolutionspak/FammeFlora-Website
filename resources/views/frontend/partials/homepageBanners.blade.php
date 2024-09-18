<div class="homepage-banners banner-margin" >
  <div class="row">
    @foreach($data as $banner)
      <div class="@if($column == 2) col-md-6 col-xl-6 col-lg-6 @elseif($column == 3) col-md-4 col-lg-4 col-xl-4 @endif mb-3 mt-2">
        <div class="   d-flex justify-content-center">
            <a  href="{{$banner->link}}">
              <!-- <img src="{{asset('uploads')}}/banner/{{$banner->image}}" alt="" @if($column == 2) style="width:100%"   @else style="height: 210px; width:100%;" @endif/> -->
              <img class="img-fluid lazy"  data-original="{{asset('uploads')}}/banner/{{$banner->image}}" alt="" />
            </a>
        </div>
      </div>
    @endforeach
  </div>
</div>
