@extends('admin.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/star-rating-svg.css">

@section('content')

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
{{--                        <h6 class="h2 text-black d-inline-block mb-country">Review</h6>--}}
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-bloc-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('review') }}">ReviewCustomer </a></li>
                            <li class="breadcrumb-item">Edit</li>
                        </nav>
                    </div>
                </div>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">{{ __('Edit Review ') }}</h6>
                            <form method="post" action="{{ route('review.update',['id' => $data->id]) }}"  autocomplete="off">
                                @csrf
                                @method('post')


                                <div class="pl-lg-4 row">
                                    <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Review') }}</label>
                                        <textarea name="text" rows="3" cols="80" class="form-control">{{$data->text}}</textarea>
                                        @if ($errors->has('text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('text') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 form-group{{ $errors->has('star') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="star">{{ __('Stars') }}</label>
                                        <div class="d-flex justify-content-center my-3 ">
                                          <div class="rating text-center p-2"> </div>
                                           <span class="live-rating text-center" ></span>
                                           <input type="hidden" name="rating" value="" id="review">
                                           <input type="hidden" name="product_id" value="" id="productid">
                                        </div>
                                    </div>


                                </div>

                                <div class="pl-lg-4 row">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        <a href="{{ route('review') }}" type="button" class="btn btn-danger mt-4">{{ __('Cancel') }}</a>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.star-rating-svg.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  $(".rating").starRating({
    totalStars: 5,
    emptyColor: 'lightgray',
    hoverColor: 'slategray',
    disableAfterRate: false,
    activeColor: 'cornflowerblue',
    initialRating: '{{$data->rating}}',
    strokeWidth: 0,
    readOnly: false,
    useGradient: false,
    minRating: 1,
    onLeave: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentRating);
      $('#review').val(currentRating)
    }
  });
});
</script>

@endpush
