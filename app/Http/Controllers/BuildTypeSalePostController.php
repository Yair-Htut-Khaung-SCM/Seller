<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;
use App\Models\Post;
use App\Models\Image;
use App\Models\BuildType;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\PlateDivision;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;
use App\Models\ProfileImage;
use App\Models\User;

class BuildTypeSalePostController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturer::all();
        $build_types = BuildType::all();
        $profile_image = ProfileImage::all();
        $users = User::all();
        $build_type_count = BuildType::count();

        $posts = Post::when(request('lot'), function ($query) {
            $query->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) {
                $query->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) {
                $query->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) {
                $query->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) {
                $query->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->when(request('price'), function ($query) {
                if (request('price') == 'desc') {
                    $query->orderByDesc('price');
                } else if (request('price') == 'asc') {
                    $query->orderBy('price');
                }
            })
            ->when(request('sort_name'),function($query) {
                if (request('sort_name') == GeneralType::sort_name) {
                    $query->orderBy('manufacturer_id');
                }
            })
            ->when(request('engine_power'),function($query) {
                if (request('engine_power') == GeneralType::engine_power) {
                    $query->orderByDesc('engine_power');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == GeneralType::latest_year) {
                    $query->orderByDesc('year');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == GeneralType::latest_year_old) {
                    $query->orderBy('year');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == GeneralType::post_old) {
                    $query->orderBy('created_at');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == GeneralType::post_new) {
                    $query->orderByDesc('created_at');
                }
            })
            ->when(request('condition_status'),function($query) {
                    $query->where('condition', 'like', '%' . request('condition_status') . '%');
                
            })
            ->when(request('build_type_id'),function($query) {
                $query->where('build_type_id', 'like', '%' . request('build_type_id') . '%');
            
        })
            ->where('purpose','=',GeneralType::purpose_sale)
            ->where('is_published','=',GeneralType::is_published)
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();
        
        return view('posts.build_type', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'build_type_count'));
    }
}