<?php

namespace App\Dao\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\PlateDivision;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;

class PlateDivisionDao
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
        $plate_division = new PlateDivision();
        $plate_division->name = $request->name;
        $plate_division->save();

        return $plate_division;
    }

    public function getPlateDivisionById($id)
    {
        $plate_division = PlateDivision::find($id);
        return $plate_division;
    }

    public function updatePlateDivision($request, $id)
    {
        $plate_division = $this->getPlateDivisionById($id);
        $plate_division->name = $request->name;
        $plate_division->updated_at = now();
        $plate_division->save();

        return $plate_division;
    }

    public function deletePlateDivision($id)
    {
        $plate_division = $this->getPlateDivisionById($id);
        $plate_division->delete();
        return $plate_division;
    }

}