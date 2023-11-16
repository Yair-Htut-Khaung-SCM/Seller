<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\PlateDivision;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlateDivisionResource;

class PlateDivisionController extends Controller
{
    public function index()
    {
        $plate_divisions = PlateDivision::all();

        return PlateDivisionResource::collection($plate_divisions);
    }
}
