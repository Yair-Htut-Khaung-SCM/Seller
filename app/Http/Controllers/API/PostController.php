<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\API\PostStoreRequest;
use App\Http\Requests\API\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::when(request('lot'), function ($query) {
            $query->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) {
                $query->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) {
                $query->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) {
                $query->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) {
                $query->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->when(request('year'), function ($query) {
                if (request('year') == 'desc') {
                    $query->orderByDesc('year');
                } else if (request('year') == 'asc') {
                    $query->orderBy('year');
                }
            })
            ->when(request('price'), function ($query) {
                if (request('price') == 'desc') {
                    $query->orderByDesc('price');
                } else if (request('price') == 'asc') {
                    $query->orderBy('price');
                }
            })
            ->when(request('date'), function ($query) {
                if (request('date') == 'desc') {
                    $query->orderByDesc('published_at');
                } else if (request('date') == 'asc') {
                    $query->orderBy('published_at');
                }
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $post = Post::create([
                'user_id' =>  auth()->id(),
                'condition' => $request->condition,
                'manufacturer_id' => $request->manufacturer_id,
                'car_model' => $request->car_model,
                'year' => $request->year,
                'price' => $request->price,
                'build_type_id' => $request->build_type_id,
                'trim_name' => $request->trim_name,
                'engine_power' => $request->engine_power,
                'steering_position' => $request->steering_position,
                'transmission' => $request->transmission,
                'gear' => $request->gear,
                'fuel_type' => $request->fuel_type,
                'color' => $request->color,
                'vin' => $request->vin,
                'licence_status' => $request->licence_status,
                'plate_number' => $request->plate_number,
                'plate_color' => $request->plate_color,
                'plate_division_id' => $request->plate_division_id,
                'seat' => $request->seat,
                'door' => $request->door,
                'mileage' => $request->mileage,
                'owner_count' => $request->owner_count,
                'description' => $request->description,
                'phone' =>  $request->phone,
                'address' => $request->address,
            ]);

            // Image Create 
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {

                    $filename = date('YmdHis') . $file->getClientOriginalName();
                    // $file->move(public_path('upload/images/'.$post->id), $filename);
                    $dir = 'upload/images/' . $post->id;
                    $path = $file->storeAs($dir, $filename);

                    $image = new Image();

                    $image->post_id = $post->id;
                    $image->name = $filename;
                    $image->path = $dir;
                    $image->url = url($dir . '/' . $filename);

                    $image->save();
                }
            }

            DB::commit();

            return response()->json(['message' => 'Post was Created successfully.'], 200);
        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line: ' . __LINE__ . '][Post creating failed] Message: ' . $th->getMessage());
            DB::rollBack();

            return response()->json(['message' => 'Post create fail.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return response()->json(PostResource::make($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);

        if ($post->user_id != auth()->id()) {
            return response()->json(401);
        }

        DB::beginTransaction();
        try {
            $post->update([
                'condition' => $request->condition,
                'manufacturer_id' => $request->manufacturer_id,
                'car_model' => $request->car_model,
                'year' => $request->year,
                'price' => $request->price,
                'build_type_id' => $request->build_type_id,
                'trim_name' => $request->trim_name,
                'engine_power' => $request->engine_power,
                'steering_position' => $request->steering_position,
                'transmission' => $request->transmission,
                'gear' => $request->gear,
                'fuel_type' => $request->fuel_type,
                'color' => $request->color,
                'vin' => $request->vin,
                'licence_status' => $request->licence_status,
                'plate_number' => $request->plate_number,
                'plate_color' => $request->plate_color,
                'plate_division_id' => $request->plate_division_id,
                'seat' => $request->seat,
                'door' => $request->door,
                'mileage' => $request->mileage,
                'owner_count' => $request->owner_count,
                'description' => $request->description,
                'phone' =>  $request->phone,
                'address' => $request->address,
                'published_at' => now(),
            ]);

            // Delete Old Image
            $images = Image::where('post_id', $id)->get();
            foreach ($images as $image) {
                Storage::delete($image->path . '/' . $image->name);
            }
            Image::where('post_id', $id)->delete();

            // Image Create 
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = date('YmdHis') . $file->getClientOriginalName();
                    // $file->move(public_path('upload/images/'.$post->id), $filename);
                    $dir = 'upload/images/' . $post->id;
                    $path = $file->storeAs($dir, $filename);
                    $image = new Image();
                    $image->post_id = $post->id;
                    $image->name = $filename;
                    $image->path = $dir;
                    $image->url = url($dir . '/' . $filename);
                    $image->save();
                }
            }

            DB::commit();

            return response()->json(['message' => 'Post was Updated successfully.'], 200);
        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line: ' . __LINE__ . '][Post updating failed] Message: ' . $th->getMessage());
            DB::rollBack();

            return response()->json(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->user_id != auth()->id()) {
            return response()->json(401);
        }

        if ($post->images()->exists()) {
            Storage::deleteDirectory($post->images[0]->path);
        }

        $post->delete();

        return response()->json(['message' => 'Post was deleted successfully.'], 200);
    }

    public function search(Request $request)
    {
        $posts = Post::when(request('lot'), function ($query) {
            $query->where('id', 'like', '%' .  request('lot'));
        })
            ->when(request('manufacturer_id'), function ($query) {
                $query->where('manufacturer_id', request('manufacturer_id'));
            })
            ->when(request('car_model'), function ($query) {
                $query->where('car_model', 'like', '%' . request('car_model') . '%');
            })
            ->when(request('build_type_id'), function ($query) {
                $query->where('build_type_id', request('build_type_id'));
            })
            ->when(request('condition'), function ($query) {
                $query->where('condition', 'like', '%' . request('condition') . '%');
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return PostResource::collection($posts);
    }
}
