<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Post;

use App\Models\User;
use App\Models\BuildType;
use App\Models\Favourite;
use App\Services\Admin\PostService;
use Illuminate\Support\Arr;
use App\Models\Manufacturer;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\GeneralType;

class PageController extends Controller
{
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function home()
    {
        
        $manufacturers = Manufacturer::all();
        $build_types = BuildType::all();
        $posts = Post::with('favourites')->where('is_published', '=', GeneralType::IS_PUBLISHED)->orderBy("id", "DESC")->limit(12)->get();
        $buy_posts = $this->postService->getPostByStatus('purpose',GeneralType::PURPOSE_BUY);
        $sale_posts = $this->postService->getPostByStatus('purpose',GeneralType::PURPOSE_SALE);
        $brand_news = $this->postService->getPostByStatus('condition',GeneralType::CAR_CONDITION[0]);
        $profile_image = ProfileImage::all();
        // Popular car dealer
        $users = User::all();
        $user_count = User::count();
        $build_type_count = BuildType::count();
        $fav_array = array();

        foreach ($users as $user) {
            $user_posts = Post::where('user_id', $user->id)->where('is_published', '=', GeneralType::IS_PUBLISHED)->get('id');
            $arr = array();
            foreach ($user_posts as $post) {
                array_push($arr, $post->id);
            }
            $favourites = Favourite::whereIn('post_id', $arr)->get();
            $total = count($favourites);
            $id = $user->id;
            $total_posts = count($arr);
            array_push($fav_array, ['id' => $id, 'total' => $total, 'post' => $total_posts]);
        }
        $fav_array = collect($fav_array)->sortBy('total')->reverse()->toArray();
        $id_array = array();
        $total_array = array();
        $post_total = array();
        foreach ($fav_array as $fav) {
            $i = 0;
            if ($i == 6) {
                return;
            } else {
                $i++;
            }
            array_push($total_array, $fav['total']);
            array_push($id_array, $fav['id']);
            array_push($post_total, $fav['post']);
        }
        $popular_users = array();
        foreach ($id_array as $id_arr) {
            $popu_user = User::where('id', $id_arr)->first()->name;
            array_push($popular_users, $popu_user);
        }

        $popular_users_img = array();
        foreach ($id_array as $id_arr) {
            if (ProfileImage::where('id', $id_arr)->first() != null) {
                $popu_img = (ProfileImage::where('id', $id_arr)->first()->url);
                array_push($popular_users_img, $popu_img);
            } else {
                array_push($popular_users_img, 'upload/images/profile/7/default_avatar.jpg');
            }
        }
        return view('home', compact('posts', 'popular_users', 'popular_users_img', 'id_array', 'post_total', 'total_array', 'manufacturers', 'build_types', 'brand_news', 'buy_posts', 'sale_posts', 'profile_image', 'users', 'user_count', 'build_type_count'));
    }

    public function about()
    {
        return view('about');
    }

    public function policy()
    {
        return view('policy');
    }
}