<?php

namespace App\Services\Admin;

use App\Models\PlateDivision;

class PlateDivisionService
{
    public function getAll()
    {
        $plate_division = PlateDivision::all();
        return $plate_division;
    }

    public function getDetail()
    {
        $result = PlateDivision::paginate(10);
        return $result;
    }

    public function getCount()
    {
        return PlateDivision::count();
    }

    public function savePlateDivision($request)
    {
        $plate_division = PlateDivision::create($request->all());
        return $plate_division;
    }

    public function updatePlateDivision($request, $plate_division)
    {
        $plate_division->update($request->all());
        return $plate_division;
    }

    public function deletePlateDivision($plate_division)
    {
        $plate_division->delete();
        return $plate_division;
    }

    public function getPlateDivisionWithPostCount()
    {
        $plate_division = PlateDivision::withCount('posts')->get()->toArray();
        return $plate_division;
    }
}
