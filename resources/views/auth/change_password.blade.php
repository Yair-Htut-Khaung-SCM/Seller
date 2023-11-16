@extends('layouts.app')

@section('title','Change Password')

@section('content')
<div class="container justify-content-center my-3 ">
  <div class="col-12 col-md-8 mx-auto bg-light rounded p-3">
 
    <h5 class="text-center theme_green fw-bold display-6">Change Password</h5>
    <div class="">
      <form class="px-4 py-3" action="{{ route('change_password.store') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="old_password" class="form-label">Old Password</label>
          <input type="password" class="form-control  @error('old_password') is-invalid @enderror" name="old_password" id="old_password" placeholder="Old Password">
          @error('old_password')
          <p style="color:red;">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">New Password</label>
          <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="New Password">
          @error('password')
          <p style="color:red;">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
          @error('password')
          <p style="color:red;">{{ $message }}</p>
          @enderror
        </div>
        <!-- Button -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn text-light theme_bg_green button fw-bold" style="width: 30%;">Change</button>
          <a href="{{ route('profile.sale') }}" class="btn btn-outline-secondary fw-bold" style="width: 30%;">Cancel</a>
        </div>
    </div>
  </div>
</div>
@endsection