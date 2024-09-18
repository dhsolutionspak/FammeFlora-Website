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
            <p class="text-center">Make sure this is ready before proceeding</p>
            <ol class="list-group rounded-2">

                <li class="list-group-item fs-12 fw-600 d-flex align-items-center" style="line-height: 18px; color: #666; gap: 7px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                        <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                    </svg>
                    Database Name
                </li>
                <li class="list-group-item fs-12 fw-600 d-flex align-items-center" style="line-height: 18px; color: #666; gap: 7px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                        <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                    </svg>
                    Database Username
                </li>
                <li class="list-group-item fs-12 fw-600 d-flex align-items-center" style="line-height: 18px; color: #666; gap: 7px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                        <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                    </svg>
                    Database Password
                </li>
                <li class="list-group-item fs-12 fw-600 d-flex align-items-center" style="line-height: 18px; color: #666; gap: 7px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                        <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                    </svg>
                    Database Hostname
                </li>


                <form method="post" action="{{ route('verify.purchase') }}"  autocomplete="off">
                    @csrf
                    @method('post')

                      <div class="pl-lg-4 row">
                          <div class="col-md-6 form-group{{ $errors->has('purchase_code') ? ' has-danger' : '' }}">
                              <label class="form-control-label my-3" for="input-name">{{ __('Enter Purchase Code') }}</label>
                              <input type="text" name="purchase_code" id="input-purchase_code" class="form-control form-control-alternative{{ $errors->has('purchase_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Purchase Code') }}" value="Nulled by codingshop.net" autofocus>
                              @if ($errors->has('purchase_code'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('purchase_code') }}</strong>
                                  </span>
                              @endif
                          </div>

                        </div>


                  <center>
                    <button type="submit" class="btn btn-small btn-success my-3">
                      Activate Licence & Start Installation
                    </button>
                  </center>
                  <small class="my-5">
                    During the installation process, we will check if the files that are needed to be written (.env file) have write permission. We will also check if curl are enabled on your server or not.
                  </small>
                </form>

                <!-- <center>
                  <a href="{{route('checking-permission')}}" class="btn btn-small btn-success my-3">
                    Start Installation
                  </a>
                </center> -->

            </ol>
          </div>
        </div>
      </div>
  </div>
@endsection
