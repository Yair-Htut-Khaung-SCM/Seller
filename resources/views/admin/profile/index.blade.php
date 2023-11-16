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
        <h1>Admin Profile</h1>
        <p><b>Name</b> : {{$user->name}}</p>
        <p><b>Email</b> : {{$user->email}}</p>
        <p><b>Admin since</b> : {{date_format($user->created_at,'d-m-Y')}}</p>
        <a href="{{route('admin.profile.create')}}" class="btn btn-success px-4">Edit</a>
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