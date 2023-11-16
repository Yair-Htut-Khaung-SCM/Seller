<style>
    .profile-card {
        border: none;
        border-radius: 20px;
        border: 2px solid #ddd;
    }

    .articles {
        font-family: 'Lato';
        font-size: 0.8rem;
        color: #888888;
    }

    .number {
        color: #309c6b;
        font-family: 'Lato';
        font-size: 1.2rem;
        font-weight: 600;
    }
</style>

<div class="profile-card p-3">
    <div class="d-flex align-items-center">
        <div class="">
            @if($popular_users_img[$i] == "upload/images/profile/7/default_avatar.jpg")
            <img src="{{url('/images/default_avatar.jpeg')}}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            @else
            <img src="{{ url($popular_users_img[$i]) }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
            @endif
        </div>
        <div class="ml-3 w-100" style="overflow-x:hidden;">
            <h5 class="m-0" style="color:#39B87E; font-size: 1.2rem; font-weight:600;">{{ Str::limit($popular_users[$i], 20) }}</h5>
            <span style="font-size:0.8rem;">Member Since {{ App\Models\User::find($id_array[$i])->created_at->diffForHumans() }}</span>
            <div class="d-flex justify-content-between px-4">
                <div class="d-flex flex-column text-center">
                    <span class="articles">Posts</span>
                    <span class="number">{{$post_total[$i]}}</span>
                </div>
                <div class="d-flex flex-column text-center">
                    <span class="articles">Likes</span>
                    <span class="number">{{$total_array[$i]}}</span>
                </div>
            </div>
            <div class="mt-2">
                <a type="button" class="btn btn-sm button rounded-3 w-100" href="\profile\sale\{{ $id_array[$i] }}" class="btn button btn-sm" title="View {{ $popular_users[$i] }} Profile">View Profile</a>
            </div>
        </div>
    </div>
</div>