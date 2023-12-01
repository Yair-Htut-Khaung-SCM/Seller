<?php

namespace App\Http\Controllers;

use App\Services\FavouriteService;
use App\Services\Admin\PostService;
use App\Services\Admin\ManufacturerService;
use App\Services\Admin\BuildTypeService;
use App\Services\Admin\UserService;
use App\Services\Admin\PlateDivisionService;
use App\Services\ProfileImageService;
use App\Enums\GeneralType;

class PageController extends Controller
{
    public function __construct(PostService $postService, ManufacturerService $manufacturerService, BuildTypeService $buildTypeService, 
    UserService $userService, PlateDivisionService $plateDivisionService,ProfileImageService $profileImageService,FavouriteService $favouriteService)
    {
        $this->postService = $postService;
        $this->manufacturerService = $manufacturerService;
        $this->buildTypeService = $buildTypeService;
        $this->userService = $userService;
        $this->plateDivisionService = $plateDivisionService;
        $this->profileImageService = $profileImageService;
        $this->favouriteService = $favouriteService;
    }

    public function home()
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $posts = $this->postService->getPostByStatus();
        
        $buy_posts = $this->postService->getPostByStatus('purpose',GeneralType::PURPOSE_BUY);
        $sale_posts = $this->postService->getPostByStatus('purpose',GeneralType::PURPOSE_SALE);
        $brand_news = $this->postService->getPostByStatus('condition',GeneralType::CAR_CONDITION[0]);
        $profile_image = $this->profileImageService->getAll();

        // Popular car dealer
        $users = $this->userService->getAll();
        $user_count =  $this->userService->getCount();
        $build_type_count = $this->buildTypeService->getCount();
        $fav_array = array();
       
        foreach ($users as $user) {
            $user_posts = $this->postService->getPostOnlyId($user->id);
            $favourites = $this->favouriteService->getFavourite($user_posts);
            $total = count($favourites);
            $id = $user->id;
            $total_posts = count($user_posts);

            array_push($fav_array, ['id' => $id, 'total' => $total, 'post' => $total_posts]);
        }

        $fav_array = collect($fav_array)->sortBy('total')->reverse()->toArray();

        $id_array = !empty($fav_array) ? array_column($fav_array, 'id') : array();
        $total_array = !empty($fav_array) ? array_column($fav_array, 'total') : array();
        $post_total = !empty($fav_array) ? array_column($fav_array, 'post') : array();

        $popular_users = $this->userService->getUserName($id_array);

        $popular_users_img = array();
        $default_users_img = 'upload/images/profile/7/default_avatar.jpg';

        foreach ($id_array as $id_arr) {
            $profile_image_by_key = $this->profileImageService->getProfileImageByKey('id',$id_arr);
            if ($profile_image_by_key != null) {
                $popu_img = ($profile_image_by_key->url);
                array_push($popular_users_img, $popu_img ? $popu_img : $default_users_img);
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