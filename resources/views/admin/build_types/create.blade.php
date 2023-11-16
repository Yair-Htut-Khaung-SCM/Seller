@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/admin_table.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme_color.css') }}">
<link rel="stylesheet" href="{{ asset('css/upload_image.css') }}">
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Build Types</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.build-type.index') }}">Build Types</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Edit Build Type
            </div>
            <div class="card-body">
            <div class="container justify-content-center my-3 ">
  <div class="col-12 col-md-8 mx-auto bg-light rounded p-3">
    <div class="">
      <form class="px-4 py-3" action="{{ route('admin.build-type.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf

        <!-- Build Type Image -->
        <span class="position-relative">
                  <label for="image" id="upload_icon">
                    <img src="/images/icons/image_upload_icon.png" class="upload_image_icon" id="image_preview" onclick="myFunction()" title="Edit Profile Image" >
                    <input type="file" name="image" id="image" class="disabled">
                  </label>
                </span>

        <!-- Build Type Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Your Name">
          @error('name')
          <p style="color:red">{{ $message }}</p>
          @enderror
        </div>

        <!-- Button -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn text-light theme_bg_green button fw-bold" style="width: 30%;">Save Changes</button>
          <a href="{{ route('admin.build-type.index') }}" class="btn btn-outline-secondary fw-bold" style="width: 30%;">Cancel</a>
        </div>

    </div>
  
  </div>
</div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki

        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });

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