<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;

class PostDao
{

    public function getDetail($purpose)
    {
        return Post::Where('purpose','=',$purpose)->paginate(10);
    }

    public function getCount($purpose = null)
    {
       return $purpose ? Post::Where('purpose', '=', $purpose)->count() : Post::count();
    }

    public function getAll()
    {
        $post = Post::get()->toArray();
        return $post;
    }

    public function getPostCountByBuildTypeId($build_type_id)
    {
        return Post::where('build_type_id', $build_type_id)->get()->count();
    }

    public function getPostCountByManufacturerId($manufacturer_id)
    {
        return Post::where('manufacturer_id', $manufacturer_id)->get()->count();
    }

    public function getPostCountByPlateDivisionId($plate_division_id)
    {
        return Post::where('plate_division_id', $plate_division_id)->get()->count();
    }

    public function getPostCountLatestYear($manufacturer_id, $latest_year, $before_latest)
    {
        return Post::where('manufacturer_id', $manufacturer_id)->Where('created_at', '>=',$latest_year)->Where('created_at', '<',$before_latest)->get()->count();
    }

    public function getPostCountLatestMonth($manufacturer_id, $latest_month)
    {
        return Post::where('manufacturer_id', $manufacturer_id)->Where('created_at', '>=',$latest_month)->get()->count();
    }

}