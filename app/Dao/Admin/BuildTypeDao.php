<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\BuildType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;

class BuildTypeDao
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
        $build_type = new BuildType();
        $build_type->name = $request->name;
        $build_type->save();

        return $build_type;
    }

    public function getBuildTypeById($id)
    {
        $build_type = BuildType::find($id);
        return $build_type;
    }

    public function updateBuildType($request, $id)
    {
        $build_type = $this->getBuildTypeById($id);
        $build_type->name = $request->name;
        $build_type->updated_at = now();
        $build_type->save();

        return $build_type;
    }

    public function deleteBuildType($id)
    {
        $build_type = $this->getBuildTypeById($id);
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