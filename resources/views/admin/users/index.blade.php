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
        <h1 class="mt-4">users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This is <i>Users Database Table</i> for Register Users under CarSeller Online Shopping Platform.
            </div>
        </div>
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users DataTable
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
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
                            <td>
                                @if($user->profile && $user->profile->profile_image)
                                <img src="{{  url($user->profile->profile_image->url) }}" class="align-self-center ms-2 rounded-circle" alt="User Profile" width="100px" height="100px" style="object-fit:cover;">
                                @else
                                <img src="/images/navbar_profile_image.png" class="align-self-center rounded-circle" alt="Profile" width="100px" height="100px" style="object-fit:cover;">
                                @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{date_format($user->created_at,'d-m-Y')}}</td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{ route('admin.user.update', $user->id ) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary fw-bold me-2">Edit</button>
                                    </form>
                                    <form action="{{ route('admin.user.destroy', $user->id ) }}" method="POST" onclick="return confirm('Delete user will be permanently! Cannont be Undone! Are you sure?')">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm fw-bold">Delete</button>
                                    </form>
                                </div>
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