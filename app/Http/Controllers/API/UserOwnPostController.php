<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class UserOwnPostController extends Controller
{
    public function index($id)
    {
        $posts = User::find($id)->posts;

        $posts = collect($posts)->sortByDesc('updated_at');

        return response()->json(PostResource::collection($posts));
    }
}
