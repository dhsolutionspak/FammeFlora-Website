<section class="top-categories  sm-margin-slider " >
  <div class="flex-wrapper title-row ">
    <div class="cust_left">
      <div class="short-intro">
        <div class="heading-lg">{{ __('homepage')['top_brands'] }}</div>
        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p> -->
      </div>
    </div>
  </div>

  <div class="top-categories">
    <ul class="brand-js slick-arrow">
      @foreach($data['topBrands'] as $key=>$value)
        <li >
          <a href="{{ route('brands.products',['id' => $value->id]) }}" class="brandbox">
              <img src="{{asset('uploads')}}/manufacturer/{{$value->image}}" alt="" title="" style="height:100px;width:100px;" />
          </a>
        </li>
      @endforeach
    </ul>
  </div>

</section>

<style media="screen">
  .slick-slide img {
      display:inline-block;
  }
  .slick-slide {
  margin: 0 5px;
}
</style>
