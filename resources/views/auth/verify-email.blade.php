@extends('layouts.auth')

@section('title')
Email Verification 
@endsection

@section('content')
<div style="height: 15vh;" class="none"></div>
<div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12 mobile"></div>
  <div class="col-lg-6 col-md-12 col-sm-12 custom_container">
    <div class="py-3 px-4">

      <x-alert />
      <div class="card">
        <div class="card-header">
          <h3 class="text-center theme_green fw-bold mt-2 display-6">{{__(' Verify Your Email Address')}}</h3>
        </div>
        <div class="card-body">
          <p>
            {{ __('verify_noti')}}
          </p>
        </div>
        <div class="card-footer">
          <form class="px-4 py-1" action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit" class="btn text-light theme_bg_green d-block fw-bold button" style="width: 50%; margin:0 auto">{{__('resend_email')}}</button>
          </form>
          <form action="{{ route('logout') }}" method="POST" onclick="return confirm('Logout Your Account! Are you sure?')" class="btn d-block" style="width: 20%; float:right;">
            @method('DELETE')
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="fas fa-sign-out-alt me-2"></i>
                Logout
            </button>
        </form>
        </div>
      </div>
      
      
      
    </div>
  </div>
</div>


@endsection