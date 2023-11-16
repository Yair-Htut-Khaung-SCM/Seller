@section('styles')
<style>
</style>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection
<!-- Filter Modal -->
        <div class="modal modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height: 465px;">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Search')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="filter" value="filter">
                @if( request('multi_manufacturer_id') )
                <input type="hidden" name="multi_manufacturer_id" value="multi_manufacturer_id[]">
                @endif
                @if( request('condition_status') )
                <input type="hidden" name="condition_status" value="condition_status[]">
                @endif
                @if( request('mileage_min') )
                <input type="hidden" name="mileage_min" value="mileage_min">
                @endif
                @if( request('mileage_max') )
                <input type="hidden" name="mileage_max" value="mileage_max">
                @endif
                @if( request('min_year') )
                <input type="hidden" name="min_year" value="min_year">
                @endif
                @if( request('max_year') )
                <input type="hidden" name="max_year" value="max_year">
                @endif
                @if( request('min_price') )
                <input type="hidden" name="min_price" value="min_price">
                @endif
                @if( request('max_price') )
                <input type="hidden" name="max_price" value="max_price">
                @endif
                @if( request('fuel_types') )
                <input type="hidden" name="fuel_types" value="fuel_types[]">
                @endif
                @if( request('steer') )
                <input type="hidden" name="steer" value="steer">
                @endif
                @if( request('transmissions') )
                <input type="hidden" name="transmissions" value="transmissions[]">
                @endif
                @if( request('color_cars') )
                <input type="hidden" name="color_cars" value=" color_cars[]">
                @endif
               
                
                
                <form action="" id="filterForm">

                <div class="modal-body">
                
                
                {{-- tab modal box  --}}

                <div class="tabs" style="display: flex;">
                    <ul id="tabs-nav" class="col-lg-4 col-4">
                      <li><a href="#tab1">{{__('Type')}}</a></li>
                      <li><a href="#tab2">{{__('Manufacture')}}</a></li>
                      <li><a href="#tab3">{{__('Car Condition')}}</a></li>
                      <li><a href="#tab4">{{__('Manufacture Year')}}</a></li>
                      <li><a href="#tab5">{{__('Price')}}</a></li>
                      <li><a href="#tab6">{{__('Fuel Type')}}</a></li>
                      <li><a href="#tab7">{{__('Steering Position')}}</a></li>
                      <li><a href="#tab8">{{__('Transmissions')}}</a></li>
                      <li><a href="#tab9">{{__('Color')}}</a></li>
                    </ul> <!-- END tabs-nav -->
                    <div id="tabs-content" class="col-8" style="background-color: white;">
                        <div id="tab1" class="tab-content" style="display:flex;">
                            <div class="col-12 col-lg-12 col-md-12" style="display:flex;">
                                    <div class="form-check col-3 col-lg-3 col-md-3 col-sm-3 me-2 radio-item">
                                        <input type="radio" id="buy_car" name="car_status" value="buy" class="form-check-input" checked>
                                        <label for="buy_car" class="form-check-label">{{__('Buy')}}</label>
                                    </div>
                                    <div class="form-check col-3 col-lg-3 col-md-3 col-sm-3 me-2 radio-item">
                                        <input type="radio" id="sale_car" name="car_status" value="sale" class="form-check-input" @if( old('car_status')== 'sale') {{ dd('checked'); }} @endif>
                                        <label for="sale_car" class="form-check-label">{{__('Sale')}}</label>      
                                    </div>
                            </div>
                            
                            
                        </div>
                      <div id="tab2" class="tab-content">
                        {{--<div class="multiSelect col-6 col-lg-6 col-md-3 col-sm-2 mt-2">
                            <select multiple class="form-select multiSelect_field select optional" data-placeholder="Select Manufacturer" name="multi_manufacturer_id[]">
                                @foreach($manufacturers as $manufacturer)

                                <option value="{{$manufacturer->id}}" @if( old('manufacturer_id')==$manufacturer->id) {{ 'selected' }} @endif >{{$manufacturer->name}}</option>
                                @endforeach
                            </select>
                        </div>--}}
                        <div class="multiSelect col-6 col-lg-6 col-md-3 col-sm-2 mt-2">	
                            <select id="select-tags" multiple data-placeholder="Select Manufacturers" class="form-control p-0" name="multi_manufacturer_id[]">
                                @foreach($manufacturers as $manufacturer)

                                <option value="{{$manufacturer->id}}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div id="tab3" class="tab-content">
                        <input type="checkbox" id="brandnew" name="condition_status[]" value="Brand_New">
                        <label for="brandnew" class="me-4">{{__('Brand New')}}</label>
                        <input type="checkbox" id="used" name="condition_status[]" value="Used">
                        <label for="used">{{__('Used')}}</label><br>
                        {{-- {{ dd('condition_status[]');}} --}}
                        <div style="display: flex;">
                            <div class="col-6 col-lg-6 col-md-6 mt-2 me-2">
                                <h5 style="font-size: 13px;">{{__('Min Mileage')}}</h5>
                                <select class="form-select min-check" aria-label="Default select example" name="mileage_min" id="condition-brandnew1">
                                    <option value="min-default" selected disabled>Select Km</option>
                                    @for( $i = 0 ; $i < 61 ; $i++ )  <option value="{{ $i * 5000 }}">
                                        {{ ($i * 5) }}k Km </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6 col-lg-6 col-md-6 mt-2">
                                <h5 style="font-size: 13px;">{{__('Max Mileage')}}</h5>
                                <select class="form-select max-check" aria-label="Default select example" name="mileage_max" id="condition-brandnew2">
                                    <option value="max-default" selected disabled>Select Km</option>
                                    @for( $i = 0 ; $i < 61 ; $i++ )  <option value="{{ $i * 5000 }}">
                                        {{ ($i * 5) }}k Km </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                      </div>
                      <div id="tab4" class="tab-content" style="display: flex;">
                        <div class="col-6 col-lg-6 col-md-6 mt-2 me-2">    
                                <h5 style="font-size: 13px;">{{__('Min Year')}}</h5>
                            <select class="form-select min-year" aria-label="Default select example" name="min_year">
                                    <option name="default-minyear" selected disabled>Select Year</option>
                                    @for( $i = now()->year ; $i > 2000 ; $i-- )  <option value="{{ ($i) }}">
                                        {{ ($i) }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-md-6 mt-2">
                            <h5 style="font-size: 13px;">{{__('Max Year')}}</h5>
                            <select class="form-select max-year" aria-label="Default select example" name="max_year">
                                <option selected disabled>Select Year</option>
                                @for( $i = now()->year ; $i > 2000 ; $i-- )  <option value="{{ ($i) }}">
                                    {{ ($i) }}</option>
                                @endfor
                            </select>
                        </div>
                      </div>
                      <div id="tab5" class="tab-content" style="display: flex;">
                        <div class="col-6 col-lg-6 col-md-6 mt-2 me-2">
                            <h5 style="font-size: 13px;">{{__('Min Price')}}</h5>
                            <select class="form-select min-price" aria-label="Default select example" name="min_price">
                                <option selected disabled>Select Price</option>
                                @for( $i = 1 ; $i < 21 ; $i++ )  <option value="{{ ($i * 100) }}">
                                    {{ ($i * 100) }}Lakhs </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-md-6 mt-2">
                            <h5 style="font-size: 13px;">{{__('Max Price')}}</h5>
                            <select class="form-select max-price" aria-label="Default select example" name="max_price">
                                <option selected disabled>Select Price</option>
                                @for( $i = 1 ; $i < 21 ; $i++ )  <option value="{{ ($i * 100) }}">
                                    {{ ($i * 100) }}Lakhs </option>
                                @endfor
                            </select>
                        </div>
                      </div>
                      <div id="tab6" class="tab-content" style="display: flex;">
                        @php($fuel = array("Petrol", "Diesel", "CNG", "Electric"))
                        <div class="col-12 col-lg-12 col-md-12" style="display:flex;">
                            @foreach ($fuel as $tran)
                            <div class="form-check col-3 me-2">
                                <input class="form-check-input" type="checkbox" name="fuel_types[]" value="{{$tran}}" id="{{$tran}}">
                                <label class="form-check-label" for="{{$tran}}">
                                    {{$tran}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                      </div>
                      <div id="tab7" class="tab-content" style="display: flex;">
                        <div class="col-12 col-lg-12 col-md-12" style="display:flex;">
                            <div class="form-check col-4 col-lg-3 me-2 radio-item">
                                <input class="form-check-input" type="radio" name="steer" value="Left" id="Left">
                                <label class="form-check-label" for="Left">
                                  {{__('Left')}}
                                </label>
                            </div>
                            <div class="form-check col-4 col-lg-3 me-2 radio-item">
                                <input class="form-check-input" type="radio" name="steer" value="Right" id="Right">
                                <label class="form-check-label" for="Right">
                                  {{__('Right')}}
                                </label>
                            </div>
                        </div>
                      </div>
                      <div id="tab8" class="tab-content" style="display: flex;">
                        <div class="col-12 col-lg-12 col-md-12" style="display:flex;">
                            <div class="col-12 col-lg-12 col-md-12" style="display:flex;">
                                @php($transmissions = array("Auto", "Manual", "Semi Auto"))
                                @foreach ($transmissions as $tran)
                                <div class="form-check col-4 me-2">
                                    <input class="form-check-input" type="checkbox" name="transmissions[]" value="{{$tran}}" id="{{$tran}}">
                                    <label class="form-check-label" for="{{$tran}}">
                                        {{$tran}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                      </div>
                      <div id="tab9" class="tab-content" style="overflow-y:scroll; height:289px;">
                        <label class="car-color col-4 col-lg-4 col-md-4" for="White">
                            <div class="round">
                              <input type="checkbox" id="White" name="color_cars[]" value="White"/>
                              <label for="White" style="background-color:White;"  class="unique_whitecar"></label>
                            </div>
                          <label for="White" style="display:block; text-align:center;">{{__('White')}}</label>
                        </label>
                        @php($car_colors = array("Black", "Gray", "Gold", "Green", "Red", "Blue", "Brown"))
                        @foreach ($car_colors as $car_color)
                        <label class="car-color col-4 col-lg-4 col-md-4" for="{{ $car_color }}">
                            <div class="round">
                              <input type="checkbox" id="{{ $car_color }}" name="color_cars[]" value="{{ $car_color }}"/>
                              <label for="{{ $car_color }}" style="background-color:{{ $car_color }};"></label>
                            </div>
                          <label for="{{ $car_color }}" style="display:block; text-align:center;">{{__($car_color) }}</label>
                        </label>
                        @endforeach                        
                       
                        <label class="car-color col-4 col-lg-4 col-md-4" for="color_cars[]" style="margin-bottom: 150px;">
                            <div class="round">
                              <input type="checkbox" id="car_other"/>
                              <label for="car_other" class="unique_whitecar">
                              <img src="{{url('/images/rainbow_color.png')}}" style="width:100%; vertical-align:0;"></label>
                            </div>
                          <label for="car_other" style="display:block; text-align:center;">{{__('Other')}}</label>
                        </label>
                      </div>

                      
                    </div> <!-- END tabs-content -->
                  </div> <!-- END tabs -->

                </div>
                <div class="modal-footer">
                <button type="submit" id="filterBtn" class="btn" style="background: #12ca8a; color:white;"><i class="fa-solid fa-magnifying-glass me-2"></i>{{__('Search')}}</button>
            
                </div>
            </form>
            </div>
            </div>
        </div>