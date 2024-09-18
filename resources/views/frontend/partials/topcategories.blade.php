<section class="top-categories my-3 sm-margin-slider">
  <div class="flex-wrapper title-row ">
    <div class="cust_left">
      <div class="short-intro">
        <div class="heading-lg">{{ __('homepage')['label_category'] }}</div>
        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p> -->
      </div>
    </div>
    <div class="cust_right">
      <a href="{{route('category.all')}}" class="view_all">{{ __('homepage')['view_all_cat'] }} <i class="fas fa-chevron-right mx-2"></i> </a>
    </div>
  </div>

  <div class="top-categories ">
    <ul class="categories-js slick-arrow">
      @foreach($data['topCategory'] as $key=>$value)
        <li>
          <a href="{{ route('category.products',['id' => $value['category_id']]) }}" class="catebox">
            <div class="cate-img gray-circle">
              <img src="{{asset('uploads')}}/category/{{$value['image']}}" alt="" title="" />
            </div>
          </a>
          <div class="cate-info cate-info d-flex justify-content-center">
            <div class="heading-xs">{{isset($value['category_description']['name']) ?$value['category_description']['name'] : ''}}</div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>

</section>
