@props(['post', 'users', 'profile_image', 'purpose', 'route', 'saleProfile'])
<link rel="stylesheet" href="{{ asset('css/card.css') }}">
<div class="cols rounded " style="width: 100%;">
    <!-- Card Layout -->
    <div class="card custom_box rounded-4">
        <div class="front">
            @if( $post->images->count())
            <img src="{{ url($post->images[0]->path).'/'.$post->images[0]->name }}" class="img  card-image" alt="Car">
            @else
            <img src="/images/no_image_available.png" class="img card-image" alt="Car">
            @endif
            @if( $post->condition == 'Brand New')
            <div class="condition-badge">
                <span class="badge badge-lg bg-success">{{ __($post->condition)}}</span>
            </div>
            @else
            <div class="condition-badge">
                <span class="badge badge-lg bg-success" style="letter-spacing: .1em;">{{ __($post->condition)}}</span>
            </div>
            @endif
            <div class="favorite">
                @if( Auth::check())
                @if( ! $post->likedBy( Auth::user()->id ))
                <form action="{{route('favourite.store',$post->id)}}" method="POST" style="width:fit-content;">
                    @csrf
                    <button type="submit" class="btn btn-default favorite_btn" title="Add to favorites" style="padding: 0; border: none; background: none;">
                        <img src="/images/icons/heart-outline.png" style="width: 25px; height: 25px;" alt="">
                    </button>
                </form>
                @else
                <form action="{{route('favourite.destroy',$post->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-default favorite_btn" title="Remove from favorites" style="padding: 0; border: none; background: none;">
                        <img src="/images/icons/heart-full.png" style="width: 25px; height: 25px;" alt="">
                    </button>
                </form>
                @endif
                @endif
            </div>
            <div class="flip">
                <div class="card-body p-2">
                    <div class="p-1 pt-0 pb-0">
                        <div class="" style="height:2rem;">
                            <span style="color:#1c3d25; font-family:Lato; font-size: 1.3rem; font-weight:600; display:inline-block; width:45%;" class="truncate"> {{ $post->manufacturer->name }} </span>
                            <span class="price">{{ number_format($post->price) }}
                                <span style="font-size: 1.1rem; font-weight:500; width: 52%;">{{ __('lakhs') }}</span>
                            </span>
                        </div>
                        <div class="d-flex " style="height:2rem; font-size: 1.15rem;">
                            <span class="truncate"> {{ $post->car_model }}</span>
                            <span style=" color:#1c3d25;  ">&nbsp;{{ $post->year }}</span>
                        </div>
                    </div>
                </div>
                <div class="overlay sm">
                    <div class="content">
                        <p>
                            <i class="fa fa-eye" style="display:block; margin: 0 auto;"></i>
                            View Detail
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-footer p-2 d-flex">
                @php ($user = $post->user_id - 1)
                <div class="col-11">
                    <a href="\profile\{{$saleProfile}}\{{ $post->user_id }}" class="text-decoration-none">
                        <img src="{{ url($profile_image[$user]->url) }}" class="align-self-center ms-1 rounded-circle" alt="User Profile" width="40px" height="40px" style="object-fit:cover;">
                        <span class="ms-2 limit-name" style="color:#39B87E; font-size: 0.8rem; font-weight:600;">{{ Str::limit($users [$user]->name, 20) }}</span>
                    </a>
                </div>
                <div class="col-1 mt-1" style="text-align: center;" title="share">
                    @php($postid = $post->id)
                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/{{$purpose}}/post/{{$postid}}&display=page" target="_blank" style="text-align: center; color:rgb(162, 157, 157);"><i class="fas fa-share-alt" id="share" style="font-size:24px;"></i></a>
                </div>
            </div>
        </div>
        <div class="back">
            <div class="card-header"><button class="btn btn-close undo"></button></div>
            <div class="card-body">
                <table class="table table-sm table-responsive-sm">
                    <tr class="sm">
                        <td class="left">{{ __('build_type') }}</td>
                        <td class="right">: {{ $post->buildType->name }}</td>
                    </tr>
                    <tr class="sm">
                        <td class="left">{{ __('Power')}}</td>
                        <td class="right">: {{ $post->engine_power }} cc</td>
                    </tr>
                    <tr class="sm">
                        <td class="left">{{ __('condition') }}</td>
                        <td class="right">: {{ $post->condition }}</td>
                    </tr>
                    <tr class="sm">
                        <td class="left">{{ __('seat')}}</td>
                        <td class="right">: {{ $post->seat ? $post->seat . '' : 'N/A'}} </td>
                    </tr>
                    <tr class="sm">
                        <td class="left">{{ __('gear') }}</td>
                        <td class="right">: {{ $post->gear ? $post->gear . '-speed' : 'N/A' }}</td>
                    </tr>
                    <tr class="sm">
                        <td class="left">{{ __('transmission') }}</td>
                        <td class="right">: {{ $post->transmission ? $post->transmission . '' : 'N/A' }}</td>
                    </tr>
                </table>

            </div>
            <a href="{{ $route }}" target="_self" title="Lot: #000{{$post->id}} Post Link" style="text-decoration: none; color:black;">
                <div class="card-footer text-center">
                    View More
                </div>
            </a>

        </div>
    </div>


</div>