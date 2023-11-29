<?php

namespace App\Dao\Admin;


use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Enums\GeneralType;

class PostDao
{

    public function getDetail($purpose)
    {
        return Post::Where('purpose','=',$purpose)->paginate(10);
    }

    public function getCount($purpose = null)
    {
       return $purpose ? Post::Where('purpose', '=', $purpose)->count() : Post::count();
    }

    public function getAll()
    {
        $post = Post::get()->toArray();
        return $post;
    }

    public function getPostById($id)
    {
        $post = Post::find($id);
        return $post;
    }

    public function getPostCountByBuildTypeId($build_type_id)
    {
        return Post::where('build_type_id', $build_type_id)->get()->count();
    }

    public function getPostCountByManufacturerId($manufacturer_id)
    {
        return Post::where('manufacturer_id', $manufacturer_id)->get()->count();
    }

    public function getPostCountByPlateDivisionId($plate_division_id = null)
    {
        return Post::where('plate_division_id', $plate_division_id)->get()->count();
    }

    public function getBrandNewPost($request, $purpose)
    {
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
                if (request('sort_name') == GeneralType::SORT_NAME) {
                    $query->orderBy('manufacturer_id');
                }
            })
            ->when(request('engine_power'),function($query) {
                if (request('engine_power') == GeneralType::ENGINE_POWER) {
                    $query->orderByDesc('engine_power');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == GeneralType::LATEST_YEAR) {
                    $query->orderByDesc('year');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == GeneralType::LATEST_YEAR_OLD) {
                    $query->orderBy('year');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == GeneralType::POST_OLD) {
                    $query->orderBy('created_at');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == GeneralType::POST_NEW) {
                    $query->orderByDesc('created_at');
                }
            })
            ->when(request('condition_status'),function($query) {
                    $query->where('condition', 'like', '%' . request('condition_status') . '%');
                
            })
            ->where('purpose','=', $purpose)
            ->where('condition','=',GeneralType::CAR_CONDITION[0])
            ->where('is_published','=', GeneralType::IS_PUBLISHED)
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return $posts;
    } 

    public function getBuildTypePost($request, $purpose)
    {
        $posts = Post::when(request('lot'), function ($query) {
            $query->Where('purpose','=','buy')->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) {
                $query->Where('purpose','=','buy')->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) {
                $query->Where('purpose','=','buy')->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) {
                $query->Where('purpose','=','buy')->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) {
                $query->Where('purpose','=','buy')->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->when(request('price'), function ($query) {
                if (request('price') == 'desc') {
                    $query->Where('purpose','=','buy')->orderByDesc('price');
                } else if (request('price') == 'asc') {
                    $query->Where('purpose','=','buy')->orderBy('price');
                }
            })
            ->when(request('sort_name'),function($query) {
                if (request('sort_name') == GeneralType::SORT_NAME) {
                    $query->Where('purpose','=','buy')->orderBy('manufacturer_id');
                }
            })
            ->when(request('engine_power'),function($query) {
                if (request('engine_power') == GeneralType::ENGINE_POWER) {
                    $query->Where('purpose','=','buy')->orderByDesc('engine_power');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == GeneralType::LATEST_YEAR) {
                    $query->Where('purpose','=','buy')->orderByDesc('year');
                }
            })
            ->when(request('latest_year'),function($query) {
                if (request('latest_year') == GeneralType::LATEST_YEAR_OLD) {
                    $query->Where('purpose','=','buy')->orderBy('year');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == GeneralType::POST_OLD) {
                    $query->Where('purpose','=','buy')->orderBy('created_at');
                }
            })
            ->when(request('post_status'),function($query) {
                if (request('post_status') == GeneralType::POST_NEW) {
                    $query->Where('purpose','=','buy')->orderByDesc('created_at');
                }
            })
            ->when(request('build_type_id'),function($query) {
                if (request('build_type_id') == GeneralType::BUILD_TYPE_ID) {
                    $query->Where('purpose','=','buy')->orderBy('created_at');
                }
            })
            ->when(request('condition_status'),function($query) {
                    $query->Where('purpose','=','buy')->where('condition', 'like', '%' . request('condition_status') . '%');
                
            })
            ->where('purpose','=',$purpose)
            ->where('is_published','=', GeneralType::IS_PUBLISHED)
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return $posts;
    }

    public function getManufauturerPost($request, $purpose)
    {
        $posts = Post::when(request('lot'), function ($query) use ($purpose) {
            $query->Where('purpose','=', $purpose)->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) use ($purpose){
                $query->Where('purpose','=',$purpose)->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->when(request('price'), function ($query) use ($purpose) {
                if (request('price') == 'desc') {
                    $query->Where('purpose','=',$purpose)->orderByDesc('price');
                } else if (request('price') == 'asc') {
                    $query->Where('purpose','=',$purpose)->orderBy('price');
                }
            })
            ->when(request('sort_name'),function($query) use ($purpose) {
                if (request('sort_name') == GeneralType::SORT_NAME) {
                    $query->Where('purpose','=',$purpose)->orderBy('manufacturer_id');
                }
            })
            ->when(request('engine_power'),function($query) use ($purpose) {
                if (request('engine_power') == GeneralType::ENGINE_POWER) {
                    $query->Where('purpose','=',$purpose)->orderByDesc('engine_power');
                }
            })
            ->when(request('latest_year'),function($query) use ($purpose) {
                if (request('latest_year') == GeneralType::LATEST_YEAR) {
                    $query->Where('purpose','=',$purpose)->orderByDesc('year');
                }
            })
            ->when(request('latest_year'),function($query) use ($purpose) {
                if (request('latest_year') == GeneralType::LATEST_YEAR_OLD) {
                    $query->Where('purpose','=',$purpose)->orderBy('year');
                }
            })
            ->when(request('post_status'),function($query) use ($purpose) {
                if (request('post_status') == GeneralType::POST_OLD) {
                    $query->Where('purpose','=',$purpose)->orderBy('created_at');
                }
            })
            ->when(request('post_status'),function($query) use ($purpose) {
                if (request('post_status') == GeneralType::POST_NEW) {
                    $query->Where('purpose','=',$purpose)->orderByDesc('created_at');
                }
            })
            ->when(request('build_type_id'),function($query) use ($purpose) {
                if (request('build_type_id') == 'build_type_id') {
                    $query->Where('purpose','=',$purpose)->orderBy('created_at');
                }
            })
            ->when(request('condition_status'),function($query) use ($purpose) {
                    $query->Where('purpose','=',$purpose)->where('condition', 'like', '%' . request('condition_status') . '%');
                
            })
            ->where('purpose','=',$purpose)
            ->where('is_published','=',GeneralType::IS_PUBLISHED)
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return $posts;
    }

    public function getPost($request, $purpose)
    {
        if (request('multi_manufacturer_id')) {
            $posts = Post::when(request('car_status'), function ($query) use($purpose) {
                if (request('multi_manufacturer_id')) {

                    if (request('mileage_min')) {
                        
                        $mileage_min = request('mileage_min');
                    } else {
                        $mileage_min = GeneralType::DEFAULT_MILEAGE_MIN;
                    }

                    if (request('mileage_max')) {
                        $mileage_max = request('mileage_max');

                    } else {
                        $mileage_max = GeneralType::DEFAULT_MILEAGE_MAX;
                    }

                    if (request('min_year')) {
                        $min_year = request('min_year');

                    } else {
                        $min_year = GeneralType::DEFAULT_MIN_YEAR;
                    }


                    if (request('max_year')) {
                        $max_year = request('max_year') + 1;

                    } else {
                        $max_year = ((now()->year) + 1);
                    }

                    if (request('min_price')) {
                        $min_price = request('min_price');

                    } else {
                        $min_price = GeneralType::DEFAULT_MIN_PRICE;
                    }

                    if (request('max_price')) {
                        $max_price = request('max_price');

                    } else {
                        $max_price = GeneralType::DEFAULT_MAX_PRICE;
                    }

                    $order = 'manufacturer_id';
                    $orderBy = 'dec';
                    if (request('price') == 'desc') {
                        $order = GeneralType::PRICE;
                    }
                    if (request('price') == 'asc') {
                        $order = GeneralType::PRICE;
                        $orderBy = 'asc';
                    }
                    if (request('engine_power') == GeneralType::EP_HIGH_LOW) {
                        $order = GeneralType::ENGINE_POWER;
                    }
                    if (request('engine_power') == GeneralType::EP_LOW_HIGH) {
                        $order = GeneralType::ENGINE_POWER;
                        $orderBy = 'asc';
                    }

                    if (request('latest_year') == GeneralType::LATEST_YEAR) {
                        $order = 'year';
                    }

                    if (request('latest_year') == GeneralType::LATEST_YEAR_OLD) {
                        $order = 'year';
                        $orderBy = 'asc';
                    }

                    if (request('post_status') == GeneralType::POST_OLD) {
                        $order = 'created_at';
                        $orderBy = 'asc';
                    }

                    if (request('post_status') == GeneralType::POST_NEW) {
                        $order = 'created_at';
                    }

                    $multi_manufacturer_id = request('multi_manufacturer_id');
                    foreach ($multi_manufacturer_id as $each_id) {
                        if ($orderBy == 'dec') {
                            if (request('car_model')) {
                                $model = request('car_model');

                                if (request('condition_status')) {
                                    $check_condition = request('condition_status');
                                    if (request('condition_status')[0] == GeneralType::CAR_CONDITION[0]) {
                                        $check_condition[0] = GeneralType::CAR_CONDITION[0];
                                    }
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('car_model', '=', $model)
                                            ->where('condition', '=', $car)
                                            ->orderByDesc($order);
                                    }
                                } else {
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('car_model', '=', $model)
                                        ->orderByDesc($order);
                                }

                            } else {
                                //else for car_model
                                $check_condition = GeneralType::CAR_CONDITION;
                                if (request('condition_status')) {
                                    $check_condition = request('condition_status');
                                    if (request('condition_status')[0] == 'Brand_New') {
                                        $check_condition[0] = GeneralType::CAR_CONDITION[0];
                                    }
                                }
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('condition', '=', $car)
                                            ->orderByDesc($order);
                                    }
                                
                                $fuels = request('fuel_types') ? request('fuel_types') : GeneralType::FUELS;
                                foreach ($fuels as $fuel) {
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('fuel_type', '=', $fuel)
                                        ->where('condition', '=', $car)
                                        ->orderByDesc($order);
                                }
                                $steering = request('steer') ? request('steer') : GeneralType::STEERING_LEFT;
                                $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('steering_position', '=', $steering)
                                        ->where('fuel_type', '=', $fuel)
                                        ->where('condition', '=', $car)
                                        ->orderByDesc($order);
                                $transmissions = request('transmissions') ? request('transmissions') : GeneralType::TRANSMISSIONS;
                                foreach ($transmissions as $tran) {
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('transmission', '=', $tran)
                                        ->where('steering_position', '=', $steering)
                                        ->where('fuel_type', '=', $fuel)
                                        ->where('condition', '=', $car)
                                        ->orderByDesc($order);
                                }
                                $colors = request('car_colors') ? request('car_colors') : GeneralType::COLORS;
                                foreach ($colors as $color) {
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('color', '=', $color)
                                        ->where('transmission', '=', $tran)
                                        ->where('steering_position', '=', $steering)
                                        ->where('fuel_type', '=', $fuel)
                                        ->where('condition', '=', $car)
                                        ->orderByDesc($order);
                                }

                            }
                        } else if ($orderBy == 'asc') {

                            // for asc 
                            if (request('car_model')) {
                                $model = request('car_model');


                                if (request('condition_status')) {
                                    $check_condition = request('condition_status');
                                    if (request('condition_status')[0] == 'Brand_New') {
                                        $check_condition[0] = 'Brand New';
                                    }
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('car_model', '=', $model)
                                            ->orderBy($order);
                                    }
                                } else {

                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('car_model', '=', $model)
                                        ->orderBy($order);
                                }


                            } else {
                                //else for car_model
                                if (request('condition_status')) {
                                    $check_condition = request('condition_status');
                                    if (request('condition_status')[0] == 'Brand_New') {
                                        $check_condition[0] = 'Brand New';
                                    }
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                } else {
                                    $check_condition = array("Used", "Brand New");
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }

                                    

                                }
                                //
                                if (request('fuel_types')) {
                                    $fuels = request('fuel_types');
                                    foreach ($fuels as $fuel) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('fuel_type', '=', $fuel)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                } else {
                                    $fuels = array("Petrol", "Diesel", "CNG", "Electric");
                                    foreach ($fuels as $fuel) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('fuel_type', '=', $fuel)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                }

                                if (request('steer')) {
                                    $steering = request('steer');
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('steering_position', '=', $steering)
                                        ->where('fuel_type', '=', $fuel)
                                        ->where('condition', '=', $car)
                                        ->orderBy($order);
                                } else {
                                    $steering = 'Left';
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', $purpose)
                                        ->where('mileage', '>', $mileage_min)
                                        ->where('mileage', '<', $mileage_max)
                                        ->where('year', '>', $min_year)
                                        ->where('year', '<', $max_year)
                                        ->where('price', '>', $min_price)
                                        ->where('price', '<', $max_price)
                                        ->where('steering_position', '=', $steering)
                                        ->where('fuel_type', '=', $fuel)
                                        ->where('condition', '=', $car)
                                        ->orderBy($order);
                                }

                                if (request('transmissions')) {
                                    $trans = request('transmissions');
                                    foreach ($trans as $tran) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('transmission', '=', $tran)
                                            ->where('steering_position', '=', $steering)
                                            ->where('fuel_type', '=', $fuel)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                } else {
                                    $transmissions = array("Auto", "Manual", "Semi Auto");
                                    foreach ($transmissions as $tran) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('transmission', '=', $tran)
                                            ->where('steering_position', '=', $steering)
                                            ->where('fuel_type', '=', $fuel)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                }

                                if (request('car_colors')) {
                                    $colors = request('car_colors');
                                    foreach ($colors as $color) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('color', '=', $color)
                                            ->where('transmission', '=', $tran)
                                            ->where('steering_position', '=', $steering)
                                            ->where('fuel_type', '=', $fuel)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                } else {
                                    $colors = array("Black", "Gray", "Gold", "Green", "Red", "Blue", "Brown");
                                    foreach ($colors as $color) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', $purpose)
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('color', '=', $color)
                                            ->where('transmission', '=', $tran)
                                            ->where('steering_position', '=', $steering)
                                            ->where('fuel_type', '=', $fuel)
                                            ->where('condition', '=', $car)
                                            ->orderBy($order);
                                    }
                                }

                            }
                            // foreach end 
                        }

                    }

                }

            })

                ->when(request('post_status'), function ($query) {
                    if (request('post_status') == 'post_old') {
                        $query->orderBy('created_at');
                    }
                })

                ->when((request('multi_manufacturer_id') == null), function ($query) {
                    $query->orderByDesc('id');
                })


                ->when((request('car_status') == ''), function ($query)  use($purpose) {
                    $query->where('purpose', '=', $purpose)->orderByDesc('purpose');
                })
                ->where('is_published', '=', '1')
                ->orderByDesc('id')
                ->paginate(12)
                ->withQueryString();

        } else {
            //non multi
            $posts = Post::when(request('lot'), function ($query) use($purpose) {
                $query->Where('purpose', '=', $purpose)->where('id', 'like', '%' . request('lot'));
            })
                ->when(request('manufacturer_id'), function ($query){
                    $query->where('manufacturer_id', request('manufacturer_id'));
                })
                ->when((request('car_status') == $purpose), function ($query) use($purpose) {
                    $query->where('purpose', '=', $purpose)->orderByDesc('purpose');
                })

                ->when(request('price'), function ($query) {
                    if (request('price') == 'desc') {
                        $query->orderByDesc('price');
                    } else if (request('price') == 'asc') {
                        $query->orderBy('price');
                    }
                })
                ->when(request('sort_name'), function ($query) {
                    if (request('sort_name') == GeneralType::SORT_NAME) {
                        $query->orderBy('manufacturer_id');
                    }
                })
                ->when(request('engine_min'), function ($query) {
                    $query->where('engine_power', '>', request('engine_min'))->orderBy('engine_power');
                })
                ->when(request('engine_max'), function ($query) {
                    $query->where('engine_power', '<', request('engine_max'))->orderBy('engine_power');
                })
                ->when(request('engine_power'), function ($query) {
                    if (request('engine_power') == GeneralType::EP_HIGH_LOW) {
                        $query->orderByDesc('engine_power');
                    }
                })
                ->when(request('engine_power'), function ($query) {
                    if (request('engine_power') == GeneralType::EP_LOW_HIGH) {
                        $query->orderBy('engine_power');
                    }
                })
                ->when(request('latest_year'), function ($query) {
                    if (request('latest_year') == GeneralType::LATEST_YEAR) {
                        $query->orderByDesc('year');
                    } else if (request('latest_year') == GeneralType::LATEST_YEAR_OLD) {
                        $query->orderBy('year');
                    }
                })
                ->when(request('post_status'), function ($query) {
                    if (request('post_status') == GeneralType::POST_OLD) {
                        $query->orderBy('created_at');
                    } else if (request('post_status') == GeneralType::POST_NEW) {
                        $query->orderByDesc('created_at');
                    }
                })
                ->when(request('mileage_min'), function ($query) {
                    $query->where('mileage', '>=', request('mileage_min'))->orderByDesc('mileage');
                })
                ->when(request('mileage_max'), function ($query) {
                    $query->where('mileage', '<', request('mileage_max'))->orderByDesc('mileage');
                })
                ->when(request('min_year'), function ($query) {

                    $query->where('year', '>=', request('min_year'))->orderByDesc('year');
                })
                ->when(request('max_year'), function ($query) {
                    $query->where('year', '<', request('max_year'))->orderByDesc('year');
                })
                ->when(request('min_price'), function ($query) {
                    $query->where('price', '>=', request('min_price'))->orderByDesc('price');
                })
                ->when(request('max_price'), function ($query) {
                    $query->where('price', '<', request('max_price'))->orderByDesc('price');
                })
                ->when(request('fuel_types'), function ($query) {
                    $fuel_types = request('fuel_types');
                    foreach ($fuel_types as $fuel_type) {
                        $query->orWhere('fuel_type', '=', $fuel_type)->orderByDesc('fuel_type');
                    }
                })
                ->when(request('transmissions'), function ($query) {
                    $transmissions = request('transmissions');
                    foreach ($transmissions as $transmission) {
                        $query->orWhere('transmission', '=', $transmission)->orderBy('transmission');
                    }
                })
                ->when(request('color_cars'), function ($query) {
                    $color_cars = request('color_cars');
                    foreach ($color_cars as $color_car) {
                        $query->orWhere('color', '=', $color_car)->orderBy('color');
                    }
                })
                ->when(request('steer'), function ($query) {
                    if (request('steer') == GeneralType::STEERING_LEFT) {
                        $query->where('steering_position', '=', GeneralType::STEERING_LEFT);
                    } else if (request('steer') == GeneralType::STEERING_RIGHT) {
                        $query->where('steering_position', '=', GeneralType::STEERING_RIGHT);
                    }
                })

                ->when(request('car_model'), function ($query) {
                    $query->where('car_model', '=', request('car_model'));
                })
                ->when(request('condition_status'), function ($query) {
                    $check_condition = request('condition_status');
                    if (request('condition_status')[0] == 'Brand_New') {
                        $check_condition[0] = GeneralType::CAR_CONDITION[0];
                    }

                    if (isset($check_condition[1])) {

                    } else if (isset($check_condition[0]) == null) {

                    } else if (($check_condition[0]) == GeneralType::CAR_CONDITION[0]) {
                        $query->where('condition', '=', GeneralType::CAR_CONDITION[0]);
                    } else if ((($check_condition[0]) == GeneralType::CAR_CONDITION[1])) {
                        $query->where('condition', '=', GeneralType::CAR_CONDITION[1]);
                    }
                })

                ->when((request('car_status') == ''), function ($query) use ($purpose) {
                    $query->where('purpose', '=', $purpose)->orderByDesc('created_at');
                })
                ->where('is_published', '=', GeneralType::IS_PUBLISHED)
                ->orderByDesc('id')
                ->paginate(12)
                ->withQueryString();
        }

        return $posts;
    }

    public function savePost($request,  $purpose, $id = null)
    {
        $post = $id ?  Post::find($id) : new Post();
        if(!$id)
        {
            $post->user_id = Auth::user()->id;
        }

        $post->manufacturer_id = $request->manufacturer_id;
        $post->purpose = $purpose;
        $post->condition = $request->condition;
        $post->car_model = $request->car_model;
        $post->year = $request->year;
        $post->price = $request->price;
        $post->build_type_id = $request->build_type_id;
        $post->trim_name = $request->trim_name;
        $post->engine_power = $request->engine_power;
        $post->steering_position = $request->steering_position;
        $post->transmission = $request->transmission;
        $post->gear = $request->gear;
        $post->fuel_type = $request->fuel_type;
        $post->color = $request->color;
        $post->vin = $request->vin;
        $post->licence_status = $request->licence_status;
        $post->plate_number = $request->plate_number;
        $post->plate_color = $request->plate_color;
        $post->plate_division_id = $request->plate_division_id;
        $post->seat = $request->seat;
        $post->door = $request->door;
        $post->mileage = $request->mileage;
        $post->owner_count = $request->owner_count;
        $post->description = $request->description;
        $post->phone = $request->phone;
        $post->address = $request->address;
        $post->is_published = $request->publish;
        $post->created_at = now();
        $post->updated_at = now();

        $post->save();
        return $post;
    }

    public function getSimilarPost($post, $purpose) 
    {
        $post = Post::where('manufacturer_id', '=', $post->manufacturer_id)
                ->where('purpose', '=', $purpose)
                ->orWhere('condition', '=', $post->condition)
                ->orWhere('build_type_id', '=', $post->build_type_id)
                ->limit(15)
                ->get();

        return $post;
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return $post;
    }

    public function getPostByPurpose($purpose, $id)
    {
        $post = Post::where('user_id','=',$id)
        ->where('purpose','=',$purpose)->paginate(6);
        return $post;
    }
    
    public function getOtherPostByPurpose($purpose, $id)
    {
        $post =  Post::where('user_id','=',$id)->where('purpose','=',$purpose)->where('is_published','=',GeneralType::IS_PUBLISHED)->paginate(6);
        return $post;
    }

    public function getLatestPost($purpose)
    {
        $posts = Post::when(request('lot'), function ($query) use ($purpose) {
            $query->Where('purpose','=',$purpose)->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) use ($purpose) {
                $query->Where('purpose','=',$purpose)->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->when(request('price'), function ($query) use ($purpose) {
                if (request('price') == 'desc') {
                    $query->Where('purpose','=',$purpose)->orderByDesc('price');
                } else if (request('price') == 'asc') {
                    $query->Where('purpose','=',$purpose)->orderBy('price');
                }
            })
            ->when(request('sort_name'),function($query) use ($purpose) {
                if (request('sort_name') == 'sort_name') {
                    $query->Where('purpose','=',$purpose)->orderBy('manufacturer_id');
                }
            })
            ->when(request('engine_power'),function($query) use ($purpose) {
                if (request('engine_power') == 'engine_power') {
                    $query->Where('purpose','=',$purpose)->orderByDesc('engine_power');
                }
            })
            ->when(request('latest_year'),function($query) use ($purpose) {
                if (request('latest_year') == 'latest_year') {
                    $query->Where('purpose','=',$purpose)->orderByDesc('year');
                }
            })
            ->when(request('latest_year'),function($query) use ($purpose) {
                if (request('latest_year') == 'latest_year_old') {
                    $query->Where('purpose','=',$purpose)->orderBy('year');
                }
            })
            ->when(request('post_status'),function($query) use ($purpose) {
                if (request('post_status') == 'post_old') {
                    $query->Where('purpose','=',$purpose)->orderBy('created_at');
                }
            })
            ->when(request('post_status'),function($query) use ($purpose) {
                if (request('post_status') == 'post_new') {
                    $query->Where('purpose','=',$purpose)->orderByDesc('created_at');
                }
            })
            ->when(request('condition_status'),function($query) use ($purpose) {
                    $query->Where('purpose','=',$purpose)->where('condition', 'like', '%' . request('condition_status') . '%');
                
            })
            ->where('purpose','=',$purpose)
            ->where('is_published','=',GeneralType::IS_PUBLISHED)
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
        
        return $posts;
    }

    public function getPostByStatus($column, $status)
    {
        $post = Post::Where($column, '=', $status)->where('is_published', '=', GeneralType::IS_PUBLISHED)->orderBy("id", "DESC")->limit(12)->get();
        return $post;
    }

}