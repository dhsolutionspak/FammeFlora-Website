@extends('installation.app', ['class' => 'bg-white'])
@section('content')
  <div class="container pt-5">
      <div class="d-flex justify-content-center mt-5">
        <div class="card p-3">
          <div class="card-body install-card-body h-100 w-100 z-3 position-relative">
            <center>
              <img src="{{asset('frontend')}}/images/logo.png" alt="" height="50">
            </center>
            <h1 class="my-3 text-center">Otrixweb - Ecommerce Website & Admin Panel Installation</h1>
            <p class="text-center">All Set you are good to go</p>
            <center>
              <p><i class="fa fa-check my-5" style="font-size:156px;color:green"></i></p>


              <a href="{{url('/')}}" class="btn btn-small btn-success my-3">
                Start Website & Admin Panel
              </a>
            </center>
          </div>
        </div>
      </div>
  </div>
@endsection
