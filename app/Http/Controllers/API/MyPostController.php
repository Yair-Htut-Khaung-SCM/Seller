<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class MyPostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;

        $posts = collect($posts)->sortByDesc('updated_at');

        return response()->json(PostResource::collection($posts));
    }
}
