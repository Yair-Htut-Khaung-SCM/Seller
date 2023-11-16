<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\API\ProfileStoreRequest;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        if(! $user){
            return response()->json(404);
        }

        return response()->json(ProfileResource::make($user));
    }
}
