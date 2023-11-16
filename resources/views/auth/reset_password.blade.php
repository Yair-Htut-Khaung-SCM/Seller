@extends('layouts.auth')

@section('title')
Reset Password
@endsection

@section('content')

<div style="height: 15vh;" class="none"></div>
<div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12 mobile"></div>
  <div class="col-lg-6 col-md-12 col-sm-12 custom_container">
    <div class="py-3 px-4">
      <x-alert />
      <h3 class="text-center theme_green fw-bold mt-2 display-6">{{__('change_password')}}</h3>
      <form class="px-4 py-3" action="{{ route('reset-password.store') }}" method="POST">
        <div class="mb-3">
          @csrf
          <input type="hidden" name="token" value={{ request('token') }}>
          <input type="hidden" name="email" value={{ request('email') }}>
          <label for="password" class="form-label">{{__('password')}}</label>
          <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
          @error('password')
          <p style="color:red;">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label for="password_confirmation" class="form-label">{{__('confirm_password')}}</label>
          <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
          @error('password_confirmation')
          <p style="color:red;">{{ $message }}</p>
          @enderror
        </div>
        <button type="submit" class="d-block text-light theme_bg_green button btn fw-bold" style="width: 50%; margin:0 auto;">{{__('to_change_password')}}</button>
      </form>
    </div>
  </div>
</div>

@endsection