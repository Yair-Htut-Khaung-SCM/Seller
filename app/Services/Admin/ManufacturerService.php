<?php

namespace App\Services\Admin;

use App\Dao\Admin\ManufacturerDao;

class ManufacturerService
{
    public function __construct(ManufacturerDao $manufacturerDao)
    {
        $this->manufacturerDao = $manufacturerDao;
    }

    public function getAll()
    {
        $result = $this->manufacturerDao->getAll();
        return $result;
    }

    public function getDetail()
    {
        $result = $this->manufacturerDao->getDetail();
        return $result;
    }

    public function getCount()
    {
        return $this->manufacturerDao->getCount();
    }

    public function saveManufacturer($request)
    {
        $manufacturer = $this->manufacturerDao->saveManufacturer($request);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $manufacturer->id. '.png';
            $file->move(public_path('/images/manufacturer_logos'),$filename);
        }
        return $manufacturer;
    }

    public function updateManufacturer($request, $id)
    {
        $manufacturer = $this->manufacturerDao->updateManufacturer($request, $id);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $manufacturer->id. '.png';
            $file->move(public_path('/images/manufacturer_logos'),$filename);
        }
        return $manufacturer;
    }

    public function deleteManufacturer($manufacturer)
    {
        $manufacturer = $this->manufacturerDao->deleteManufacturer($manufacturer);
        return $manufacturer;
    }

    public function getManufacturewithPostCount()
    {
        $manufacturer = $this->manufacturerDao->getManufacturewithPostCount();
        return $manufacturer;
    }

    public function getManufactureByLastYear($latest_year,$before_latest)
    {
        $manufacturer = $this->manufacturerDao->getManufactureByLastYear($latest_year,$before_latest);
        return $manufacturer;
    }

    public function getManufactureByLastMonth($latest_month)
    {
        $manufacturer = $this->manufacturerDao->getManufactureByLastMonth($latest_month);
        return $manufacturer;
    }

}
