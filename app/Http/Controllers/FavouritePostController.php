<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritePostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favourite_posts;
        $posts = collect($posts)->reverse();

        // $count =  Auth::user()->favourite_posts->count();

        return view('buys.favourite', compact('posts'));
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
