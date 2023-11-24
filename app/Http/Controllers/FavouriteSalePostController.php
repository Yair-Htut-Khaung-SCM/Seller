<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;
use App\Models\Post;
use App\Models\Favourite;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteSalePostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favourite_posts;
        $sale_posts = collect($posts)->reverse()->where('purpose','=',GeneralType::PURPOSE_SALE);
        $users = User::all();
        $profile_image = ProfileImage::all();

        // $count =  Auth::user()->favourite_posts->count();

        return view('posts.favourite', compact('sale_posts', 'profile_image', 'users'));
    }

    public function store($id)
    {
        $favourite = new Favourite();
        $favourite->post_id = $id;
        $favourite->user_id = Auth::user()->id;

        $favourite->save();

        // return redirect('/posts');
        return back();
    }

    public function destroy($id)
    {
        $user_id = Auth::id();
        $post_id = $id;

        $favourite = Favourite::where('user_id', $user_id)
            ->where('post_id', $post_id);

        $favourite->delete();

        return back();
    }
}
