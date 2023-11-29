<?php

namespace App\Services\Admin;

use App\Dao\Admin\BuildTypeDao;

class BuildTypeService
{
    public function __construct(BuildTypeDao $buildTypeDao)
    {
        $this->buildTypeDao = $buildTypeDao;
    }

    public function getAll()
    {
        $result = $this->buildTypeDao->getAll();
        return $result;
    }

    public function getDetail()
    {
        $result = $this->buildTypeDao->getDetail();
        return $result;
    }

    public function getCount()
    {
        return $this->buildTypeDao->getCount();
    }

    public function saveBuildType($request)
    {
        $build_type = $this->buildTypeDao->saveBuildType($request);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $build_type->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }
        return $build_type;
    }

    public function updateBuildType($request, $id)
    {
        $build_type = $this->buildTypeDao->updateBuildType($request, $id);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $build_type->id. '.png';
            $file->move(public_path('/images/build_types'),$filename);
        }
        return $build_type;
    }

    public function deleteBuildType($id)
    {
        $build_type = $this->buildTypeDao->deleteBuildType($id);
        return $build_type;
    }

    public function getBuildTypewithPostCount()
    {
        $build_type = $this->buildTypeDao->getBuildTypewithPostCount();
        return $build_type;
    }

}
