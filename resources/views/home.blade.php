@extends('layouts.app')

@section('title','Home')

@section('styles')
<style>
    .prev {
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 2%;
    }

    .next {
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 98%;
    }

    #owl-demo .item {
        margin: 5px;
    }

    .button-car-type {
        text-decoration: none;
        color: #111;
        border: 2px solid #6c757d;
        border-radius: 20px;
    }

    .button-car-type:hover {
        transform: scale(0.95, 0.95);
        text-decoration: none;
        color: #12ca8a;
        border: 2px solid #12ca8a;
    }

    .button-manufacturer {
        text-align: left;
        opacity: 0.8;
    }

    .button-manufacturer:hover {
        color: #12ca8a;
    }

    .customNavigation {
        text-align: center;
        cursor: pointer;
    }

    .customNavigation a {
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .app-banner-bg {
        /* width: 100%; */
        background: url(/images/app-banner.png) no-repeat center/cover;
        background-image: url(/images/app-banner.png);
        background-position-x: center;
        background-position-y: center;
        background-size: cover;
        /* background-repeat-x: no-repeat;
        background-repeat-y: no-repeat; */
        background-attachment: initial;
        background-origin: initial;
        background-clip: initial;
        background-color: initial;
        color: #111;
        border-radius: 1.5rem;
        padding: 2rem;
        padding-top: 4rem;
        padding-bottom: 4rem;
    }

    /* Window default customized scrollbar  */

    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px rgb(164, 164, 164);
        border-radius: 7px;
        background: #fff;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #12ca8a;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #68d6af;
    }

    @media only screen and (min-width: 10px) and (max-width: 994px) {
        .customNavigation {
            display: none;
        }
    }

    @media only screen and (min-width: 10px) and (max-width: 436px) {
        .filter-svg {
            display: none;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/g/jquery.owlcarousel@1.31(owl.carousel.css+owl.theme.css)">
<script src="https://cdn.jsdelivr.net/g/jquery@2.2.4,jquery.owlcarousel@1.31"></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection

@section('content')
<main class="m-0 p-0">
    <!-- Banner -->
    <section class="container-fluid vh-100 pt-5" style="background-image:url('images/home.jpeg'); width: 100%;  background-attachment: cover; background-repeat: no-repeat;  background-position: center;">
        <div style="height:22vh;"></div>
        <div class="row row-cols-1 d-flex align-item-end">
            <div class="col text-center">
                <h2 class="display-2 text-light">Search Less. Live More.</h2>
            </div>
            <div class="col text-center">
                <p class="fs-3 text-light">We make finding the right car simple</p>
            </div>
            <div class="container">
                <div class="col-12 col-md-9 p-4 mx-auto">

                    <form action="" id="SearchForm">
                        <div class="row d-flex justify-content-center bg-dark bg-opacity-75 rounded-4" style="padding:8px;">
                            <div class="col-2 mt-1" style="padding:0 2px;">
                                <button type="button" class="btn button fw-bold w-100" data-bs-toggle="modal" data-bs-target="#filterModal" id="filter_modal" style="font-size:13px; padding:5px 2px;">
                                    <i class="fa-solid fa-filter me-2 filter-svg"></i>{{ __('Filter') }}
                                </button>
                            </div>
                            <div class="col-1-5 mt-1" style="padding:0px 0px 0px 2px;">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px; padding-right: 27px; padding-top: 6px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; padding-bottom: 6px; color:#6c757d;">
                                    <option id="buy_model" value="buy" selected>{{__('Buy')}}</option>
                                    <option id="sale_model" value="sale">{{__('Sale')}}</option>
                                </select>
                            </div>
                            <div class="mt-1 col-6-5" style="padding:0px 5px 0px 0px;">
                                <input class="form-control me-2 bg-light" name="car_model" value="{{ old('car_model') }}" type="text" placeholder="{{ __('Search model')}}" style=" font-size:13px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 mt-1 searchBtn" style="padding: 0px 2px;">
                                <button type="submit" class="btn button fw-bold w-100" style=" font-size:13px;" id="search_model">
                                    <i class="fas fa-search me-2"></i>{{ __('search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('components.search')
    </section>

    <!-- Buy -->
    <section class="mt-5 mb-5">
        <div class="container p-0">
            <div class="card mb-3">
                <div class="card-header card_head_title">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title d-flex mt-2">
                                {{ __('buy_post') }}
                            </h5>
                        </div>
                        <div class="col-4" style="font-size: 1.1rem; font-weight:600;">
                            <a href="{{ route('buy.index') }}" class="float-end text-light text-decoration-none" title="View Buy Post">
                                {{ __('see_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <span class="span12" style="position: relative;">
                        <div id="owl-demo" class="owl-carousel">
                            @for( $i = 0 ; $i < 12 ; $i++ ) @php( $post=$buy_posts[$i] ) <div class="item m-3">
                                {{--@include('components.buy-card-sm')--}}
                                <x-card_sm purpose="buy" :route="route('buy.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                        </div>
                        @endfor
                </div>
                <div class="customNavigation">
                    <a class="prev button p-1 rounded-circle">
                        <img src="\images\icons\slide_left_icon_white.png" style="width:40px; height:40px;" alt="Previous">
                    </a>
                    <a class="next button p-1 rounded-circle">
                        <img src="\images\icons\slide_right_icon_white.png" style="width:40px; height:40px;" alt="Next">
                    </a>
                </div>
                </span>
            </div>
        </div>
        </div>
    </section>
    <!-- /Buy -->

    <!-- Sell -->
    <section class="mt-5 mb-5">
        <div class="container p-0">
            <div class="card mb-3">
                <div class="card-header card_head_title">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title d-flex mt-2">
                                {{ __('sale_post') }}
                            </h5>
                        </div>
                        <div class="col-4" style="font-size: 1.1rem; font-weight:600;">
                            <a href="{{ route('sale.index') }}" class="float-end text-light text-decoration-none" title="View Buy Post">
                                {{ __('see_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <span class="span12" style="position: relative;">
                        <div id="owl-demo" class="owl-carousel">
                            @for( $i = 0 ; $i < 12 ; $i++ ) @php( $post=$sale_posts[$i] ) <div class="item m-3">
                                {{--@include('components.card-sm')--}}
                                <x-card_sm purpose="sale" :route="route('sale.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                        </div>
                        @endfor
                </div>
                <div class="customNavigation">
                    <a class="prev button p-1 rounded-circle">
                        <img src="\images\icons\slide_left_icon_white.png" style="width:40px; height:40px;" alt="Previous">
                    </a>
                    <a class="next button p-1 rounded-circle">
                        <img src="\images\icons\slide_right_icon_white.png" style="width:40px; height:40px;" alt="Next">
                    </a>
                </div>
                </span>
            </div>
        </div>
        </div>
    </section>
    <!-- /Sell -->

    <!-- Latest Upload -->
    <section class="mt-5 mb-5">
        <div class="container p-0">
            <div class="card mb-3">
                <div class="card-header card_head_title">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title d-flex mt-2">
                                {{ __('latest_upload') }}
                            </h5>
                        </div>
                        <div class="col-4" style="font-size: 1.1rem; font-weight:600;">
                            <a href="{{ route('latest.buy.post.index') }}" class="float-end text-light text-decoration-none" title="View Latest Upload Car List">
                                {{ __('see_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <span class="span12" style="position: relative;">
                        <div id="owl-demo" class="owl-carousel">
                            @if( $posts->count() < 12) @php( $cnt=$posts->count() )
                                @for( $i = 0 ; $i < $cnt ; $i++ ) @php( $post=$posts[$i] ) <div class="item ">
                                    {{--@include('components.card-sm')--}}
                                    <x-card_sm purpose="sale" :route="route('sale.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                        </div>
                        @endfor
                        @else
                        @for( $i = 0 ; $i < 12 ; $i++ ) @php( $post=$posts[$i] ) <div class="item m-3">
                            @if($post->purpose=='buy')
                            {{--@include('components.buy-card-sm')--}}
                            <x-card_sm purpose="buy" :route="route('buy.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                            @else
                            {{--@include('components.card-sm')--}}
                            <x-card_sm purpose="sale" :route="route('sale.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                            @endif
                </div>
                @endfor
                @endif
            </div>
            <div class="customNavigation">
                <a class="prev button p-1 rounded-circle">
                    <img src="\images\icons\slide_left_icon_white.png" style="width:40px; height:40px;" alt="Previous">
                </a>
                <a class="next button p-1 rounded-circle">
                    <img src="\images\icons\slide_right_icon_white.png" style="width:40px; height:40px;" alt="Next">
                </a>
            </div>
            </span>
        </div>
        </div>
        </div>
    </section>

    <!-- BrandNew -->
    <section class="mt-5 mb-5">
        <div class="container p-0">
            <div class="card mb-3">
                <div class="card-header card_head_title">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title d-flex mt-2">
                                {{ __('brand_new_cars') }}
                            </h5>
                        </div>
                        <div class="col-4" style="font-size: 1.1rem; font-weight:600;">
                            <a href="{{ route('brand_new.buy.post.index','&condition=Brand New') }}" class="float-end text-light text-decoration-none" title="View Brand New Car List">
                                {{ __('see_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <span class="span12" style="position: relative;">
                        <div id="owl-demo" class="owl-carousel">
                            @for( $i = 0 ; $i < 12 ; $i++ ) @php( $post=$brand_news[$i] ) <div class="item m-3">
                                @if ($post->purpose=='buy')
                                {{--@include('components.buy-card-sm')--}}
                                <x-card_sm purpose="buy" :route="route('buy.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                                @else
                                {{--@include('components.card-sm')--}}
                                <x-card_sm purpose="sale" :route="route('sale.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                                @endif

                        </div>
                        @endfor
                </div>
                <div class="customNavigation">
                    <a class="prev button p-1 rounded-circle">
                        <img src="\images\icons\slide_left_icon_white.png" style="width:40px; height:40px;" alt="Previous">
                    </a>
                    <a class="next button p-1 rounded-circle">
                        <img src="\images\icons\slide_right_icon_white.png" style="width:40px; height:40px;" alt="Next">
                    </a>
                </div>
                </span>
            </div>
        </div>
        </div>
    </section>
    <!-- Popular Car Dealer -->
    <section class="mb-5">
        <div class="container rounded text-center head_title mb-4 p-2">
            <h3 class="mt-2">{{__('popular_car_dealer')}}</h3>
        </div>
        <div class="container bg-white rounded p-4">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @for ($i=0; $i< $user_count; $i++) <div class="col">
                    @include('components.profile_card')
            </div>
            @endfor
        </div>
        </div>
    </section>
    <!-- Browse By Car Build types -->
    <section class="mt-5 mb-5">
        <div class="container p-0">
            <div class="card mb-3">
                <div class="card-header card_head_title">
                    <div class="row">
                        <h5 class="card-title d-flex mt-2">
                            {{ __('search_by_build_type') }}
                        </h5>
                    </div>
                </div>
                <div class="card-body p-2 g-3">
                    <span class="span12" style="position: relative;">
                        <div id="owl-build-types" class="owl-carousel">
                            @for( $i = 0 ; $i < $build_type_count ; $i++ ) @php($build_type=$build_types[$i]) <div class="item p-2">
                                <a href="{{ route('build_type.buy.post.index','&build_type_id='.$i+1) }}" target="_self" class="btn button-car-type" title="View {{ $build_type->name }} Car List">
                                    <img src="images\build_types\{{$i+1}}.png" class="card-img-top" style="width: 80%; opacity:0.7; object-fit: contain;"><br>
                                    <span>{{ $build_type->name }}</span>
                                </a>
                        </div>
                        @endfor
                </div>
                <div class="customNavigation">
                    <a class="prev button p-1 rounded-circle">
                        <img src="\images\icons\slide_left_icon_white.png" style="width:40px; height:40px;" alt="Previous">
                    </a>
                    <a class="next button p-1 rounded-circle">
                        <img src="\images\icons\slide_right_icon_white.png" style="width:40px; height:40px;" alt="Next">
                    </a>
                </div>
                </span>
            </div>
        </div>
        </div>
    </section>
    <!-- Browse By Car manufacturer -->
    <section class="mb-5">
        <div class="container bg-light p-0 border rounded mb-3">
            <h5 class=" p-3 card_head_title border rounded" style="margin: 0px;">{{ __('search_by_manufacturer') }}</h5>
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 w-100 m-auto p-4">
                @foreach($manufacturers as $manufacturer)
                <a href="{{ route('manufacturer.buy.post.index','&manufacturer_id='.$manufacturer->id) }}" target="_self" class="btn button-manufacturer" title="View {{ $manufacturer->name}} Car List">
                    <img src="/images/manufacturer_logos/{{ $manufacturer->id}}.png" style="width: 2.3rem; height: 2.3rem;" alt="photo">
                    <span class="ms-2 fw-bold" style="font-size: 0.9rem;">{{ $manufacturer->name}}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Mobile App Banner -->
    <section class="mb-5">
        <div class="container">
            <div class="app-banner-bg text-center">
                <div class="col-md-8 ms-0 me-auto">
                    <h2 style="color: #eaeaea; font-family: 'Lato'; font-size: 2.5rem; font-weight: 600;">Car Seller</h2>
                    <p style="font-family: 'Lato'; font-size: 1.5rem; font-weight: 500;">Connect with us via Mobile Application</p>
                    <p style="font-family: 'Lato'; font-size: 1.2rem; font-weight: 400;">Free Download in here</p>
                    <a href="#" title="Download from PlayStore">
                        <img src="/images/img_playstore.png" class="mt-2" alt="Google Play">
                    </a>
                    <a href="#" title="Download from AppGallery">
                        <img src="/images/img_app_gallery.png" class="mt-2" alt="AppGallery">
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#owl-demo, #owl-brand-new").each(function() {
            $(this).owlCarousel({
                items: 4, //10 items above 1000px browser width
                itemsDesktop: [1000, 4], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 1], // betweem 900px and 601px
                itemsTablet: [600, 1], //2 items between 600 and 0
                itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
                pagination: false,
            });
        });
        // Custom Navigation Events
        $(".next").click(function() {
            $(this).closest('.span12').find('.owl-carousel').trigger('owl.next');
        })
        $(".prev").click(function() {
            $(this).closest('.span12').find('.owl-carousel').trigger('owl.prev');
        })
    });

    $(document).ready(function() {
        $("#owl-build-types").each(function() {
            $(this).owlCarousel({
                items: 6, //10 items above 1000px browser width
                itemsDesktop: [1000, 6], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 2], // betweem 900px and 601px
                itemsTablet: [600, 2], //2 items between 600 and 0
                itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
                pagination: false,
                loop: false,
            });
        });
        // Custom Navigation Events
        $(".next").click(function() {
            $(this).closest('.span12').find('.owl-carousel').trigger('owl.next');
        })
        $(".prev").click(function() {
            $(this).closest('.span12').find('.owl-carousel').trigger('owl.prev');
        })
    });

    $(document).ready(function() {
        $('#search_model').click(function () {
            if ($('#buy_model').is(':selected')) {
                $('#SearchForm').attr('action', 'buy/post/');
            }
            else if ($('#sale_model').is(':selected')) {
                $('#SearchForm').attr('action', 'sale/post/');
            }
        });  
    });  


    
    
</script>
@endsection