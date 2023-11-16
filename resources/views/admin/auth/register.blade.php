@extends('layouts.auth')

@section('title')
Register
@endsection

@section('content')
<div style="height: 10vh;" class="none"></div>
<div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12 mobile"></div>
  <div class="col-lg-6 col-md-12 col-sm-12 custom_container">
    <h3 class="text-center theme_green fw-bold mt-2 display-5">{{__('adminregister')}}</h3>
    <form action="/admin/register" method="POST" class="px-4 py-3">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">{{__('user_name')}}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="User Name">
        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
      </div>
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
        <label for="password_confirmation" class="form-label">{{__('confirm_password')}}</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        @error('password_confirmation')
        <p style="color:red">{{ $message }}</p>
        @enderror
      </div>
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-5 pe-0">
            <button type="submit" class="btn button fw-bold mt-2" style="width: 100%;">{{__('sign_in')}}</button>
          </div>
          <div class="col-5 ps-0">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary fw-bold mt-2" style="width: 100%;">{{__('cancel')}}</a>
          </div>
        </div>
      </div>
      <div class="pt-3 mt-4" style="width: fit-content; margin:0 auto">
        <p>{{__('has_account')}} <a class="custom_link_auth" href="/admin/login">{{__('login_account')}}</a>
        </p>
      </div>
    </form>
  </div>
</div>
@endsection