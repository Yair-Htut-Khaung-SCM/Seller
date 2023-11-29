<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use App\Models\Manufacturer;

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

    public function updateManufacturer($request, $manufacturer)
    {
        $manufacturer->update($request->all());
        return $manufacturer;
    }

    public function deleteManufacturer($manufacturer)
    {
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