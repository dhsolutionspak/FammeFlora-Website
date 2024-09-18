@extends('frontend.layouts.app', ['class' => 'bg-white'])

@section('content')
<!--==== START BREADCUMB ====-->
<section class="page-crumb">
  <div class="otrixcontainer">
    <ul class="cd-breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
      <li class="current">{{$cms->title}}</li>
    </ul>
    <div class="page-title">{{$cms->heading}}</div>
  </div>
</section>
<!--==== END BREADCUMB ====-->

<section class="content">
  <div class="otrixcontainer">
    {!! $cms->description !!}
  </div>
</section>


@endsection
