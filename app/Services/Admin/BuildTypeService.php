<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\File;
use App\Models\BuildType;

class BuildTypeService
{
    public function getAll()
    {
        $build_type = BuildType::all();
        return $build_type;
    }

    public function getDetail()
    {
        $result = BuildType::paginate(10);
        return $result;
    }

    public function getCount()
    {
        return BuildType::count();
    }

    public function saveBuildType($request)
    {
        $build_type = BuildType::create($request->all());
        if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = $build_type->id. '.png';
                $file->move(public_path('/images/build_types'),$filename);
            }
        return $build_type;
    }

    public function updateBuildType($request, $build_type)
    {
        $build_type->update($request->all());
        if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = $build_type->id. '.png';
                $file->move(public_path('/images/build_types'),$filename);
            }
        return $build_type;
    }

    public function deleteBuildType($build_type)
    {
        if(File::exists(public_path('/images/build_types/' .$build_type->id. '.png'))) {
            File::delete(public_path('/images/build_types/' .$build_type->id. '.png'));
          } 

        $build_type->delete();
        return $build_type;
    }
    
    public function getBuildTypewithPostCount()
    {
        $build_type = BuildType::withCount('posts')->get()->toArray();
        return $build_type;
    }

}
