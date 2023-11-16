<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\BuildType;
use App\Models\ProfileImage;
use App\Models\User;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\PlateDivision;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;

class BuyPostController extends Controller
{
    public function index(Request $request)
    {

        $manufacturers = Manufacturer::all();
        $build_types = BuildType::all();
        $profile_image = ProfileImage::all();
        $users = User::all();

        if (request('multi_manufacturer_id')) {

            $posts = Post::when(request('car_status'), function ($query) {
                if (request('multi_manufacturer_id')) {

                    if (request('mileage_min')) {
                        
                        $mileage_min = request('mileage_min');
                    } else {
                        $mileage_min = '0';
                    }

                    if (request('mileage_max')) {
                        $mileage_max = request('mileage_max');

                    } else {
                        $mileage_max = '300000';
                    }

                    if (request('min_year')) {
                        $min_year = request('min_year');

                    } else {
                        $min_year = '2000';
                    }


                    if (request('max_year')) {
                        $max_year = request('max_year') + 1;

                    } else {
                        $max_year = ((now()->year) + 1);
                    }

                    if (request('min_price')) {
                        $min_price = request('min_price');

                    } else {
                        $min_price = '100';
                    }

                    if (request('max_price')) {
                        $max_price = request('max_price');

                    } else {
                        $max_price = '20000';
                    }

                    $order = 'manufacturer_id';
                    $orderBy = 'dec';
                    if (request('price') == 'desc') {
                        $order = 'price';
                    }
                    if (request('price') == 'asc') {
                        $order = 'price';
                        $orderBy = 'asc';
                    }
                    if (request('engine_power') == 'high-low') {
                        $order = 'engine_power';
                    }
                    if (request('engine_power') == 'low-high') {
                        $order = 'engine_power';
                        $orderBy = 'asc';
                    }

                    if (request('latest_year') == 'latest_year') {
                        $order = 'year';
                    }

                    if (request('latest_year') == 'latest_year_old') {
                        $order = 'year';
                        $orderBy = 'asc';
                    }

                    if (request('post_status') == 'post_old') {
                        $order = 'created_at';
                        $orderBy = 'asc';
                    }

                    if (request('post_status') == 'post_new') {
                        $order = 'created_at';
                    }

                    $multi_manufacturer_id = request('multi_manufacturer_id');
                    foreach ($multi_manufacturer_id as $each_id) {
                        if ($orderBy == 'dec') {
                            if (request('car_model')) {
                                $model = request('car_model');


                                if (request('condition_status')) {
                                    $check_condition = request('condition_status');
                                    if (request('condition_status')[0] == 'Brand_New') {
                                        $check_condition[0] = 'Brand New';
                                    }
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                        ->where('purpose', '=', 'buy')
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
                                if (request('condition_status')) {
                                    $check_condition = request('condition_status');
                                    if (request('condition_status')[0] == 'Brand_New') {
                                        $check_condition[0] = 'Brand New';
                                    }


                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('condition', '=', $car)
                                            ->orderByDesc($order);
                                    }
                                } else {

                                    $check_condition = array("Used", "Brand New");
                                    foreach ($check_condition as $car) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
                                            ->where('mileage', '>', $mileage_min)
                                            ->where('mileage', '<', $mileage_max)
                                            ->where('year', '>', $min_year)
                                            ->where('year', '<', $max_year)
                                            ->where('price', '>', $min_price)
                                            ->where('price', '<', $max_price)
                                            ->where('condition', '=', $car)
                                            ->orderByDesc($order);
                                    }

                                }
                                if (request('fuel_types')) {
                                    $fuels = request('fuel_types');
                                    foreach ($fuels as $fuel) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                } else {
                                    $fuels = array("Petrol", "Diesel", "CNG", "Electric");
                                    foreach ($fuels as $fuel) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                }

                                if (request('steer')) {
                                    $steering = request('steer');
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', 'buy')
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
                                } else {
                                    $steering = 'Left';
                                    $query->orWhere('manufacturer_id', '=', $each_id)
                                        ->where('purpose', '=', 'buy')
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
                                }

                                if (request('transmissions')) {
                                    $trans = request('transmissions');
                                    foreach ($trans as $tran) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                } else {
                                    $transmissions = array("Auto", "Manual", "Semi Auto");
                                    foreach ($transmissions as $tran) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                }

                                if (request('car_colors')) {
                                    $colors = request('car_colors');
                                    foreach ($colors as $color) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                } else {
                                    $colors = array("Black", "Gray", "Gold", "Green", "Red", "Blue", "Brown");
                                    foreach ($colors as $color) {
                                        $query->orWhere('manufacturer_id', '=', $each_id)
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                        ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                        ->where('purpose', '=', 'buy')
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
                                        ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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
                                            ->where('purpose', '=', 'buy')
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


                ->when((request('car_status') == ''), function ($query) {
                    $query->where('purpose', '=', 'buy')->orderByDesc('purpose');
                })
                ->where('is_published', '=', '1')
                ->orderByDesc('id')
                ->paginate(12)
                ->withQueryString();

            return view('buys.index', compact('posts', 'manufacturers', 'build_types', 'profile_image', 'users'));

        } else {


            // not multi maufacture id 


            $posts = Post::when(request('lot'), function ($query) {
                $query->Where('purpose', '=', 'buy')->where('id', 'like', '%' . request('lot'));
            })
                ->when(request('manufacturer_id'), function ($query) {
                    $query->where('manufacturer_id', request('manufacturer_id'));
                })
                ->when((request('car_status') == 'buy'), function ($query) {
                    $query->where('purpose', '=', 'buy')->orderByDesc('purpose');
                })

                // ->when(request('build_type_id'), function ($query) {
                //     $query->where('build_type_id', request('build_type_id'));
                // })
                // ->when(request('condition'), function ($query) {
                //     $query->where('condition', 'like', '%' . request('condition') . '%');
                // })
                ->when(request('price'), function ($query) {
                    if (request('price') == 'desc') {
                        $query->orderByDesc('price');
                    } else if (request('price') == 'asc') {
                        $query->orderBy('price');
                    }
                })
                ->when(request('sort_name'), function ($query) {
                    if (request('sort_name') == 'sort_name') {
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
                    if (request('engine_power') == 'high-low') {
                        $query->orderByDesc('engine_power');
                    }
                })
                ->when(request('engine_power'), function ($query) {
                    if (request('engine_power') == 'low-high') {
                        $query->orderBy('engine_power');
                    }
                })
                ->when(request('latest_year'), function ($query) {
                    if (request('latest_year') == 'latest_year') {
                        $query->orderByDesc('year');
                    } else if (request('latest_year') == 'latest_year_old') {
                        $query->orderBy('year');
                    }
                })
                ->when(request('post_status'), function ($query) {
                    if (request('post_status') == 'post_old') {
                        $query->orderBy('created_at');
                    } else if (request('post_status') == 'post_new') {
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
                    if (request('steer') == 'Left') {
                        $query->where('steering_position', '=', 'Left');
                    } else if (request('steer') == 'Right') {
                        $query->where('steering_position', '=', 'Right');
                    }
                })



                ->when(request('car_model'), function ($query) {
                    $query->where('car_model', '=', request('car_model'));
                })
                ->when(request('condition_status'), function ($query) {
                    $check_condition = request('condition_status');
                    if (request('condition_status')[0] == 'Brand_New') {
                        $check_condition[0] = 'Brand New';
                    }

                    if (isset($check_condition[1])) {

                    } else if (isset($check_condition[0]) == null) {

                    } else if (($check_condition[0]) == "Brand New") {
                        $query->where('condition', '=', 'Brand New');
                    } else if ((($check_condition[0]) == "Used")) {
                        $query->where('condition', '=', 'Used');
                    }


                })


                ->when((request('car_status') == ''), function ($query) {
                    $query->where('purpose', '=', 'buy')->orderByDesc('created_at');
                })
                ->where('is_published', '=', '1')
                ->orderByDesc('id')
                ->paginate(12)
                ->withQueryString();



            return view('buys.index', compact('posts', 'manufacturers', 'build_types', 'profile_image', 'users'));
        }
    }

    public function create()
    {

        $manufacturers = Manufacturer::all();
        $build_types = BuildType::all();
        $plate_divisions = PlateDivision::all();

        return view('buys.create', compact('manufacturers', 'build_types', 'plate_divisions'));
    }
    public function store(PostStoreRequest $request)
    {
        //Create New Post
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->manufacturer_id = $request->manufacturer_id;
        $post->purpose = "buy";
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

        // Image Create 
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {

                $filename = date('YmdHi') . $file->getClientOriginalName();

                $dir = 'upload/images/' . $post->id;

                $image = new Image();

                $image->post_id = $post->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);
                $file->move(public_path('upload/images/' . $post->id), $filename);
                $image->save();
            }
        }

        return redirect(route('buy.post.show', $post->id));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $manufacturers = Manufacturer::all();
        $build_types = BuildType::all();
        $plate_divisions = PlateDivision::all();

        if ((($post->is_published == 1 && $post->purpose == 'buy') || ($post->is_published == 0 && $post->purpose == 'buy')) && $post->user_id == Auth::user()->id) {
            return view('buys.edit', compact('post', 'manufacturers', 'build_types', 'plate_divisions'));
        }

        abort(403);

    }
    public function update(PostUpdateRequest $request, $id)
    {
        //Delete Selected Images
        if ($request->undeletedFiles) {
            $images = Image::whereNotIn('id', $request->undeletedFiles)
                ->where('post_id', $id)
                ->get();
            foreach ($images as $image) {

                Storage::delete($image->path . '/' . $image->name);
                Image::where('id', $image->id)->delete();
            }
        } else {
            // $images = Image::where('post_id', $id)->delete();
            $images = Image::where('post_id', $id)->get();
            foreach ($images as $image) {
                Storage::delete($image->path . '/' . $image->name);
                Image::where('post_id', $id)->delete();
            }
        }

        $post = Post::find($id);

        $post->manufacturer_id = $request->manufacturer_id;
        $post->condition = $request->condition;
        $post->purpose = "buy";
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
        $post->published_at = now();
        $post->updated_at = now();


        $post->save();

        // New Imcoming Image Added
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {

                $filename = date('YmdHi') . $file->getClientOriginalName();

                $dir = 'upload/images/' . $post->id;

                $image = new Image();

                $image->post_id = $post->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);
                $file = $file->move(public_path('upload/images/' . $post->id), $filename);
                $image->save();
            }
        }

        return redirect(route('buy.post.show', $post->id));
    }

    public function show($id)
    {
        $post = Post::find($id);

        $profile_image = ProfileImage::all();

        $userbuy = User::all();
        $users = User::all();

        if (!empty($post) && Auth::user()) {
            $similar_posts = Post::where('manufacturer_id', '=', $post->manufacturer_id)
                ->where('purpose', '=', 'buy')
                ->orWhere('condition', '=', $post->condition)
                ->orWhere('build_type_id', '=', $post->build_type_id)
                ->limit(15)
                ->get();

            if (($post->is_published == 1 && $post->purpose == 'buy') || ($post->is_published == 0 && $post->purpose == 'buy') && $post->user_id == Auth::user()->id) {
                return view('buys.show', compact('post', 'similar_posts', 'profile_image', 'userbuy', 'users'));
            }
        } elseif (!empty($post) && !Auth::user()) {
            $similar_posts = Post::where('manufacturer_id', '=', $post->manufacturer_id)
                ->where('purpose', '=', 'buy')
                ->orWhere('condition', '=', $post->condition)
                ->orWhere('build_type_id', '=', $post->build_type_id)
                ->limit(15)
                ->get();

            if (($post->is_published == 1 && $post->purpose == 'buy')) {
                return view('buys.show', compact('post', 'similar_posts', 'profile_image', 'userbuy', 'users'));
            }
            abort(404);
        }
        elseif(empty($post)){
            abort(404);
        }
        abort(404);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->images()->exists()) {
            Storage::deleteDirectory($post->images[0]->path);
        }

        $post->delete();

        return redirect(route('buy.post.index'));
    }
}