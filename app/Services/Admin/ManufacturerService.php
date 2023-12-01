<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\File;
use App\Models\Manufacturer;

class ManufacturerService
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

    public function saveManufacturer($request)
    {
        $manufacturers = Manufacturer::create($request->all());
        if ($request->hasfile('image')) {
                    $file = $request->file('image');
                    $filename = $request->id. '.png';
                    $file->move(public_path('/images/manufacturer_logos'),$filename);
                }
        return $manufacturers;
    }

    public function updateManufacturer($request, $manufacturer)
    {
        $manufacturer->update($request->all());
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $manufacturer->id. '.png';
            $file->move(public_path('/images/manufacturer_logos'),$filename);
        }
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
