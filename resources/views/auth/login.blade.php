@extends('layouts.auth')

@section('title')
Login
@endsection

@section('content')
<div style="height: 15vh;" class="none"></div>
<div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12 mobile"></div>
  <div class="col-lg-6 col-md-12 col-sm-12 ">
    <div class="pb-3 px-4 margin_bot">
      <h3 class="text-center theme_green fw-bold mt-2 display-5">{{__('login')}}</h3>
      <x-alert />
      <form action="{{ route('login.store') }}" method="POST" class="px-4 py-3">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">{{__('email')}}</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="email@example.com">
          @error('email')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">{{__('password')}}</label>
          <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" placeholder="Password">
          <span>
            <i class="fa fa-eye" id="show-password"></i>
          </span>
          @error('password')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <div class="container mb-3">
          <div class="row justify-content-between">
            <div class="col-4">
              <input type="checkbox" class="form-check-input" name="remember" id="remember">
              <label class="form-check-label" for="remember">
                Remember me
              </label>
            </div>
            <div class="col-4">
              <a class="custom_link_auth d-block text-end" href="{{ route('forget-password.create') }}">{{__('forget_password')}}</a>
            </div>
          </div>
        </div>
        <button type="submit" class="btn button fw-bold mt-2" style="width: 50%; margin:0 auto"> {{__('sign_in')}}</button>
      </form>

      <div class="d-flex justify-content-center mt-4">
        <p class="d-inline">{{__('new_around')}}</p>
        <a class="custom_link_auth" href="{{ route('register.create') }}"> {{__('register')}}</a>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('auth.google') }}" class="mx-2">
          <!--<i class="fab fa-google fa-2x mx-4" style="color: rgb(221, 75, 57);"></i>-->
          <img src="/images/icons/google_logo.png" style="width: 186px; height: 40px;" class="bg-light rounded mt-1">
        </a>
        <a href="{{ route('auth.facebook') }}" class="mx-2">
          <!--<i class="fab fa-facebook-f fa-2x mx-4" style="color: rgb(59, 89, 152);"></i>-->
          <img src="/images/icons/login-with-facebook-icon-removebg-preview.png" style="width: 200px; height: 50px;">
        </a>
      </div>
    </div>
  </div>
</div>
@endsection