<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $posts_count = $this->postService->getCount(null);

        $buy_posts = $this->postService->getCount(GeneralType::purpose_buy);
        $sale_posts = $this->postService->getCount(GeneralType::purpose_sale);
        
        $manufacturers_count = $this->manufacturerService->getCount();
        $build_types_count = $this->buildTypeService->getCount();
        $plate_division_count = $this->plateDivisionService->getCount();

        // Data
        $posts = $this->postService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $i = 0;
        foreach ($build_types as $build_type) {
            $posts_by_build_types[$i] = [
                'name' => $build_type->name,
                'value' => $this->postService->getPostCountByBuildTypeId($build_type->id)
            ];
            $i++;
        }
        // Manufacture
        $manufacturers = $this->manufacturerService->getAll();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $posts_by_manufacturers[$i] = [
                'name' => $manufacturer->name,
                'value' => $this->postService->getPostCountByManufacturerId($manufacturer->id)
            ];
            $i++;
        }

        $latest_year = Carbon::now();
        $latest_year->year = (now()->year)-1;
        $latest_year->month = GeneralType::month;
        $latest_year->day = GeneralType::day;

        $before_latest = Carbon::now();
        $before_latest->year = (now()->year);
        $before_latest->month = GeneralType::month;
        $before_latest->day = GeneralType::day;
        // Manufacture by Latest Year
        $manufacturers = $this->manufacturerService->getAll();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $latest_year_count[$i] = [
                'name' => $manufacturer->name,
                'value' => $this->postService->getPostCountLatestYear($manufacturer->id,$latest_year,$before_latest)
            ];
            $i++;
        }

        $latest_month = Carbon::now();
        $latest_month->month = (now()->month);
        $latest_month->day = ((now()->day)-31);
        // Manufacture by Latest Month
        $manufacturers = $this->manufacturerService->getAll();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $latest_month_count[$i] = [
                'name' => $manufacturer->name,
                'value' => $this->postService->getPostCountLatestMonth($manufacturer->id,$latest_month)
            ];
            $i++;
        }

        $latest_week = Carbon::now();
        $latest_week->day = (now()->day)-7;
        // Manufacture by Latest Month
        $manufacturers =  $this->manufacturerService->getAll();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $latest_week_count[$i] = [
                'name' => $manufacturer->name,
                'value' => $this->postService->getPostCountLatestMonth($manufacturer->id,$latest_week)
            ];
            $i++;
        }


        // Plate Division
        $plate_divisions = $this->plateDivisionService->getAll();
        $i = 0;
        foreach ($plate_divisions as $plate_division) {
            $posts_by_plate_divisions[$i] = [
                'name' => $plate_division->name,
                'value' => $this->postService->getPostCountByPlateDivisionId($plate_division->id)
            ];
            $i++;
        }
        $posts_by_plate_divisions[$i] = [
            'name' => 'Other',
            'value' => $this->postService->getPostCountByPlateDivisionId(null)
        ];


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
