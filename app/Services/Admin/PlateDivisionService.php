<?php

namespace App\Services\Admin;

use App\Dao\Admin\PlateDivisionDao;

class PlateDivisionService
{
    public function __construct(PlateDivisionDao $plateDivisionDao)
    {
        $this->plateDivisionDao = $plateDivisionDao;
    }

    public function getAll()
    {
        $result = $this->plateDivisionDao->getAll();
        return $result;
    }

    public function getDetail()
    {
        $result = $this->plateDivisionDao->getDetail();
        return $result;
    }

    public function getCount()
    {
        return $this->plateDivisionDao->getCount();
    }

    public function savePlateDivision($request)
    {
        $plate_division = $this->plateDivisionDao->savePlateDivision($request);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $plate_division->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }
        return $plate_division;
    }

    public function updatePlateDivision($request, $plate_division)
    {
        $plate_division = $this->plateDivisionDao->updatePlateDivision($request, $plate_division);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $plate_division->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }
        return $plate_division;
    }

    public function deletePlateDivision($plate_division)
    {
        $plate_division = $this->plateDivisionDao->deletePlateDivision($plate_division);
        return $plate_division;
    }

    public function getPlateDivisionWithPostCount()
    {
       $plate_division = $this->plateDivisionDao->getPlateDivisionWithPostCount();
       return $plate_division;
    }

}
