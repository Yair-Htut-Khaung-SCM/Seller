<?php

namespace App\Http\Controllers;


use App\Services\FavouriteService;
use App\Services\ProfileImageService;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function __construct(FavouriteService $favouriteService,ProfileImageService $profileImageService,UserService $userService)
    {
        $this->favouriteService = $favouriteService;
        $this->profileImageService = $profileImageService;
        $this->userService = $userService;
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
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $view_path = $status == 'buy' ? 'buys' : 'posts';
        return view($view_path . '.favourite', compact('posts', 'profile_image', 'users'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $favourite = $this->favouriteService->saveFavourite($request->all());
        return back();
    }
    
    public function destroy($id)
    {
        $user_id = Auth::id();
        $post_id = $id;
        $favourite = $this->favouriteService->deleteFavourite($post_id, $user_id);
        return back();
    }
}
