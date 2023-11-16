@extends('layouts.auth')

@section('title')
Forget Password
@endsection

@section('content')
<div style="height: 15vh;" class="none"></div>
<div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12 mobile"></div>
  <div class="col-lg-6 col-md-12 col-sm-12 custom_container">
    <div class="py-3 px-4">

      <x-alert />
      <h3 class="text-center theme_green fw-bold mt-2 display-6">{{__('forget_password')}}</h3>
      <form class="px-4 py-3" action="{{ route('forget-password.store') }}" method="post" )>
        @csrf
        <div class="mb-4">
          <label for="email" class="form-label">{{__('email')}}</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email@example.com">
          @error('email')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <button type="submit" class="btn text-light theme_bg_green d-block fw-bold button" style="width: 50%; margin:0 auto">{{__('to_change_password')}}</button>
        <div class="pt-3" style="width: 50%; margin:0 auto">
          <p class="d-inline">{{__('new_around')}}</p><a class="text-decoration-none  theme_green" href="{{ route('register.create') }}"> {{__('sign_up')}}</a>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection