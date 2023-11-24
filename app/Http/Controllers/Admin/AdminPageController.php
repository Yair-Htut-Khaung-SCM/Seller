<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Enums\GeneralType;
use App\Services\Admin\ManufacturerService;
use App\Services\Admin\BuildTypeService;
use App\Services\Admin\PlateDivisionService;
use App\Services\Admin\UserService;
use App\Services\Admin\PostService;

class AdminPageController extends Controller
{
    public function __construct(ManufacturerService $manufacturerService, BuildTypeService $buildTypeService,
     PlateDivisionService $plateDivisionService, UserService $userService, PostService $postService)
    {
        $this->manufacturerService = $manufacturerService;
        $this->buildTypeService = $buildTypeService;
        $this->plateDivisionService = $plateDivisionService;
        $this->userService = $userService;
        $this->postService = $postService;
    }

    public function index()
    {
        $users_count = $this->userService->getCount();
        $posts_count = $this->postService->getCount();

        $buy_posts = $this->postService->getCount(GeneralType::PURPOSE_BUY);
        $sale_posts = $this->postService->getCount(GeneralType::PURPOSE_SALE);
        
        $manufacturers_count = $this->manufacturerService->getCount();
        $build_types_count = $this->buildTypeService->getCount();
        $plate_division_count = $this->plateDivisionService->getCount();

        // Data
        $posts = $this->postService->getAll();
        $posts_by_build_types = $this->buildTypeService->getBuildTypewithPostCount();
        $posts_by_manufacturers = $this->manufacturerService->getManufacturewithPostCount();

       // Manufacture by Latest Year
        $latest_year = Carbon::now()->subYear()->startOfYear();
        $before_latest = Carbon::now()->startOfYear();
        $latest_year_count = $this->manufacturerService->getManufactureByLastYear($latest_year,$before_latest);
        
       
        // Manufacture by Latest Month
        $latest_month = Carbon::now()->subMonth();
        $latest_month_count = $this->manufacturerService->getManufactureByLastMonth($latest_month);
      

        // Manufacture by Latest Month
        $latest_week = Carbon::now()->subWeek();
        $latest_week_count = $this->manufacturerService->getManufactureByLastMonth($latest_week);
       
        // Plate Division
        $posts_by_plate_divisions = $this->plateDivisionService->getPlateDivisionWithPostCount();

        return view(
            'admin.home',
            compact(
                // Data
                'posts',
                'posts_by_build_types',
                'posts_by_manufacturers',
                'posts_by_plate_divisions',
                // Count
                'users_count',
                'posts_count',
                'buy_posts',
                'sale_posts',
                'manufacturers_count',
                'latest_year_count',
                'latest_month_count',
                'latest_week_count',
                'build_types_count',
                'plate_division_count',

            )
        );
    }
}
