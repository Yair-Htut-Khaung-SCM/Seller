<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildTypeResource;
use App\Models\BuildType;
use Illuminate\Http\Request;

class BuildTypeController extends Controller
{
    public function index()
    {
        $buildTypes = BuildType::all();

        return BuildTypeResource::collection($buildTypes);
    }
}
