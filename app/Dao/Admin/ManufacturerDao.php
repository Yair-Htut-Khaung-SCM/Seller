<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Manufacturer;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;

class ManufacturerDao
{

    public function getAll()
    {
        $manufacturer = Manufacturer::all();
        return $manufacturer;
    }
    
    public function getDetail()
    {
        $result = Manufacturer::paginate(10);
        return $result;
    }

    public function getCount()
    {
        return Manufacturer::count();
    }

    public function saveManufacturer($manufacturer)
    {
        $manufacturers = Manufacturer::create($manufacturer->all());
        return $manufacturers;
    }

    public function getManufacturerById($id)
    {
        $manufacturer = Manufacturer::find($id);
        return $manufacturer;
    }

    public function updateManufacturer($request, $id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->name = $request->name;
        $manufacturer->updated_at = now();
        $manufacturer->save();

        return $manufacturer;
    }

    public function deleteManufacturer($id)
    {
        $manufacturer = $this->getManufacturerById($id);
        if(File::exists(public_path('/images/manufacturer_logos/' .$manufacturer->id. '.png'))) {
            File::delete(public_path('/images/manufacturer_logos/' .$manufacturer->id. '.png'));
          } 

        $manufacturer->delete();
        return $manufacturer;
    }

    public function getManufacturewithPostCount()
    {
        $manufacturer = Manufacturer::withCount('posts')->get()->toArray();
        return $manufacturer;
    }

    public function getManufactureByLastYear($latest_year,$before_latest)
    {
        $manufacturer = Manufacturer::withCount(['posts' => function ($query) use ($latest_year,$before_latest) {
            $query->Where('created_at', '>=',$latest_year)->Where('created_at', '<',$before_latest);
        }])->get()->toArray();
        
        return $manufacturer;
    }

    public function getManufactureByLastMonth($latest_month)
    {
        $manufacturer = Manufacturer::withCount(['posts' => function ($query) use ($latest_month) {
            $query->where('created_at', '>=', $latest_month);
        }])->get()->toArray();
        
        return $manufacturer;
    }

}