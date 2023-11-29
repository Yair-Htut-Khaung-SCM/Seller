<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Services\FavouriteService;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function __construct(FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;
    }

    public function index()
    {
        $posts = Auth::user()->favourite_posts;
        $posts = collect($posts)->reverse();

        return view('buys.favourite', compact('posts'));
    }

    public function show($status)
    {
        $posts = Auth::user()->favourite_posts;
        $posts = collect($posts)->reverse()->where('purpose','=', $status);
        $users = User::all();
        $profile_image = ProfileImage::all();
        $view_path = $status == 'buy' ? 'buys' : 'posts';
        return view($view_path . '.favourite', compact('posts', 'profile_image', 'users'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $favourite = $this->favouriteService->saveFavourite($request->all());
        return back();
    }
    
    public function destroy(Favourite $favourite)
    {
        $favourite->delete();
        return back();
        // $user_id = Auth::id();
        // $post_id = $id;

        // $favourite = Favourite::where('user_id', $user_id)
        //     ->where('post_id', $post_id);

        // $favourite->delete();
    }
}
