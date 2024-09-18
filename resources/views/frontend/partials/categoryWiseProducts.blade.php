<section class="most-popular-cat-tab">
      <div class="heading-lg ">{{ __('homepage')['most_popular_cat'] }}</div>
      <!-- Nav tabs -->
      <div class="my-3">
          <ul class="nav nav-tabs " role="tablist">
            @foreach($data['topCategory'] as $key=>$value)

              <li class="nav-item " @if(app()->getLocale() == 'en') style="margin-right:10px;" @else style="margin-left:10px;" @endif>
                <a onclick="activeTabGetData(this,'{{$value['category_id']}}')" class="nav-link @if($key == 0) active @endif" data-toggle="tab"  role="tab" data-cat="{{$value['category_id']}}">
                  <label class="category-name">{{isset($value['category_description']['name']) ? $value['category_description']['name'] : ''}}</label>
                  <div class="d-lg-none category-image"><img src="{{asset('uploads')}}/category/{{$value['image']}}" alt="Image"/></div>
                </a>
              </li>
              @if($key > 6)
               @php break; @endphp
              @endif
            @endforeach
          </ul>
          <!-- Tab panes -->
          <div class="tab-content my-3">
            @foreach($data['topCategory'] as $key=>$value)
              <div class="tab-pane @if($key == 0) active @endif" id="Tab-{{$value['category_id']}}" role="tabpanel">
                <div class="product-gird">
                  <ul class=" product prod-grid-col5 " id="cat-ul-{{$value['category_id']}}">
                  </ul>
                  </div>
              </div>
              @if($key > 7)
                @php break; @endphp
              @endif
            @endforeach
          </div>
        </div>

</section>
