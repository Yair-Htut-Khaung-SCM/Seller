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
      <h3 class="text-center theme_green fw-bold mt-2 display-5">{{__('admin_login')}}</h3>
      <x-alert />
      <form action="/admin/login" method="POST" class="px-4 py-3">
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
          <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" placeholder="Password">
          @error('password')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">
              Remember me
            </label>
          </div>
        </div>
        <button type="submit" class="btn button fw-bold mt-2" style="width: 50%; margin:0 auto"> {{__('sign_in')}}</button>
      </form>
    </div>
  </div>
</div>

@endsection