@extends('layouts.app')

@section('title','Profile')


@section('styles')
<link rel="stylesheet" href="{{ asset('css/custom_link.css') }}">
<link rel="stylesheet" href="{{ asset('css/filter_search.css') }}">

@endsection

@section('content')
<main class="container">
    <header class="my-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        </div>
    </header>
    <!-- Profile Detail --->
    <section class="rounded bg-light p-4 mt-2 mb-5 container">
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-3 text-center mb-4">
                @if($user_profile->profile_image)
                <img src="{{ url($user_img->url) }}" class=" rounded-circle" alt="User Profile" style="width: 200px; height:200px; object-fit:cover;">
                @else
                <img src="/images/default_avatar.jpeg" class="rounded-circle" alt="User Profile" width="200px" height="200px">
                @endif
            </div>
            <div class="col-sm-8 col-md-8 col-lg-9">
                <div class="d-flex mx-auto justify-content-between">
                    <h2 class="display-6 text-dark">{{ $user->name }}</h2>
                    @if( Auth::check() && $user_profile->user_id == Auth::user()->id )
                    <div class="float-end">
                        <a href="{{ route('profile.edit') }}" type="button" class="btn button btn-lg" title="Edit Profile">
                            <i class="fas fa-user-edit me-2"></i>
                            Edit
                        </a>
                    </div>
                    @endif
                </div>
                <p class="fs-4 text-success">{{ $user_profile->status ? $user_profile->status : 'N/A' }}</p>
                <br>
                <p class="fs-5">
                    <i class="fas fa-envelope me-2"></i>
                    Email : <strong class="text-dark"><a href="mailto:{{ $user->email }}" style="text-decoration:none; " class="mr-3 text-dark custom-nav-link">{{ $user->email }}</a></strong>
                </p>
                <p class="fs-5">
                    <i class="fas fa-phone me-2"></i>
                    Phone :
                    @if( $user_profile->phone )
                    <a href="tel:{{ $user_profile->phone }}" style="text-decoration:none;">
                        <span class="custom_link">{{ $user_profile->phone }}</span>
                    </a>
                    @else
                    <strong class="text-dark">N/A</strong>
                    @endif
                </p>
                <p class="fs-5">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Address : <strong class="text-dark">{{ $user_profile->address ? $user_profile->address : 'N/A'}}</strong>
                </p>
                <div class="row">
                    <p class="fs-5 text-dark">{{ $user_profile->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- User's Uploaded Posts --->
    <section class="mb-5 container">
        <div class="bg-light p-0 border rounded mb-3">
            <h5 class=" p-3 card_head_title border rounded" style="margin: 0px;">User's Uploaded Posts</h5>


                <div class="bg-light rounded my-2 text-center p-3">
                    <a href="\profile\sale" class="text-decoration-none h3 mx-3 mt-5" style="color: #12ca8a; border-bottom: 2px solid #12ca8a;">{{ __('sale_post') }}</a>
                    <a href="\profile\buy" class="text-decoration-none h3 mx-3 mt-5" style="color: #12ca8a;">{{ __('buy_post') }}</a>
                </div>


                <div class="bg-light rounded p-4 mb-5">
                    
                @if($posts->count())
            
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3  row-cols-xl-3 g-4 p-2">
                        <!-- Columns --->
                        @foreach($posts as $post)
                                    <div class="mb-2">
                                        {{--@include('components.card')--}}
                                        <x-card_lg purpose="sale" :route="route('sale.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image/>
                                    </div>
                            @endforeach
                            <!-- End Columns --->
                    </div>
                        
                        <div class=" mt-4 d-flex" style="width: 100%; margin:auto;">
                            {{ $posts->links('cpag.custom') }}
                        </div> 
                        
                @else
                
                <div class="d-grid col" style="margin:0 auto;">
                    <br>
                    
                    <b class="mx-auto">Sorry, there is no available post</b>
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
    
            
</div>
        
    </section>
    
</main>
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Show the first tab and hide the rest
    $('#tabs-nav li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Click function
    $('#tabs-nav li').click(function(){
    $('#tabs-nav li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();
    
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).fadeIn();
    return false;
});</script>
@endsection
@endsection