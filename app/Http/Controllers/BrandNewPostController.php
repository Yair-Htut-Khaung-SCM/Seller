<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;
use Illuminate\Http\Request;
use App\Models\ProfileImage;
use App\Services\Admin\ManufacturerService;
use App\Services\Admin\BuildTypeService;
use App\Services\Admin\PostService;
use App\Services\Admin\UserService;

class BrandNewPostController extends Controller
{
    public function __construct(ManufacturerService $manufacturerService, BuildTypeService $buildTypeService, 
    PostService $postService, UserService $userService)
    {
        $this->manufacturerService = $manufacturerService;
        $this->buildTypeService = $buildTypeService;
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function buyPostBrandNew(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = ProfileImage::all();
        $users = $this->userService->getAll();
        $posts = $this->postService->getBrandNewPost($request, GeneralType::PURPOSE_BUY);

        return view('buys.brand_new', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users'));
    }

    public function salePostBrandNew(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = ProfileImage::all();
        $users = $this->userService->getAll();
        $posts = $this->postService->getBrandNewPost($request, GeneralType::PURPOSE_SALE);

        return view('posts.brand_new', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users'));
    }

    public function buyPostBuildType(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = ProfileImage::all();
        $users = $this->userService->getAll();
        $build_type_count = $this->buildTypeService->getCount();

        $posts = $this->postService->getBuildTypePost($request, GeneralType::PURPOSE_BUY);

        return view('buys.build_type', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'build_type_count'));
    }

    public function salePostBuildType(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = ProfileImage::all();
        $users = $this->userService->getAll();
        $build_type_count = $this->buildTypeService->getCount();

        $posts = $this->postService->getBuildTypePost($request, GeneralType::PURPOSE_SALE);

        return view('buys.build_type', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'build_type_count'));
    }

    public function buyPostManufacturer(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = ProfileImage::all();
        $users = $this->userService->getAll();
        $manufacturer_count = $this->manufacturerService->getCount();

        $posts = $this->postService->getManufauturerPost($request, GeneralType::PURPOSE_BUY);

        return view('buys.manufacturer', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'manufacturer_count'));
    }

    public function salePostManufacturer(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = ProfileImage::all();
        $users = $this->userService->getAll();
        $manufacturer_count = $this->manufacturerService->getCount();

        $posts = $this->postService->getManufauturerPost($request, GeneralType::PURPOSE_SALE);

        return view('buys.manufacturer', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'manufacturer_count'));
    }
}