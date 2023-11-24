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

class LatestBuyPostController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturer::all();
        $build_types = BuildType::all();
        $users = User::all();
        $profile_image = ProfileImage::all();

        $posts = Post::when(request('lot'), function ($query) {
            $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) {
                $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) {
                $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) {
                $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) {
                $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->when(request('price'), function ($query) {
                if (request('price') == 'desc') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderByDesc('price');
                } else if (request('price') == 'asc') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderBy('price');
                }
            })
            ->when(request('sort_name'),function($query) {
                if (request('sort_name') == 'sort_name') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderBy('manufacturer_id');
                }
            })
            ->when(request('engine_power'),function($query) {
                if (request('engine_power') == 'engine_power') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderByDesc('engine_power');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == 'latest_year') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderByDesc('year');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == 'latest_year_old') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderBy('year');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == 'post_old') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderBy('created_at');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == 'post_new') {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->orderByDesc('created_at');
                }
            })
            ->when(request('condition_status'),function($query) {
                    $query->Where('purpose','=',GeneralType::PURPOSE_BUY)->where('condition', 'like', '%' . request('condition_status') . '%');
                
            })
            ->where('purpose','=',GeneralType::PURPOSE_BUY)
            ->where('is_published','=',GeneralType::IS_PUBLISHED)
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('buys.latest', compact('posts', 'manufacturers', 'build_types', 'profile_image', 'users'));
    }
}