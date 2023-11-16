@extends('admin.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/admin_table.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme_color.css') }}">
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manufacturers</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manufacturers</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This is <i>Manufacturers Database Table</i> for list of Manufacturers for Uploaded Post under CarSeller Online Shopping Platform.
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                manufacturers DataTable
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end me-2">
                <a href="{{ route('admin.manufacturer.create') }}" class="btn text-light theme_bg_green button fw-bold" ><i class="fas fa-plus me-1"></i>Create New</a>
                </div>
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{--<tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>--}}
                    <tbody>
                        @foreach( $manufacturers as $manufacturer)
                        <tr>
                            <td>{{$manufacturer->id}}</td>
                            <td>
                                <img src="/images/manufacturer_logos/{{ $manufacturer->id}}.png" class="align-self-center rounded-circle" alt="Logo" width="50px" style="object-fit:cover;">
                            </td>
                            <td>{{$manufacturer->name}}</td>
                            <td>{{date_format($manufacturer->created_at,'d-m-Y')}}</td>
                            <td>
                                <div class="d-flex">
                                <a href="{{ route('admin.manufacturer.edit', $manufacturer->id ) }}" class="btn btn-sm btn-outline-secondary fw-bold me-2">Edit</a>
                                <form action="{{ route('admin.manufacturer.destroy', $manufacturer->id ) }}" method="POST" onclick="return confirm('Delete Your Post! Are you sure?')">
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

                {{ $manufacturers->links() }}
            </div>
        </div>
    </div>
</main>
@endsection