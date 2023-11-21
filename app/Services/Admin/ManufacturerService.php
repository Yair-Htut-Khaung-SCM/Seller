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

    public function getManufacturerById($id)
    {
        $manufacturer = $this->manufacturerDao->getManufacturerById($id);
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

    public function deleteManufacturer($id)
    {
        $manufacturer = $this->manufacturerDao->deleteManufacturer($id);
        return $manufacturer;
    }

}
