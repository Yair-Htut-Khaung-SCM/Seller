@extends('layouts.app')

@section('title','Post Lists')

@section('content')
<main class="container">
    <header class="mt-3 mb-2">
        <div class="row">
            <div class="col-12 col-md-8">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('sale_post') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-4">
                <form class="d-flex" action="{{ route('sale.post.index') }}" method="get">
                    <input class="form-control me-2" name="car_model" type="search" placeholder="Search By Model">
                    <button type="submit" class="btn button fw-bolder" style="width:150px;">{{ __('search') }}</button>
                </form>
            </div>
        </div>
    </header>

    
    <!-- Post List -->
    <div class="bg-light rounded my-2 p-3">
        <div class="row">
            <div class="col">
                <h4 class="text-black"><span class="text-muted">Showing Search Result: </span>
                    {{ request('manufacturer_id') ? $manufacturers[request('manufacturer_id')-1]->name : null }}
                </h4>
            </div>
            <div class="col">
                <div class="text-center">
                    @for( $i = 0 ; $i < $manufacturer_count ; $i++ ) @php($manufacturer=$manufacturers[$i])
                    @if(request()->fullUrl()=='http://localhost:8000/manufacturer/sale/post?manufacturer_id='.$i)
                    <a href="{{ route('manufacturer.buy.post.index','&manufacturer_id='.$i) }}" class="text-decoration-none h3 mx-3 mt-5 " style="color: #12ca8a;">{{ __('buy_post') }}</a>
                    <a href="{{ route('manufacturer.sale.post.index','&manufacturer_id='.$i) }}" class="text-decoration-none h3 mx-3 mt-5" style="color: #12ca8a; border-bottom: 2px solid #12ca8a;">{{ __('sale_post') }}</a>
                    @endif
                    @endfor
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>


    <div class="bg-light rounded p-4 mb-5">
        @if($posts->count())

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3  row-cols-xl-3 g-4 p-2">
            <!-- Columns --->
            @foreach($posts as $post)
            <div class="mb-2">
                {{--@include('components.buy-card')--}}
                <x-card_lg purpose="sale" :route="route('sale.post.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image/>
            </div>
            @endforeach
            <!-- End Columns --->
        </div>
        <div class=" mt-4 d-flex" style="width: 100%; margin:auto;">
            {{ $posts->links('cpag.custom') }}
        </div>
        @else
        <div class="d-grid col">
            <br>
            <img src="/images/errors/not_found.png" class="mx-auto" style="width:150px;" alt="Not Found Image">
            <b class="mx-auto">Sorry, the cars you're searching is not Available currently.</b>
            <p class="mx-auto">Please, try again Later.</p>
            <div class="d-flex p-2 mx-auto">
                <a href="/">
                    <img href="" src="\images\errors\previous.png" style="width:40px;" alt="Prev Arrow">
                </a>
                <p class="mt-2 ms-2">Back Home</p>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection