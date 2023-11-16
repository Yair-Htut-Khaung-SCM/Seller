<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\BuildType;
use App\Models\Manufacturer;
use App\Models\PlateDivision;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminPageController extends Controller
{
    public function index()
    {
        // Count 
        $users_count = User::count();
        $posts_count = Post::count();
        $buy_posts = Post::Where('purpose', '=', 'buy')->count();
        $sale_posts = Post::Where('purpose', '=', 'sale')->count();
        $manufacturers_count = Manufacturer::count();
        $build_types_count = BuildType::count();
        $plate_division_count = PlateDivision::count();

        // Data
        $posts = Post::get()->toArray();
        $build_types = BuildType::all();
        $i = 0;
        foreach ($build_types as $build_type) {
            $posts_by_build_types[$i] = [
                'name' => $build_type->name,
                'value' => Post::where('build_type_id', $build_type->id)->get()->count()
            ];
            $i++;
        }
        // Manufacture
        $manufacturers = Manufacturer::all();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $posts_by_manufacturers[$i] = [
                'name' => $manufacturer->name,
                'value' => Post::where('manufacturer_id', $manufacturer->id)->get()->count()
            ];
            $i++;
        }

        $latest_year = Carbon::now();
        $latest_year->year = (now()->year)-1;
        $latest_year->month = 01;
        $latest_year->day = 01;

        $before_latest = Carbon::now();
        $before_latest->year = (now()->year);
        $before_latest->month = 01;
        $before_latest->day = 01;
        // Manufacture by Latest Year
        $manufacturers = Manufacturer::all();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $latest_year_count[$i] = [
                'name' => $manufacturer->name,
                'value' => Post::where('manufacturer_id', $manufacturer->id)->Where('created_at', '>=',$latest_year)->Where('created_at', '<',$before_latest)->get()->count()
            ];
            $i++;
        }

        $latest_month = Carbon::now();
        $latest_month->month = (now()->month);
        $latest_month->day = ((now()->day)-31);
        // Manufacture by Latest Month
        $manufacturers = Manufacturer::all();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $latest_month_count[$i] = [
                'name' => $manufacturer->name,
                'value' => Post::where('manufacturer_id', $manufacturer->id)->Where('created_at', '>=',$latest_month)->get()->count()
            ];
            $i++;
        }

        $latest_week = Carbon::now();
        $latest_week->day = (now()->day)-7;
        // Manufacture by Latest Month
        $manufacturers = Manufacturer::all();
        $i = 0;
        foreach ($manufacturers as $manufacturer) {
            $latest_week_count[$i] = [
                'name' => $manufacturer->name,
                'value' => Post::where('manufacturer_id', $manufacturer->id)->Where('created_at', '>=',$latest_week)->get()->count()
            ];
            $i++;
        }


        // Plate Division
        $plate_divisions = PlateDivision::all();
        $i = 0;
        foreach ($plate_divisions as $plate_division) {
            $posts_by_plate_divisions[$i] = [
                'name' => $plate_division->name,
                'value' => Post::where('plate_division_id', $plate_division->id)->get()->count()
            ];
            $i++;
        }
        $posts_by_plate_divisions[$i] = [
            'name' => 'Other',
            'value' => Post::where('plate_division_id', null)->get()->count()
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
