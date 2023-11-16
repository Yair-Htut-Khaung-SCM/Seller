@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/admin_table.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme_color.css') }}">
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Plate Divisions</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.plate-division.index') }}">Plate Divisions</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Edit Plate Division
            </div>
            <div class="card-body">
            <div class="container justify-content-center my-3 ">
  <div class="col-12 col-md-8 mx-auto bg-light rounded p-3">
    <div class="">
      <form class="px-4 py-3" action="{{ route('admin.plate-division.store') }}" method="POST" >
        @csrf

        <!-- Plate Division Name -->
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
          <a href="{{ route('admin.plate-division.index') }}" class="btn btn-outline-secondary fw-bold" style="width: 30%;">Cancel</a>
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
<script>
    window.addEventListener('DOMContentLoaded', event => {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki

        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>

@endsection