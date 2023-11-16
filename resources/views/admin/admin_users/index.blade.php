@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/admin_table.css') }}">
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Admin Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Admin Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This is <i>Admin Users Database Table</i> for Super Admin Users Account who have access for Admin Dashboard in CarSeller Online Shopping Platform.
            </div>
        </div>
        <a href="/admin/register" style="text-decoration: none; color: #ffffff; background-color: #63f2a9; padding: 10px; border-radius: 5px;">Create new admin account</a>
        <br>
        <br>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Admin Users DataTable
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach( $users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{date_format($user->created_at,'D-M-Y')}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary fw-bold me-2" disabled>Edit</a>
                                <a href="#" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('Delete user will be permanently! Cannont be Undone! Are you sure?')" disabled>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
</main>
@endsection