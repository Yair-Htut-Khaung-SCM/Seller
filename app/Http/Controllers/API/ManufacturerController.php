<?php

namespace App\Http\Controllers\API;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManufacturerResource;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();

        return ManufacturerResource::collection($manufacturers);
    }
}
