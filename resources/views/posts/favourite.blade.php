@extends('layouts.app')

@section('title','Favourite Posts')

@section('content')

<main class="container">
    <header class="my-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('my_fav')}}</li>
            </ol>
        </nav>
        </div>
    </header>
    <div class="container">
        <div class="bg-light rounded my-2 text-center p-3">
            {{--<h2 class="header-1 p-3 fw-bold " style="color:#12ca8a;">Buy Posts</h2>--}}
            <a href="{{ route('buy-favourite.index') }}" class="text-decoration-none h3 mx-3 mt-5" style="color: #12ca8a;">Buy Posts</a>
            <a href="{{ route('sale-favourite.index') }}" class="text-decoration-none h3 mx-3 mt-5" style="color: #12ca8a; border-bottom: 2px solid #12ca8a;">Sale Posts</a>
        </div>
        <div class="bg-light rounded p-2 mb-5">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 p-4">
                <!-- Columns --->
                @if($sale_posts->count())
                @foreach($sale_posts as $post)
                <div>
                    {{--@include('components.card')--}}
                    <x-card_lg purpose="sale" :route="route('sale.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image/>
                </div>
                @endforeach
                @else
                <br><br><br><br><br>
                <p>There is no Favourite posts.</p><br><br><br><br><br><br><br><br><br><br><br><br><br>
                @endif
                <!-- End Columns --->
            </div>
        </div>
    </div>
</main>

@endsection