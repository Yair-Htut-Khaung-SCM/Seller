@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/admin_table.css') }}">
<style>
    .custom-container {
        background-color: #efefef99;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')
<main>
    <section class='container mt-2 ps-5 pt-3 pb-3 custom-container'>
        <h1>Admin Profile Edit</h1>
        <form action="{{ route('admin.profile.store') }}" method="POST" class="px-4 py-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{__('user_name')}}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}" name="name" placeholder="User Name">
                @error('name')
                <p style="color:red">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{__('email')}}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}" name="email" placeholder="email@example.com">
                @error('email')
                <p style="color:red">{{ $message }}</p>
                @enderror
            </div>
            <button type='submit' class="btn btn-success px-4">Edit</button>
            <a href="/admin/profile" class="btn btn-secondary px-4">Cancel</a>
        </form>
    </section>
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