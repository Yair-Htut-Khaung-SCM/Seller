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
        $build_type = $this->plateDivisionDao->savePlateDivision($request);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $build_type->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }
        return $build_type;
    }

    public function getPlateDivisionById($id)
    {
        $build_type = $this->plateDivisionDao->getPlateDivisionById($id);
        return $build_type;
    }

    public function updatePlateDivision($request, $id)
    {
        $build_type = $this->plateDivisionDao->updatePlateDivision($request, $id);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $build_type->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }
        return $build_type;
    }

    public function deletePlateDivision($id)
    {
        $build_type = $this->plateDivisionDao->deletePlateDivision($id);
        return $build_type;
    }

}
