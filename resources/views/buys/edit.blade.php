@extends('layouts.app')

@section('title')
Edit Post
@endsection

@section('content')
<main class="container">
  <header class="my-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('buy.index') }}">{{__('buy_post')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{__('edit')}}</li>
      </ol>
    </nav>
    </div>
  </header>

  <div class="container">
    <div class="bg-light rounded mt-2">
      <h2 class="p-3" style="color:#12ca8a;">Edit Buy Form</h2>
    </div>

    <!-- Error Alert Box -->
    @if(Session::has('input'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      {{ Session::get('input') }}
    </div>
    @endif

    <!-- Input Boxs -->

    <div class=" p-4 pb-2 mt-2 mb-3 bg-light rounded">
      <form action="{{ route('buy.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-2">


          <!-- Image Upload -->
          <div class="card border-rounded mb-2">

            <div class="card-header head_title">
              <h5>{{__('add_img')}}</h5>
            </div>

            <div class="card-body p-3 ">

              <style>
                .disabled {
                  pointer-events: none;
                }
              </style>

              <div class="d-flex flex-wrap">

                @if($post->images->count())
                @foreach($post->images as $image)
                <span class="upload_preview" id="parte">
                  <input type="number" name="undeletedFiles[]" id="undeletedFile" class="d-none" value="{{ $image->id }}">
                  <img src="{{ url($image->path).'/'.$image->name }}" class="upload_preview_image">
                  <span class="upload_preview_remove">x</span>
                </span>
                @endforeach
                @endif
                <span id="image_here"></span>

                <label for="files" id="upload_icon">
                  <img type="button" id="images" onclick="myFunction()" class="upload_image_icon" src="/images/icons/image_upload_icon.png" alt="Upload Image Icon">
                </label>
                <input type="file" name="files[]" id="files" class="disabled" accept="image/*,.jpg,.png,.jpeg">
                @error('files')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

            </div>
          </div>


          <!-- Car Detail Input Box-->
          <div class="card mt-2">
            <div class="card-header head_title">
              <h5 class="text-white">{{__('buy_info')}}</h5>
            </div>
            <div class="card-body">

              <!-- Manufacturer -->
              <div class="col-sm-12 p-2">
                <label for="manufacturer_id" class="form-label">{{__('manufacturer')}}</label>
                <select class="form-select select optional" name="manufacturer_id" id="manufac-search">
                  <option value="" selected disabled>Choose Option</option>
                  @foreach($manufacturers as $manufacturer)
                  <option value="{{$manufacturer->id}}" @if( $post->manufacturer_id == $manufacturer->id) {{ 'selected' }} @endif >{{$manufacturer->name}}</option>
                  @endforeach
                </select>
                @error('manufacturer_id')
                <p style="color:red">{{ $message}}</p>
                @enderror
              </div>

              <!-- Car Model-->
              <div class="col-sm-12  p-2">
                <label for="car_model" class="form-label">{{__('car_model')}}</label><span style="color:red;"> *</span>
                <input type="text" name='car_model' value="{{ old('car_model', $post->car_model) }}" class="form-control @error('car_model') border-danger @enderror">
                @error('car_model')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!--Year -->
              <div class="col-sm-12 p-2">
                <label for="year" class="form-label">{{__('year')}}</label>
                <select class="form-select select optional" name="year" id="year-search">
                  <option value="" selected disabled>Choose Option</option>
                  @for($i=2023; $i >= 1990; $i--)
                  <option value="{{$i}}" @if($post->year == $i) {{ 'selected' }} @endif >{{$i}}</option>
                  @endfor
                </select>
              </div>

              <!-- Condition -->
              <div class="col-sm-12 p-2">
                <label for="condition" class="form-label">{{__('condition')}}</label>
                <select class="form-select select optional" name="condition">
                  <option value="" selected disabled>Choose Option</option>
                  <option value="Brand New" @if($post->condition == "Brand New") {{ 'selected' }} @endif >Brand New</option>
                  <option value="Used" @if($post->condition == "Used") {{ 'selected' }} @endif >Used</option>
                </select>
                @error('condition')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Price -->
              <div class="col-sm-12 p-2">
                <label for="price" class="form-label">{{__('price')}}</label><span style="color:red;"> *</span>
                <div class="input-group">
                  <input type="text" class="form-control  @error('price') border-danger @enderror" name="price" value="{{ old('price', $post->price) }}">
                  <span class="input-group-text">{{__('lakh')}}</span>
                </div>
                @error('price')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Build Type -->
              <div class="col-sm-12 p-2">
                <label for="build_type_id" class="form-label">{{__('build_type')}}</label>
                <select class="form-select select optional" name="build_type_id" id="buildtype-search">
                  <option value="" selected disabled>Choose Option</option>
                  @foreach($build_types as $build_type)
                  <option value="{{$build_type->id}}" @if($post->build_type_id == $build_type->id) {{ 'selected' }} @endif >{{$build_type->name}}</option>
                  @endforeach
                </select>
                @error('build_type_id')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Trim Name -->
              <div class="col-sm-12 p-2">
                <label for="trim_name" class="form-label">{{__('trim')}}</label>
                <input type="text" name="trim_name" value="{{ old('trim_name', $post->trim_name) }}" class="form-control @error('trim_name') border-danger @enderror">
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
                <label for="engine_power" class="form-label">{{__('engine')}}</label><span style="color:red;"> *</span>
                <div class="input-group">
                  <input type="number" class="form-control @error('engine_power') border-danger @enderror" name="engine_power" value="{{ old('engine_power', $post->engine_power)}}">
                  <span class="input-group-text">cc</span>
                </div>
                @error('engine_power')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!--Mileage-->
              <div class="col-sm-12  p-2">
                <label for="mileage" class="form-label">{{__('mileage')}}</label>
                <div class="input-group">
                  <input type="text" name="mileage" value="{{ old('mileage', $post->mileage) }}" class="form-control @error('mileage') border-danger @enderror">
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
                  <option value="" selected disabled>Choose Option</option>
                  <option value="Auto" @if($post->transmission == "Auto") {{ 'selected' }} @endif >Auto</option>
                  <option value="Manual" @if($post->transmission == "Manual") {{ 'selected' }} @endif >Manual</option>
                  <option value="Semi-Auto" @if($post->transmission == "Semi-Auto") {{ 'selected' }} @endif >Semi-Auto</option>
                </select>
                @error('transmission')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <!--Gear-->
              <div class="col-sm-12  p-2">
                <label for="gear" class="form-label">{{__('gear')}}</label>
                <div class="input-group">
                  <input type="number" class="form-control @error('gear') border-danger @enderror" name="gear" value="{{ old('gear', $post->gear) }}">
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
                  <option value="" selected disabled>Choose Option</option>
                  <option value="Left" @if($post->steering_position == "Left") {{ 'selected' }} @endif >Left</option>
                  <option value="Right" @if($post->steering_position == "Right") {{ 'selected' }} @endif >Right</option>
                </select>
                @error('steering_position')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!--Fuel Types -->
              <div class="col-sm-12 p-2">
                <label for="fuel_type" class="form-label">{{__('fuel')}}</label>
                <select class="form-select select optional" name="fuel_type">
                  <option value="" selected disabled>Choose Option</option>
                  <option value="Petrol" @if($post->fuel_type == "Petrol") {{ 'selected' }} @endif >Petrol</option>
                  <option value="Diesel" @if($post->fuel_type == "Diesel") {{ 'selected' }} @endif >Diesel</option>
                  <option value="CNG" @if($post->fuel_type == "CNG") {{ 'selected' }} @endif >CNG</option>
                  <option value="Electric" @if($post->fuel_type == "Electric") {{ 'selected' }} @endif >Electric</option>
                </select>
                @error('fuel_type')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- VIN-->
              <div class="col-sm-12  p-2">
                <label for="vin" class="form-label">{{__('vin')}}</label>
                <input type="text" name="vin" value="{{ old('vin', $post->vin) }}" class="form-control @error('vin') border-danger @enderror">
                @error('vin')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!--Licence Status -->
              <div class="col-sm-12 p-2">
                <label for="licence_status" class="form-label">{{__('licence_status')}}</label>
                <select class="form-select select optional" name="licence_status">
                  <option value="" selected disabled>Choose Option</option>
                  <option value="With Licence" @if($post->licence_status == "With Licence") {{ 'selected' }} @endif >With Licence</option>
                  <option value="CIF Only" @if($post->licence_status == "CIF Only") {{ 'selected' }} @endif >CIF Only</option>
                  <option value="No Slip" @if($post->licence_status == "No Slip") {{ 'selected' }} @endif >No Slip</option>
                </select>
                @error('licence_status')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Plate Number-->
              <div class="col-sm-12  p-2">
                <label for="plate_number" class="form-label">{{__('plate')}}</label>
                <input type="text" name="plate_number" value="{{ old('plate_number', $post->plate_number) }}" class="form-control  @error('plate_number') border-danger @enderror">
                @error('plate_number')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!--Plate Color -->
              <div class="col-sm-12 p-2">
                <label for="plate_color" class="form-label">{{__('plate_color')}}</label>
                <select class="form-select select optional" name="plate_color">
                  <option value="" selected disabled>Choose Option</option>
                  <option value="Black" @if($post->plate_color == "Black") {{ 'selected' }} @endif >Black</option>
                  <option value="Red" @if($post->plate_color == "Red") {{ 'selected' }} @endif >Red</option>
                  <option value="Blue" @if($post->plate_color == "Blue") {{ 'selected' }} @endif >Blue</option>
                </select>
                @error('plate_color')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Plate Division -->
              <div class="col-sm-12 p-2">
                <label for="plate_division_id" class="form-label">{{__('plate_division')}}</label>
                <select class="form-select select optional" name="plate_division_id" id="plate-search">
                  <option value="" selected disabled>Choose Option</option>
                  @foreach($plate_divisions as $plate_division)
                  <option value="{{$plate_division->id}}" @if( $post->plate_division_id == $plate_division->id) {{ 'selected' }} @endif >{{$plate_division->name}}</option>
                  @endforeach
                </select>
                @error('plate_division_id')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Seat Number-->
              <div class="col-sm-12  p-2">
                <label for="seat" class="form-label">{{__('seat')}}</label>
                <input type="text" name="seat" value="{{ old('seat', $post->seat) }}" class="form-control @error('seat') border-danger @enderror">
                @error('seat')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Door Number-->
              <div class="col-sm-12  p-2">
                <label for="door" class="form-label">{{__('door')}}</label>
                <input type="text" name="door" value="{{ old('door', $post->door) }}" class="form-control @error('door') border-danger @enderror">
                @error('door')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Number Of Owners-->

              <div class="col-sm-12 p-2">
                <label for="owner_count" class="form-label">{{__('owner_count')}}</label>
                <select class="form-select select optional  @error('owner_count') border-danger @enderror" name="owner_count">
                  <option value="" selected disabled>Choose Option</option>
                  <option value="1" @if( old('owner_count')=="1" ) {{ 'selected' }} @endif>One</option>
                  <option value="2" @if( old('owner_count')=="2" ) {{ 'selected' }} @endif>Two</option>
                  <option value="3" @if( old('owner_count')=="3" ) {{ 'selected' }} @endif>Three</option>
                  <option value="4" @if( old('owner_count')=="4" ) {{ 'selected' }} @endif>Four</option>
                  <option value="5" @if( old('owner_count')=="5" ) {{ 'selected' }} @endif>Five</option>
                </select>
                @error('owner_count')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Description-->
              <div class="col-sm-12  p-2">
                <div class="form-group">
                  <label for="description" class="form-label">{{__('description')}}</label>
                  <textarea name="description" class="form-control @error('description') border-danger @enderror" rows="5">
                  {{old('description', $post->description) }}
                  </textarea>
                  @error('description')
                  <p style="color:red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Info -->
          <div class="card mt-2">
            <div class="card-header head_title">
              <h5>{{__('contact')}}</h5>
            </div>
            <div class="card-body">
              <!-- Phone Number-->
              <div class="col-sm-12 p-2">
                <label for="phone" class="form-label">{{__('phone')}}</label><span style="color:red;"> *</span>
                <input type="text" name="phone" value="{{ old('phone', $post->phone) }}" class="form-control @error('phone') border-danger @enderror">
                @error('phone')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>

              <!-- Address-->
              <div class="col-sm-12 p-2">
                <label for="address" class="form-label">{{__('address')}}</label><span style="color:red;"> *</span>
                <textarea name="address" class="form-control  @error('address') border-danger @enderror" rows="2">{{ old('address', $post->address) }}</textarea>
                @error('address')
                <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>

          <!-- Publish/Unpublish -->
          <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="is_published" id="is_published" value="1" @if(old('is_published',$post->is_published)=="1") checked @endif>
            <label class="form-check-label" for="publish">
              Publish
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="publish" id="unpublish" value="0" @if(old('is_published',$post->is_published)=="0") checked @endif>
            <label class="form-check-label" for="unpublish">
              Unpublish
            </label>
          </div>

          <!-- Button -->
          <div class="d-flex justify-content-between mt-3">
            <p><button type="submit" class="btn button fw-bold" style="width:150px;">{{__('update')}}</button></p>
            <p> <a href="{{ route('buy.index') }}" class="btn btn-outline-secondary fw-bold">{{__('cancel')}}</a></p>
          </div>
          <!-- End Input Boxs -->
        </div>
    </div>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>
  var image_limit = 5; //Upload Images Limit

  $(".upload_preview_remove").click(function() {
    $(this).parent(".upload_preview").remove();
  });

  // Check Old Upload is Already 5 Images
  $(document).ready(function() {
    var i = 0;
    $("span").each(function() {
      if ($(this).attr("id") == "parte")
        i++;
    });
    if (i >= image_limit) {
      document.getElementById("upload_icon").style.display = "none";
    }
  });

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
</script>

@endsection