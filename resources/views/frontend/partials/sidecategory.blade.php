<div class="faq_accordion">
    @foreach($topCategory as $key=>$parent)
      @if(isset($parent->children))
        <div class="accordion_in">
          <div class="acc_head">
            <h3>{{$parent->categoryDescription?->name}}</h3>
          </div>
          <div class="acc_content">
              <ul class="panel-list">
               @foreach($parent->children as $key=>$child)
                  <li><a href="{{ route('category.products',['id' => $child->category_id]) }}">{{$child->categoryDescription?->name}}</a> </li>
               @endforeach
              </ul>
          </div>
        </div>
        @else
        <ul class="panel-list">
            <li>
              <a href="{{ route('category.products',['id' => $parent->category_id]) }}">{{$parent->categoryDescription?->name}}</a>
            </li>
        </ul>
      @endif

     @endforeach
</div>
