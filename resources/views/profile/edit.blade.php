@extends('layouts.app')

@section('title','Profile Edit')

@section('content')
<main class="container">
  <header class="my-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profile.edit') }}">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </nav>
    </div>
  </header>

  <div class="container bg-light rounded p-3 mb-4">
    <h5 class="theme_green fw-bold display-6">Edit Profile</h5>
    <div class="">
      <form class="px-4 py-3" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Upload Profile Image -->
        <div class="col-12 col-md-3 mx-auto mb-4 text-center">
          <!-- <label class="form-label" id="label">Upload profile photo</label> <br /> -->
          @if(Auth::user()->profile->profile_image)
          <span class="position-relative">
            <img src="{{ url(Auth::user()->profile->profile_image->url) }}" class="upload_preview_profile mx-auto" id="image_preview">
            <span class="position-absolute" style="bottom: -65px; right: -0px;">
              <label for="image" id="upload_icon">
                <img src="/images/icons/edit_icon_white.png" class="button rounded-circle" onclick="myFunction()" title="Edit Profile Image" alt="Edit Icon">
                <input type="file" name="image" id="image" class="disabled">
              </label>
            </span>
          </span>
          @error('image')
          <p style="color:red">{{ $message }}</p>
          @enderror
          @else
          <span class="position-relative">
            <img src="/images/default_avatar.jpeg" class="upload_preview_profile" id="image_preview">
            <span class="position-absolute" style="bottom: -65px; right: -0px;">
              <label for="image" id="upload_icon">
                <img src="/images/icons/edit_icon_white.png" class="button rounded-circle" onclick="myFunction()" title="Edit Profile Image" alt="Edit Icon">
                <input type="file" name="image" id="image" class="disabled">
              </label>
            </span>
          </span>
          @error('image')
          <p style="color:red">{{ $message }}</p>
          @enderror
          @endif
        </div>

        <!-- User Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name',Auth::user()->name) }}" placeholder="Your Name">
          @error('name')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email',Auth::user()->email) }}" placeholder="example@gmail.com">
          @error('email')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <!-- Status -->
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select select optional" name="status">
            <option value="" selected disabled>Choose Option</option>
            <option value="Normal User" @if(Auth::user()->profile->status == "Normal User") {{ 'selected' }} @endif >Normal User</option>
            <option value="Dealer" @if(Auth::user()->profile->status == "Dealer") {{ 'selected' }} @endif >Dealer</option>
            <option value="Agent" @if(Auth::user()->profile->status == "Agent") {{ 'selected' }} @endif >Agent</option>
          </select>
        </div>
        <!-- Phone Number -->
        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone',Auth::user()->profile->phone) }}" placeholder="Your Phone Number">
          @error('phone')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <!-- Address -->
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="text" class="form-control" name="address" id="address" value="{{ old('address',Auth::user()->profile->address) }}" placeholder="Your Address">
          @error('address')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" class="form-control" id="description">
          {{ old('description',Auth::user()->profile->description) }}
          </textarea>
          @error('description')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>
        <!-- Button -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn text-light theme_bg_green button fw-bold btn-sm p-2" style="width: 35%;">Save Changes</button>
          <a href="{{ route('profile.sale') }}" class="btn btn-outline-secondary fw-bold btn-sm p-2" style="width: 35%;">Cancel</a>
        </div>
        <!-- Change Password -->
        <div class="justify-content-center mt-5">
          <p class="d-inline">Change Your Password
            <a class="text-decoration-none custom_link_auth" href="{{ route('change_password.index') }}">Click Here</a>
          </p>
        </div>
    </div>
  </div>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  if (window.File && window.FileList && window.FileReader) {
    function myFunction() {
      console.log('fine');

      $("#image").on('change', function() {

        const file = this.files[0];
        console.log(file);
        if (file) {
          let reader = new FileReader();
          reader.onload = function(event) {
            console.log(event.target.result);
            $('#image_preview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }

      });

    }
  }
</script>
@endsection