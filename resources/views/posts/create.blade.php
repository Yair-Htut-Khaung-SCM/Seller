@extends('layouts.app')

@section('title')
Create Post
@endsection

@section('content')
<main class="container col-12 col-md-8 mx-auto">
  <header class="my-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sale.index') }}">{{ __('posts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('sale_post') }}</li>
      </ol>
    </nav>
  </header>
  <div>
    <div class="bg-light rounded mt-2">
      <h2 class="header-1 p-3 fw-bold " style="color:#12ca8a;">{{__('sale_form')}}</h2>
    </div>
    <!-- Input Boxs -->
    <div class=" content-2 p-4 mt-2 mb-3 bg-light rounded">
      <form action="{{route('sale.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-2">
          <!-- Image Upload -->
          <div class="card border-rounded mb-2">
            <div class="card-header head_title">
              <h5 class="mt-2">{{__('add_img')}}</h5>
            </div>
            <div class="card-body container p-3 ">
              <style>
                .disabled {
                  pointer-events: none;
                }
              </style>
              <div class="d-flex flex-wrap">
                <span id="image_here"></span>

                <label for="files" id="upload_icon">
                  <img type="button" id="images" onclick="myFunction()" class="upload_image_icon" src="/images/icons/image_upload_icon.png" alt="Upload Image Icon">
                </label><span style="color:red">*</span>
                <input type="file" name="files[]" id="files" class="disabled @error('files') is-invalid @enderror @error('files.*') is-invalid @enderror" accept="image/*,.jpg,.png,.jpeg">
                @error('files')
                <p style="color:red">{{ $message }}</p>
                @enderror
                @foreach($errors->get('files.*') as $message)
                <div class="invalid-feedback">{{ $message[0] }}</div>
                @endforeach
              </div>

            </div>
          </div>
          <!-- End Image Upload -->
          <!-- Car Detail Input Box-->
          <div class="card mt-2">
            <div class="card-header head_title">
              <h5 class="mt-2">{{__('sale_info')}}</h5>
            </div>
            <div class="card-body">
              <!-- Manufacturer -->
              <div class="col-sm-12 p-2">
                <label for="manufacturer_id" class="form-label">{{__('manufacturer')}}</label><span style="color:red">*</span>
                <select class="form-select select optional @error('manufacturer_id') border-danger @enderror" name="manufacturer_id" id="manufac-search">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  @foreach($manufacturers as $manufacturer)
                  <option class="custon-option" value="{{$manufacturer->id}}" @if( old('manufacturer_id')==$manufacturer->id) {{ 'selected' }} @endif >{{$manufacturer->name}}</option>
                  @endforeach
                </select>
                @error('manufacturer_id')
                <p style="color:red">{{ $message}}</p>
                @enderror
              </div>
              <!-- Car Model-->
              <div class="col-sm-12  p-2">
                <label for="car_model" class="form-label">{{__('car_model')}}</label><span style="color:red">*</span>
                <input type="text" name='car_model' value="{{ old('car_model') }}" class="form-control @error('car_model') border-danger @enderror" placeholder="Creta,TRAX">
                @error('car_model')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Year -->
              <div class="col-sm-12 p-2">
                <label for="year" class="form-label">{{__('year')}}</label><span style="color:red">*</span>
                <select class="form-select select optional @error('year') border-danger @enderror" name="year" id="year-search">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  @for($i=2023; $i >= 1990; $i--)
                  <option value="{{$i}}" @if( old('year')==$i) {{ 'selected' }} @endif>{{$i}}</option>
                  @endfor
                </select>
                @error('year')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Condition -->
              <div class="col-sm-12 p-2">
                <label for="condition" class="form-label @error('condition') border-danger @enderror">{{__('condition')}}</label><span style="color:red">*</span>
                <select class="form-select select optional" id="brandnewcase" name="condition">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="Brand New" @if( old('condition')=="Brand New" ) {{ 'selected' }} @endif>Brand New</option>
                  <option value="Used" @if( old('condition')=="Used" ) {{ 'selected' }} @endif>Used</option>
                </select>
                @error('condition')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Price -->
              <div class="col-sm-12 p-2">
                <label for="price" class="form-label">{{__('price')}}</label><span style="color:red">*</span>
                <div class="input-group">
                  <input type="number" class="form-control  @error('price') border-danger @enderror" name="price" value="{{ old('price') }}">
                  <span class="input-group-text">{{__('lakh')}}</span>
                </div>
                @error('price')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Build Type -->
              <div class="col-sm-12 p-2">
                <label for="build_type_id" class="form-label">{{__('build_type')}}</label><span style="color:red">*</span>
                <select class="form-select select optional @error('build_type_id') border-danger @enderror" name="build_type_id" id="buildtype-search">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  @foreach($build_types as $build_type)
                  <option value="{{$build_type->id}}" @if( old('build_type_id')==$build_type->id) {{ 'selected' }} @endif >{{$build_type->name}}</option>
                  @endforeach
                </select>
                @error('build_type_id')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Trim Name -->
              <div class="col-sm-12 p-2">
                <label for="trim_name" class="form-label">{{__('trim')}}</label>
                <input type="text" class="form-control @error('trim_name') border-danger @enderror" name="trim_name" value="{{ old('trim_name') }}" placeholder="G,GL,S">
                @error('trim_name')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Color-->
              <div class="col-sm-12 p-2">
                <label for="color" class="form-label">{{__('color')}}</label>
                @php($car_colors = array("White", "Black", "Gray", "Gold", "Green", "Red", "Blue", "Brown", "Other Color"))
                <select class="form-select select optional @error('color') border-danger @enderror" name="color">
                  <option selected disabled>Select Car Color</option>
                  @foreach ($car_colors as $color_each)
                  <option value="{{ $color_each }}" @if( old('color')==$color_each) {{ 'selected' }} @endif>
                    {{ $color_each }}
                  </option>
                  @endforeach
                </select>
                @error('color')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Engine Power-->
              <div class="col-sm-12 p-2">
                <label for="engine_power" class="form-label">{{__('engine')}}</label><span style="color:red">*</span>
                <div class="input-group">
                  <input type="number" class="form-control @error('engine_power') border-danger @enderror" name="engine_power" value="{{ old('engine_power') }}" placeholder="1300">
                  <span class="input-group-text">cc</span>
                </div>
                @error('engine_power')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Mileage-->
              <div class="col-sm-12  p-2" id="milagediv">
                <label for="mileage" class="form-label">{{__('mileage')}}</label>
                <div class="input-group">
                  <input type="number" class="form-control @error('mileage') border-danger @enderror" name="mileage" value="{{ old('mileage') }}" placeholder="20000">
                  <span class="input-group-text">{{__('Km')}}</span>
                </div>
                @error('mileage')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Transmission-->
              <div class="col-sm-12 p-2">
                <label for="transmission" class="form-label">{{__('transmission')}}</label>
                <select class="form-select select optional" name="transmission">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="Auto" @if( old('transmission')=="Auto" ) {{ 'selected' }} @endif>Auto</option>
                  <option value="Manual" @if( old('transmission')=="Manual" ) {{ 'selected' }} @endif>Manual</option>
                  <option value="Semi-Auto" @if( old('transmission')=="Semi-Auto" ) {{ 'selected' }} @endif>Semi-Auto</option>
                </select>
                @error('transmission')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Gear-->
              <div class="col-sm-12  p-2">
                <label for="gear" class="form-label">{{__('gear')}}</label>
                <div class="input-group">
                  <input type="number" class="form-control @error('gear') border-danger @enderror" name="gear" value="{{ old('gear') }}" placeholder="8">
                  <span class="input-group-text">- Speed</span>
                </div>
                @error('gear')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Steering Position-->
              <div class="col-sm-12 p-2">
                <label for="steering_position" class="form-label">{{__('steering')}}</label>
                <select class="form-select select optional" name="steering_position">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="Left" @if( old('steering_position')=="Left" ) {{ 'selected' }} @endif>Left</option>
                  <option value="Right" @if( old('steering_position')=="Right" ) {{ 'selected' }} @endif>Right</option>
                </select>
                @error('steering_position')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Fuel Types -->
              <div class="col-sm-12 p-2">
                <label for="fuel_type" class="form-label">{{__('fuel')}}</label>
                <select class="form-select select optional  @error('fuel_type') border-danger @enderror" name="fuel_type">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="Petrol" @if( old('fuel_type')=="Petrol" ) {{ 'selected' }} @endif>Petrol</option>
                  <option value="Diesel" @if( old('fuel_type')=="Diesel" ) {{ 'selected' }} @endif>Diesel</option>
                  <option value="CNG" @if( old('fuel_type')=="CNG" ) {{ 'selected' }} @endif>CNG</option>
                  <option value="Electric" @if( old('fuel_type')=="Electric" ) {{ 'selected' }} @endif>Electric</option>
                </select>
                @error('fuel_type')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- VIN-->
              <div class="col-sm-12  p-2">
                <label for="vin" class="form-label">{{__('vin')}}</label>
                <input type="text" class="form-control @error('vin') border-danger @enderror" name="vin" value="{{old('vin')}}" placeholder="xxxx-xxxx-xxxx-xxxx">
                @error('vin')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Licence Status -->
              <div class="col-sm-12 p-2">
                <label for="licence_status" class="form-label">{{__('licence_status')}}</label>
                <select class="form-select select optional  @error('licence_status') border-danger @enderror" name="licence_status">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="With Licence" @if( old('licence_status')=="With Licence" ) {{ 'selected' }} @endif>With Licence</option>
                  <option value="CIF Only" @if( old('licence_status')=="CIF Only" ) {{ 'selected' }} @endif>CIF Only</option>
                  <option value="No Slip" @if( old('licence_status')=="No Slip" ) {{ 'selected' }} @endif>No Slip</option>
                </select>
                @error('licence_status')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Plate Number-->
              <div class="col-sm-12  p-2">
                <label for="plate_number" class="form-label">{{__('plate')}}</label>
                <input type="text" class="form-control  @error('plate_number') border-danger @enderror" name="plate_number" value="{{old('plate_number')}}" placeholder="1A-1111">
                @error('plate_number')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Plate Color -->
              <div class="col-sm-12 p-2">
                <label for="plate_color" class="form-label">{{__('plate_color')}}</label>
                <select class="form-select select optional  @error('plate_color') border-danger @enderror" name="plate_color">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="Black" @if( old('plate_color')=="Black" ) {{ 'selected' }} @endif>Black</option>
                  <option value="Red" @if( old('plate_color')=="Red" ) {{ 'selected' }} @endif>Red</option>
                  <option value="Blue" @if( old('plate_color')=="Blue" ) {{ 'selected' }} @endif>Blue</option>
                </select>
                @error('plate_color')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Plate Divisioin -->
              <div class="col-sm-12 p-2">
                <label for="plate_division_id" class="form-label">{{__('plate_division')}}</label>
                <select class="form-select select optional @error('plate_division_id') border-danger @enderror" name="plate_division_id" id="plate-search">
                  <option value="" selected disabled>{{ __('choose_division') }}</option>
                  @foreach($plate_divisions as $plate_division)
                  <option class="custon-option" value="{{$plate_division->id}}" @if( old('plate_division_id')==$plate_division->id) {{ 'selected' }} @endif >{{$plate_division->name}}</option>
                  @endforeach
                </select>
                @error('plate_division_id')
                <p style="color:red">{{ $message}}</p>
                @enderror
              </div>
              <!-- Seat Number-->
              <div class="col-sm-12  p-2">
                <label for="seat" class="form-label">{{__('seat')}}</label>
                <input type="number" class="form-control @error('seat') border-danger @enderror" name="seat" value="{{old('seat')}}" placeholder="5">
                @error('seat')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Door Number-->
              <div class="col-sm-12  p-2">
                <label for="door" class="form-label">{{__('door')}}</label>
                <input type="number" class="form-control @error('door') border-danger @enderror" name="door" value="{{old('door')}}" placeholder="2">
                @error('door')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Number Of Owners-->
              <div class="col-sm-12 p-2">
                <label for="owner_count" class="form-label">{{__('owner_count')}}</label>
                <select class="form-select select optional  @error('owner_count') border-danger @enderror" name="owner_count">
                  <option value="" selected disabled>{{__('choose_option')}}</option>
                  <option value="1" @if( old('owner_count')=="1" ) {{ 'selected' }} @endif>1</option>
                  <option value="2" @if( old('owner_count')=="2" ) {{ 'selected' }} @endif>2</option>
                  <option value="3" @if( old('owner_count')=="3" ) {{ 'selected' }} @endif>3</option>
                  <option value="4" @if( old('owner_count')=="4" ) {{ 'selected' }} @endif>4</option>
                  <option value="5" @if( old('owner_count')=="5" ) {{ 'selected' }} @endif>5</option>
                  <!-- <option value="6" @if( old('owner_count')=="6" ) {{ 'selected' }} @endif>More Than Five</option> -->
                </select>
                @error('owner_count')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!-- Description-->
              <div class="col-sm-12  p-2">
                <label for="description" class="form-label">{{__('description')}}</label>
                <textarea class="form-control @error('description') border-danger @enderror" name="description" rows="5">
                {{old('description')}}
                </textarea>
                @error('description')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
          <!-- Contact -->
          <div class="card mt-2">
            <div class="card-header head_title">
              <h5 class="mt-2">{{__('contact')}}</h5>
            </div>
            <div class="card-body">
              <!-- Phone Number-->
              <div class="col-sm-12 p-2">
                <label for="phone" class="form-label">{{__('phone')}}</label><span style="color:red">*</span>
                <input type="text" class="form-control @error('phone') border-danger @enderror" name="phone" value="{{old('phone')}}" placeholder="">
                @error('phone')
                <p style="color:red;">{{ $message }}</p>
                @enderror
              </div>
              <!-- Address-->
              <div class="col-sm-12 p-2">
                <label for="address" class="form-label">{{__('address')}}</label><span style="color:red">*</span>
                <textarea class="form-control  @error('address') border-danger @enderror" name="address" rows="2">{{old('address')}}</textarea>
                @error('address')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>

          <!-- Publish/Unpublish -->
          <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="is_published" id="is_published" value="1" checked>
            <label class="form-check-label" for="publish">
              Publish
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="publish" id="unpublish" value="0">
            <label class="form-check-label" for="unpublish">
              Unpublish
            </label>
          </div>

          <!-- Button -->
          <div class="d-flex justify-content-between mt-2 ">
            <p><button type="submit" class="btn button fw-bold" style="width:100px;">{{__('create')}}</button></p>
            <p> <a href="/" class="btn btn-outline-secondary fw-bold">{{__('cancel')}}</a></p>
          </div>
      </form>
      <!-- End Input Boxs -->
    </div>
  </div>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  var image_limit = 5; //Upload Images Limit
  // OnClick Function to check changes
  document.addEventListener('click', function handleClick(event) {
    var i = 0;
    $("span").each(function() {
      if ($(this).attr("id") == "parte")
        i++;
    });
    if (i < image_limit) {
      document.getElementById("upload_icon").style.display = "block";
    }
  });
  //Image Upload Function
  if (window.File && window.FileList && window.FileReader) {
    function myFunction() {
      $("#files").on("change", function(e) {
        var files = e.target.files,
          filesLength = files.length;
        var x = 1;
        for (var i = 0; i < filesLength; i++) {
          var f = files[i];
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            $("<span class=\"upload_preview\" id=\"parte\">" +
              "<input type=\"file\" name=\"files[]\" id=\"files\" accept=\"image/*,.jpg,.png,.jpeg\">" +
              "<img class=\"upload_preview_image\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
              "<span class=\"upload_preview_remove\">&times;</span>" +
              "</span>").insertAfter("#image_here");
            $(".upload_preview_remove").click(function() {
              $(this).parent(".upload_preview").remove();
            });
          });
          fileReader.readAsDataURL(f);
        }
        $("span").each(function() {
          if ($(this).attr("id") == "parte")
            i++;
        });
        if (i == image_limit) {
          document.getElementById("upload_icon").style.display = "none";
        }
        console.log(files);
      });
    }
  } else {
    alert("Your browser doesn't support to File API")
  }
  // for display none milage if useer selected brandnew
  $(document).ready(function() {
    $("#brandnewcase").on('change', function() {
      if ($(this).prop("selectedIndex") == "1") {
        $("#milagediv").css({
          "display": "none"
        });
      } else {
        $("#milagediv").css({
          "display": "block"
        });
      }
    })
  });
</script>

@endsection