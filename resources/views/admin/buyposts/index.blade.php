@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/admin_table.css') }}">

@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Buy Posts</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Buy Posts</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This is <i>Post Database Table</i> for upoloaded Posts by Users in CarSeller Online Shopping Platform.
            </div>
        </div>
        @include('components.alert')
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Post DataTable
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Purpose</th>
                            <th>Condition</th>
                            <th>Manufacturer</th>
                            <th>Car Model</th>
                            <th>Build Type</th>
                            <th>Uploader</th>
                            <th>Publish</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach( $posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->purpose }}</td>
                            <td>{{ $post->condition }}</td>
                            <td>{{ $post->manufacturer->name }}</td>
                            <td>{{ $post->car_model }}</td>
                            <td>{{ $post->buildType->name }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                @if( $post->is_published == 1 )
                                <span>Yes</span>
                                @else
                                <span class="text-danger fw-bold">No</span>
                                @endif
                            </td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                            <div class="d-flex">
                                <form action="{{ route('admin.buy.post.update', $post->id ) }}" method="POST" >
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary fw-bold me-2">Edit</button>
                                </form>
                                <form action="{{ route('admin.buy.post.destroy', $post->id ) }}" method="POST" onclick="return confirm('Delete post will be permanently! Cannont be Undone! Are you sure?')">
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
                {{ $posts->links()}}
            </div>
        </div>
    </div>
</main>
@endsection