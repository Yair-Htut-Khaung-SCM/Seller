@extends('layouts.app')

@section('title','Post Lists')

@section('content')
<main class="container">
    <header class="my-4">
        <div class="row">
            <div class="col-12 col-md-8">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('home') }}</a></li>                    
                        <li class="breadcrumb-item active" aria-current="page">{{ __('sale_post') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-4">
                <form class="d-flex" action="{{ route('sale.post.index') }}" method="get">
                    <input class="form-control me-2" name="car_model" type="search" placeholder="{{ __('Search By Model') }}">
                    <button type="submit" class="btn button fw-bolder" style="width:150px;"><i class="fa-solid fa-magnifying-glass me-2"></i>{{ __('search') }}</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Post List -->
    <div class="bg-light rounded mt-3 mb-5 p-4">
        <div class="d-flex justify-content-end mb-2">
            <div class="col-11">
                @if( request()->fullUrl()==route('sale.post.index') )
                <h4>{{ __('latest_upload') }}</h4>
                @else
                <h5 class="text-black"><span class="text-muted"><i class="fa-solid fa-filter me-1" style="color:#12ca8a"></i>Showing Search Result : </span>
                </h5>
                @endif
            </div>
            <div class="col-1 ">
                <div class="btn-group float-end">
                    <button type="button" class="btn button fw-bolder dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(request('price') == 'desc')
                        {{ __('Highest Price') }}
                        @elseif(request('price') == 'asc')
                        {{ __('Lowest Price') }}
    
                        @elseif(request('engine_power') == 'high-low')
                        {{ __('Highest Engine Power') }}
                        @elseif(request('engine_power') == 'low-high')
                        {{ __('Lowest Engine Power') }}
    
                        @elseif(request('latest_year') == 'latest_year')
                        {{ __('Latest Year') }}
                        @elseif(request('latest_year') == 'latest_year_old')
    
                        {{ __('Oldest Year') }}
    
                        @elseif(request('post_status') == 'post_old')
                        {{ __('Firstest Posts') }}
                        @elseif(request('post_status') == 'post_new')
                        {{ __('Latest Posts') }}
                        @else
                        {{ __('Latest Posts') }}
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('sale.post.index') }}">
                                
                                 @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif

                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="price" value='desc'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Price : High - Low') }}</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">
                                
                                 @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="price" value='asc'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Price : Low - High') }}</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">

                                @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="engine_power" value='high-low'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Engine : High - Low') }} </button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">

                                 @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="engine_power" value='low-high'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Engine : Low - High') }}</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">

                                @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="latest_year" value='latest_year'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Year : High - Low') }}</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">

                                @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="latest_year" value='latest_year_old'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Year : Low - High') }}</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">

                                @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="post_status" value='post_new'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Latest Posts') }}</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('sale.post.index') }}">

                                @if( request('multi_manufacturer_id') )
                                @php($manufacturers_car = request('multi_manufacturer_id'))
                                @foreach($manufacturers_car as $manufacturer)
                                <input type="hidden" name="multi_manufacturer_id[]" value={{ $manufacturer}}>
                                @endforeach
                                @endif
                                @if( request('condition_status') )
                                @php($allitems = request('condition_status'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="condition_status[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('mileage_min') )
                                <input type="hidden" name="mileage_min" value={{ request('mileage_min')}}>
                                 @endif
                                 @if( request('mileage_max') )
                                 <input type="hidden" name="mileage_max" value={{ request('mileage_max')}}>
                                  @endif
                                @if( request('min_year') )
                                <input type="hidden" name="min_year" value={{ request('min_year')}}>
                                @endif
                                @if( request('max_year') )
                                <input type="hidden" name="max_year" value={{ request('max_year')}}>
                                @endif
                                @if( request('min_price') )
                                <input type="hidden" name="min_price" value={{ request('min_price')}}>
                                @endif
                                @if( request('max_price') )
                                <input type="hidden" name="max_price" value={{ request('max_price')}}>
                                @endif
                                @if( request('fuel_types') )
                                @php($allitems = request('fuel_types'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="fuel_types[]" value={{ $eachitem}}>
                                @endforeach                               
                                 @endif
                                @if( request('steer') )
                                <input type="hidden" name="steer" value={{ request('steer')}}>
                                @endif
                                @if( request('transmissions') )
                                @php($allitems = request('transmissions'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="transmissions[]" value={{ $eachitem}}>
                                @endforeach                               
                                @endif
                                @if( request('color_cars') )
                                @php($allitems = request('color_cars'))
                                @foreach($allitems as $eachitem)
                                <input type="hidden" name="color_cars[]" value={{ $eachitem}}>
                                @endforeach                                 
                                @endif
                                @if( request('lot') )
                                <input type="hidden" name="lot" value={{request('lot')}}>
                                @endif
                                @if( request('manufacturer_id') )
                                <input type="hidden" name="manufacturer_id" value={{request('manufacturer_id')}}>
                                @endif
                                @if( request('car_model') )
                                <input type="hidden" name="car_model" value={{request('car_model')}}>
                                @endif
                                @if( request('build_type_id') )
                                <input type="hidden" name="build_type_id" value={{request('build_type_id')}}>
                                @endif
                                @if( request('condition') )
                                <input type="hidden" name="condition" value={{request('condition')}}>
                                @endif
                                <input type="hidden" name="post_status" value='post_old'>
                                <input type="hidden" name="car_status" value="sale">
                                <button class="dropdown-item" type="submit">{{ __('Firstest Posts')}}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <h5 class="text-black mb-2">
            {{--{{ request('lot') ? request('lot') : null }}
            <span class="result" style="color:rgb(97, 213, 136); background:none; padding:0px;">
                {{ request('manufacturer_id') ? $manufacturers[request('manufacturer_id')-1]->name : null }}
            </span>--}}


            <span class="result" style="background-color:#198754;">
                
            @if(request('price') == 'desc')
            {{ __('Sort By : Highest Price') }}
            @elseif(request('price') == 'asc')
            {{ __('Sort By : Lowest Price') }}

            @elseif(request('engine_power') == 'high-low')
            {{ __('Sort By : Highest Engine Power') }}
            @elseif(request('engine_power') == 'low-high')
            {{ __('Sort By : Lowest Engine Power') }}

            @elseif(request('latest_year') == 'latest_year')
            {{ __('Sort By : Latest Year') }}
            @elseif(request('latest_year') == 'latest_year_old')

            {{ __('Sort By : Oldest Year') }}

            @elseif(request('post_status') == 'post_old')
            {{ __('Sort By : Firstest Posts') }}
            @elseif(request('post_status') == 'post_new')
            {{ __('Sort By : Latest Posts') }}
            @else
            {{ __('Sorted By : Latest Posts') }}
            @endif
            </span>



            @if(request('car_model'))
            <span class="result" style="background-color:#198754;">{{ __('Model - ') }} 
            {{request('car_model')}}
            </span>
            @else
            <span class="result" style="background-color:#198754;">{{ __('Model - All Type') }}
            </span>
            @endif

            {{--<span class="result" style="color:rgb(97, 213, 136); background:none; padding:0px;">
                {{ request('build_type_id') ? $build_types[request('build_type_id')-1]->name : null }}
            </span>
            <span class="result" style="color:rgb(97, 213, 136); background:none; padding:0px;">
                {{ request('condition') ? request('condition') : null }}
            </span>--}}
            @if( request('multi_manufacturer_id') )
            @php($manufacturers_car = request('multi_manufacturer_id'))
            @foreach ($manufacturers_car as $all_manu)
            <span class="result">{{ __('Manufacturer - ') }}{{ $manufacturers[($all_manu)-1]->name }}</span>
            @endforeach
            @else <span class="result">{{ __('Manufacturer - All Type') }}</span>
            @endif

            
            @if( request('condition_status') )
            @php($allitems = request('condition_status'))
            @foreach($allitems as $eachitem)
            <span class="result" style="background-color:rgb(97, 213, 136);">{{ $eachitem}}</span>
            @endforeach                               
             @endif

             @if( request('mileage_min') )
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Min Mileage') }} - {{ request('mileage_min')}}</span>
              @endif
              @if( request('mileage_max') )
              <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Max Mileage') }} - {{ request('mileage_max')}}</span>
               @endif
             @if( request('min_year') )
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Min Year') }} - {{ request('min_year')}}</span>
             @endif
             @if( request('max_year') )
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Max Year') }} - {{ request('max_year')}}</span>
             @endif
             @if( request('min_price') )
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Min Price') }} - {{ request('min_price')}}</span>
             @endif
             @if( request('max_price') )
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Max Price') }} - {{ request('max_price')}}</span>
             @endif
             @if( request('fuel_types') )
             @php($allitems = request('fuel_types'))
             @foreach($allitems as $eachitem)
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Fuel Types') }} - {{ $eachitem}}</span>
             @endforeach                               
              @endif
             @if( request('steer') )
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Steer') }} - {{ request('steer')}}</span>
             @endif
             @if( request('transmissions') )
             @php($allitems = request('transmissions'))
             @foreach($allitems as $eachitem)
             <span class="result" style="background-color:rgb(97, 213, 136);">{{ __('Transmission') }} - {{ $eachitem}}</span>
             @endforeach                               
             @endif
             @if( request('color_cars') )
             @php($allitems = request('color_cars'))
             @foreach($allitems as $eachitem)
             <span class="result" style="background-color:rgb(97, 213, 136);">Color - {{ $eachitem}}</span>
             @endforeach                                 
             @endif



        </h5>

        @if($posts->count())

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3  row-cols-xl-3 g-4">
            <!-- Columns --->
            @foreach($posts as $post)
            <div class="mb-2">
                {{--@include('components.card')--}}
                <x-card_lg purpose="sale" :route="route('sale.post.show', $post->id)" saleProfile="sale" :$post :$users :$profile_image/>
            </div>
            @endforeach
            <!-- End Columns --->
        </div>
        <div class=" mt-4 d-flex" style="width: 100%; margin:auto;">
            {{ $posts->links('cpag.custom') }}
        </div>
        @else
        <div class="d-grid col">
            <br>
            <img src="/images/errors/not_found.png" class="mx-auto" style="width:150px;" alt="Not Found Image">
            <b class="mx-auto">Sorry, the cars you're searching is not Available currently.</b>
            <p class="mx-auto">Please, try again Later.</p>
            <div class="d-flex p-2 mx-auto">
                <a href="/">
                    <img href="" src="\images\errors\previous.png" style="width:40px;" alt="Prev Arrow">
                </a>
                <p class="mt-2 ms-2">Back Home</p>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection