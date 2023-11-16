@extends('layouts.app')

@section('title', 'Post Detail')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/show_post.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_link.css') }}">
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


    @media only screen and (min-width: 10px) and (max-width: 991px) {
        .customNavigation {
            display: none;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/g/jquery.owlcarousel@1.31(owl.carousel.css+owl.theme.css)">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
<script src="https://cdn.jsdelivr.net/g/jquery@2.2.4,jquery.owlcarousel@1.31"></script>
@endsection

@section('content')
<main class="container p-0">
    <header class="my-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('home') }}</a>
                <li class="breadcrumb-item"><a href="{{ route('buy.post.index') }}">{{ __('buy_post') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('detail') }}</li>
            </ol>
        </nav>
    </header>

    <!-- Key Info -->
    <section>
        <div class="bg-light rounded-4 p-4 mt-2 container ">
            <div class="title">
                <div class="d-flex justify-content-between ">
                    <div class="col-10">
                        <h3 class="text-dark fs-3" style="font-family:'Lato'; font-size:2rem; font-weight:600;">
                            {{ $post->manufacturer->name }}
                            <span>{{ $post->car_model }}</span>
                            <span class="text-muted" style="font-size:1.5rem;  font-weight:400;">{{ $post->year }}</span>
                        </h3>
                    </div>
                    <div class="col-1 mt-1" style="text-align: center;" title="share">
                        @php($postid = $post->id)
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/buy/post/{{$postid}}&display=page" target="_blank" style="text-align: center; color:rgb(162, 157, 157);"><i class="fas fa-share-alt" id="share" style="font-size:24px;"></i></a>
                    </div>
                    @if (Auth::check() && !$post->likedBy(Auth::user()->id))
                    <form action="{{ route('favourite.store', $post->id) }}" method="POST" class="col-1" style="width:fit-content; text-align:center">
                        @csrf
                        <button type="submit" class="btn btn-default" title="Add to favorites" style="padding: 0; border: none; background: none;">
                            <img src="/images/icons/heart-outline.png" style="width: 36px; height: 36px;" alt="">
                        </button>
                    </form>
                    @else
                    <form action="{{ route('favourite.destroy', $post->id) }}" method="POST" class="col-1" style="text-align:center;">
                        @csrf
                        <button type="submit" class="btn btn-default" title="Remove from favorites" style="padding: 0; border: none; background: none;">
                            <img src="/images/icons/heart-full.png" style="width: 36px; height: 36px;" alt="">
                        </button>
                    </form>
                    @endif
                </div>
                <div class="d-flex justify-content-between ">
                    <span class="text-gray">{{ date('M d Y', strtotime($post->published_at)) }}</span>
                    <span>Lot No. #000{{ $post->id }}</span>
                </div>
            </div>

            <div class="row">
                <!-- Post's Images -->
                <div class="col-lg-8 mt-3">
                    @if ($post->images->count())
                    <div id="carouselIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                            @php($cnt = $post->images->count())
                            @for ($i = 1; $i < $cnt; $i++) <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="{{ $i }}"></button>
                                @endfor
                        </div>
                        <div class="carousel-inner rounded-4">
                            @php($first = true)
                            @foreach ($post->images as $image)
                            @if ($first == true)
                            <div class="carousel-item active">
                                @if (!file_exists($image->path))
                                <img src="{{ url('/images/car-seller-logo .png') }}" style="width:100%; aspect-ratio: 4/2.5; object-fit:cover;">
                                @else
                                <img src="{{ url($image->path) . '/' . $image->name }}" alt="Car" style="width:100%; aspect-ratio: 4/2.5; object-fit:cover;">
                                @endif


                            </div>
                            @php($first = false)
                            @else
                            <div class="carousel-item">
                                @if (!file_exists($image->path))
                                <img src="{{ url('/images/car-seller-logo .png') }}" style="width:100%; aspect-ratio: 4/2.5; object-fit:cover;">
                                @else
                                <img src="{{ url($image->path) . '/' . $image->name }}" alt="Car" style="width:100%; aspect-ratio: 4/2.5;  object-fit:cover;">
                                @endif
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @else
                    <div class="text-light text-center">
                        <img src="{{ url('/images/no_image_available.png') }}" style="width:100%; aspect-ratio: 4/2.5; object-fit:cover;">
                    </div>
                    @endif
                </div>
                <!-- Key Info Column -->
                <div class="col-lg-4 mt-3 ">
                    <div class="key-details">
                        <h4 class="theme_green ms-4" style="font-size: 1.5rem; font-family: 'Lato'; font-weight: 600; ">
                            {{ __('key_information') }}
                        </h4>
                        <dl class="mt-4" style="font-size: 1.2rem; font-family: 'Lato'; font-weight: 500; line-height:1rem; ">
                            <div class="d-flex my-3">
                                <i class="mdi mdi-engine me-3 mb-2" style="font-size: 2rem; color:#1d976c;" aria-hidden="true"></i>
                                <dd>
                                    <p>{{ $post->engine_power ? $post->engine_power . ' cc' : 'N/A' }}</p>
                                </dd>
                            </div>
                            <div class="d-flex my-3">
                                <i class="mdi mdi-car-shift-pattern me-3 mb-2" style="font-size: 2rem; color:#1d976c;" aria-hidden="true"></i>
                                <dd>
                                    <p>{{ $post->transmission }}</p>
                                </dd>
                            </div>
                            <div class="d-flex my-3">
                                <i class="mdi mdi-speedometer me-3 mb-2" style="font-size: 2rem; color:#1d976c;" aria-hidden="true"></i>
                                <dd>
                                    <p>{{ $post->mileage ? $post->mileage . ' km' : 'N/A' }}</p>
                                </dd>
                            </div>
                            <div class="d-flex my-3">
                                <i class="mdi mdi-gas-station me-3 mb-2" style="font-size: 2rem; color:#1d976c;" aria-hidden="true"></i>
                                <dd>
                                    <p>{{ $post->fuel_type ? $post->fuel_type : 'N/A' }}</p>
                                </dd>
                            </div>
                            <div class="d-flex my-3">
                                <i class="mdi mdi-currency-usd me-3 mb-2" style="font-size: 2.3rem; color:#1d976c;" aria-hidden="true"></i>
                                <dd>
                                    <p class="theme_green"><span style="font-size: 1.5rem; font-weight:600;">{{ number_format($post->price) }}</span>
                                        {{ __('lakhs') }}</p>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <hr>
                    <!--  Contact Information  -->
                    <div class="key-details">
                        <h4 class="theme_green ms-4" style="font-size: 1.5rem; font-family: 'Lato'; font-weight: 600; ">
                            {{ __('Contact Information') }}
                        </h4>
                        <dl class="mt-4" style="font-size: 1.2rem; font-family: 'Lato'; font-weight: 500; line-height:1rem; ">
                            <div class="d-flex">
                                <i class="fas fa-user me-3 mb-2" style="width:2rem; color:#1d976c;"></i>
                                <dd>
                                    <p>{{ $post->user->name }}</p>
                                </dd>
                            </div>
                            <div class="d-flex">
                                <i class="fas fa-phone me-3 mb-2" style="width:2rem;  color:#1d976c;"></i>
                                <dd>
                                    <p class="custom_link">{{ $post->phone }}</p>
                                </dd>
                            </div>

                            <div class="d-flex">
                                <i class="fas fa-location-dot me-3 mb-2" style="width:2rem; color:#1d976c;"></i>
                                <dd>
                                    <p style="white-space: pre-line; line-height:130%;">{{ $post->address }}</p>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <!-- Edit and Delete Button -->
                    @if (Auth::check() && $post->user_id == Auth::user()->id)
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('buy.post.delete', $post->id) }}" method="POST" onclick="return confirm('Delete Your Post! Are you sure?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary fw-bold">
                                <i class="fas fa-trash-alt me-2"></i>
                                {{ __('delete') }}
                            </button>
                        </form>
                        <p>
                            <a href="{{ route('buy.post.edit', $post->id) }}" class="btn button fw-bold">
                                <i class="fas fa-edit me-2"></i>
                                {{ __('edit') }}
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Car Details -->
    <section>
        <div class=" bg-light p-2 mb-2 mt-3 rounded-4 justify-content-center container">
            <h4 class="theme_green text-center m-3" style="font-size: 1.7rem; font-family: 'Lato'; font-weight: 600; ">
                {{ __('detail_specification') }}
            </h4>
            <div class="box-container col-12 mx-auto row row-cols-1 row-cols-md-3">
                <div class="col p-2">
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('lot') }}</span>
                        <span class="text">#000{{ $post->id }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('condition') }}</span>
                        <span class="text">{{ $post->condition ? $post->condition : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('manufacturer') }}</span>
                        <span class="text">{{ $post->manufacturer->name ? $post->manufacturer->name : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('car_model') }}</span>
                        <span class="text">{{ $post->car_model ? $post->car_model : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('year') }}</span>
                        <span class="text">{{ $post->year ? $post->year : 'N/A' }}</span>
                    </div>

                    <div class="fillable_box">
                        <span class="label">{{ __('color') }}</span>
                        <span class="text">{{ $post->color ? $post->color : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('build_type') }}</span>
                        <span class="text">{{ $post->buildType->name ? $post->buildType->name : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('trim') }}</span>
                        <span class="text">{{ $post->trim_name ? $post->trim_name : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('steering') }}</span>
                        <span class="text">{{ $post->steering_position ? $post->steering_position : 'N/A' }}</span>
                    </div>

                    <div class="fillable_box">
                        <span class="label">{{ __('seat') }}</span>
                        <span class="text">{{ $post->seat ? $post->seat : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('door') }}</span>
                        <span class="text">{{ $post->door ? $post->door : 'N/A' }}</span>
                    </div>
                </div>

                <div class="col p-2">
                    <div class="fillable_box">
                        <span class="label">{{ __('mileage') }}</span>
                        <span class="text">{{ $post->mileage ? $post->mileage . ' km' : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('engine') }}</span>
                        <span class="text">{{ $post->engine_power ? $post->engine_power . ' cc' : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('transmission') }}</span>
                        <span class="text">{{ $post->transmission ? $post->transmission : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('gear') }}</span>
                        <span class="text">{{ $post->gear ? $post->gear . '-speed' : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('fuel') }}</span>
                        <span class="text">{{ $post->fuel_type ? $post->fuel_type : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box bg-gray">
                        <span class="label">{{ __('licence_status') }}</span>
                        <span class="text">{{ $post->licence_status ? $post->licence_status : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('plate_division') }}</span>
                        <span class="text">{{ $post->plateDivision ? $post->plateDivision->name : 'N/A' }}</span>
                    </div>
                    <div class="fillable_box">
                        <span class="label">{{ __('plate_color') }}</span>
                        <span class="text">{{ $post->plate_color ? $post->plate_color : 'N/A' }}</span>
                    </div>
                </div>
                <div class="col p-2">
                    <div class="fillable-box-descript bg-gray">
                        <span class="label-descript">{{ __('description') }}</span>
                        <div class="text" style="white-space: pre-line;">
                            {{ $post->description ? $post->description : 'N/A' }}</div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!--comment-->

    <section>
        <div class="container p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="theme_green text-center m-3" style="font-size: 1.7rem; font-family: 'Lato'; font-weight: 600; ">
                        Comment Section
                    </h4>
                </div>

                <div class="card-body">

                    <class="card-body">

                        @if ($post->comment)
                        @foreach ($post->comment as $comment)
                        @php($user = $comment->user_id - 1)
                        <table class="table" style="margin: 15px; width:100%;">
                            <tbody>
                                <tr class="col-12" style="clear:both;">
                                    <td colspan="2" class="col-1" style=" text-align:center; border:none; vertical-align:top;">
                                        <a href="\profile\sale\{{ $comment->user_id }}">
                                            @if (isset($profile_image[$user]))
                                            <img src="{{ url($profile_image[$user]->url)}}" class="align-self-center ms-2 rounded-circle" alt="User Profile" width="50px" height="50px" style="object-fit:cover;">
                                            @else
                                            <img src="/images/default_avatar.jpeg" class="align-self-center rounded-circle" alt="Profile" width="50px" height="50px" style="object-fit:cover;">
                                            @endif
                                        </a>
                                    </td>
                                    <td style="border: none;" class="col-9">

                                        <h5 style="margin-bottom:1px; font-size:18px; font-weight:bold; color:black;">
                                            <a href="\profile\sale\{{ $comment->user_id }}" style="text-decoration: none; color:black;">

                                                {{ $userbuy[$user]->name }}
                                            </a>
                                        </h5>

                                        <p class="text-black" style="max-height: 96px; overflow-y:hidden;">
                                            {{ $comment->comment }}

                                            <!-- reply -->
                                        <div>
                                            @foreach ($comment->replies as $replies)
                                            @php($user = $replies->user_id - 1)
                                            <div class="d-flex flex-row">
                                                @if ($replies->parent_id)
                                                <a href="\profile\sale\{{ $replies->user_id }}">
                                                    @if (isset($profile_image[$user]))
                                                    <img src="{{ url($profile_image[$user]->url) }}" class="align-self-center ms-2 rounded-circle" alt="User Profile" width="30px" height="30px" style="object-fit:cover;" @else <img src="/images/default_avatar.jpeg" class="align-self-center rounded-circle" alt="Profile" width="30px" height="30px" style="object-fit:cover;">
                                                    @endif
                                                </a>
                                                <h5 style="margin-bottom:1px; font-size:18px; font-weight:bold; color:black; margin-left:10px;">
                                                    <a href="\profile\sale\{{ $replies->user_id }}" style="text-decoration: none; color:black;">{{ $userbuy[$user]->name }}
                                                    </a>
                                                </h5>
                                                @endif
                                            </div>
                                            <p class="ms-5">{{$replies->comment}}</p>
                                            @endforeach
                                        </div>
                                        <!--  reply display textbox -->
                                        <div class="replyDiv" style="display:block;">
                                            <form method="POST" action="{{ route('comment.store') }}">
                                                @csrf
                                                <br>
                                                @if (auth()->check())
                                                @if (Auth::user()->profile->profile_image)
                                                <img src="{{ url(Auth::user()->profile->profile_image->url) }}" class="align-self-center ms-2 rounded-circle" alt="User Profile" width="32px" height="32px" style="object-fit:cover;">
                                                @else
                                                <img src="/images/default_avatar.jpeg" class="align-self-center rounded-circle" alt="Profile" width="32px" height="32px" style="object-fit:cover;">
                                                @endif

                                                <input type="hidden" name="post_slug" value={{ $post->id }}>
                                                <input type="text" name="comment" placeholder="Enter reply comment" class="m-2 me-1 col-3" style="outline: none;border: none;
                                    border-bottom: 1px solid darkgrey;">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <button type="submit" class="" style="outline: none; border:none; background-color:white;"><i class="fa-sharp fa-solid fa-paper-plane" style="font-size:20px;"></i></button>
                                                @endif
                                            </form>
                                        </div>
                                        </p>

                                    </td>
                                    <td style="border: none;" class="col-2">
                                        <div class="d-flex flex-row">
                                            @if (Auth::check() && $comment->user_id == Auth::user()->id)
                                            <a href="{{ route('comment.edit', $comment->id) }}" data-toggle="modal" data-target="{{ '#editModal' . $comment->id }}">
                                                <button class="btn btn-primary btn-sm mx-0 mt-3 "><i class="fa-sharp fa-solid fa-edit"></i>
                                                </button>
                                            </a>

                                            <form action={{ url('components/card-sm/' . $comment->id) }} method="POST" id="deleteCmt">
                                                @csrf
                                                @method('DELETE')
                                                <div>
                                                    <button class="btn btn-danger btn-sm mx-1 mt-3" style="display:inline;" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa-sharp fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>

                                        <!-- Modal -->

                                        <div class="modal fade" id="{{ 'editModal' . $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Edit Your Comment</h5>
                                                        <button type="button" class=" btn close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @if (isset($comment))
                                                    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <textarea rows="3" class="form-control" name="updatecomment">{{ $comment->comment }}</textarea>
                                                            @error('updatecomment')
                                                            <small class="text-danger">{{ $errors->first('updatecomment') }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info text-white">Update</button>

                                                        </div>
                                                    </form>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>

                        @endforeach
                        @endif
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin: 15px 45px;">
                                @if (auth()->check())
                                @if (Auth::user()->profile->profile_image)
                                <img src="{{ url(Auth::user()->profile->profile_image->url) }}" class="align-self-center ms-2 rounded-circle" alt="User Profile" width="32px" height="32px" style="object-fit:cover;">
                                @else
                                <img src="/images/default_avatar.jpeg" class="align-self-center rounded-circle" alt="Profile" width="32px" height="32px" style="object-fit:cover;">
                                @endif
                                <input type="hidden" name="post_slug" value={{ $post->id }}>
                                <input type="text" name="comment" placeholder="Enter your comment" class="m-3 me-1 col-4" style="outline: none;border: none;
                                    border-bottom: 1px solid darkgrey;">
                                <button type="submit" class="" style="outline: none; border:none; background-color:white;"><i class="fa-sharp fa-solid fa-paper-plane" style="color:#0c924c; font-size:20px;"></i></button>
                                @error('comment')
                                <p style="color:red">{{ $message }}</p>
                                @enderror
                                @else
                                @endif
                            </div><br>
                        </form>
                </div>


            </div>
        </div>
    </section>

    <!-- Similar Listing -->
    <section class="mt-5 mb-5">
        <div class="container p-0">
            <div class="card mb-3">
                <div class="card-header card_head_title">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title d-flex mt-2">
                                {{ __('similar') }}
                            </h5>
                        </div>
                        <div class="col-4" style="font-size: 1.1rem; font-weight:600;">
                            <a href="{{ route('buy.post.index') }}" class="float-end text-light text-decoration-none">
                                {{ __('see_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <span class="span12" style="position: relative;">
                        <div id="owl-demo" class="owl-carousel">
                            @foreach ($similar_posts as $post)
                            <div class="item m-3">
                                {{--@include('components.card-sm')--}}
                                <x-card_sm purpose="buy" :route="route('buy.post.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image />
                            </div>
                            @endforeach
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
    </div>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            items: 4, //10 items above 1000px browser width
            itemsDesktop: [1000, 4], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 1], // betweem 900px and 601px
            itemsTablet: [600, 1], //2 items between 600 and 0
            itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option
            pagination: false,
        });
        // Custom Navigation Events
        $(".next").click(function() {
            $(this).closest('.span12').find('.owl-carousel').trigger('owl.next');
        })
        $(".prev").click(function() {
            $(this).closest('.span12').find('.owl-carousel').trigger('owl.prev');
        })
    });

    //function reply(caller) {
    //  $(caller).after($('.replyDiv'));
    //  $('.replyDiv').toggle();
    //}
    
    //function reply_close(caller) {
    //    $('.replyDiv').hide();
    //}

    //$('.reply-button').on('click', function() {
    //    // Hide the corresponding reply input field
    //    $(this).closest('.replyDiv').hide();
    //});
  
    //$('.reply-close').on('click', function() {
    //    // Hide the corresponding reply input field
    //    $(this).closest('.replyDiv').hide();
    //});
</script>
@endsection