<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class FavouritePostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favourite_posts;

        $posts = collect($posts)->reverse();

        return response()->json(PostResource::collection($posts));
    }

    public function store($id)
    {
        DB::beginTransaction();
        try {
            $favourite = Favourite::create([
                'post_id' => $id,
                'user_id' => Auth::user()->id
            ]);

            DB::commit();

            return $favourite;
            // return response()->json(200);
        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line: ' . __LINE__ . '][Add Favorite Post failed] Message: ' . $th->getMessage());
            DB::rollBack();

            return response()->json(500);
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {

            $user_id = Auth::id();
            $post_id = $id;

            $favourite = Favourite::where('user_id', $user_id)
                ->where('post_id', $post_id);

            $favourite->delete();

            DB::commit();

            return response()->json(200);
        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line: ' . __LINE__ . '][Remove Favorite Post failed] Message: ' . $th->getMessage());
            DB::rollBack();

            return response()->json(500);
        }
    }
}
