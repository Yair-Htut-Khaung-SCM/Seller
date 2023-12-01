<?php

namespace App\Services;

use App\Models\Image;

class ImageService
{
    public function getAll()
    {
        $image = Image::all();
        return $image;
    }

    public function saveImage($post, $filename, $dir)
    {
        $image = new Image();
        $image->post_id = $post->id;
        $image->name = $filename;
        $image->path = $dir;
        $image->url = url($dir . '/' . $filename);
        $image->save();
        return $image;
    }

    public function deleteImageByKey($key, $id)
    {
        $image = Image::where($key, $id)->delete();
        return $image;
    }

    public function getUnDeletedFile($request, $id)
    {
        $images = Image::whereNotIn('id', $request->undeletedFiles)
        ->where('post_id', $id)
        ->get();

        return $images;
    }
    public function getImageByPostId($id)
    {
        $images = Image::where('post_id', $id)->get();
        return $images;
    }
}