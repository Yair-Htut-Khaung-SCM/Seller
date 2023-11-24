<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Storage;
use App\Dao\Admin\PostDao;
use App\Services\ImageService;

class PostService
{
    public function __construct(PostDao $postDao,ImageService $imageService)
    {
        $this->postDao = $postDao;
        $this->imageService = $imageService;
    }

    public function getDetail($purpose)
    {
        $result = $this->postDao->getDetail($purpose);
        return $result;
    }

    public function getCount($purpose = null)
    {
        return $this->postDao->getCount($purpose);
    }

    public function getAll()
    {
        $result = $this->postDao->getAll();
        return $result;
    }

    public function getPostById($id)
    {
        $post = $this->postDao->getPostById($id);
        return $post;
    }

    public function getPostCountByBuildTypeId($build_type_id)
    {
        $result = $this->postDao->getPostCountByBuildTypeId($build_type_id);
        return $result;
    }

    public function getPostCountByManufacturerId($manufacturer_id)
    {
        $result = $this->postDao->getPostCountByManufacturerId($manufacturer_id);
        return $result;
    }

    public function getPostCountByPlateDivisionId($plate_division_id = null)
    {
        $result = $this->postDao->getPostCountByPlateDivisionId($plate_division_id);
        return $result;
    }

    public function getBrandNewPost($request, $purpose)
    {
        $result = $this->postDao->getBrandNewPost($request, $purpose);
        return $result;
    }

    public function getBuildTypePost($request, $purpose)
    {
        $result = $this->postDao->getBuildTypePost($request, $purpose);
        return $result;
    }

    public function getManufauturerPost($request, $purpose)
    {
        $result = $this->postDao->getManufauturerPost($request, $purpose);
        return $result;
    }

    public function getPost($request, $purpose)
    {
        $result = $this->postDao->getPost($request, $purpose);
        return $result;
    }

    public function savePost($request)
    {
        $post = $this->postDao->savePost($request);
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {

                $filename = date('YmdHi') . $file->getClientOriginalName();
                $dir = 'upload/images/' . $post->id;
                $image = $this->imageService->saveImage($post, $filename, $dir);
                $file->move(public_path('upload/images/' . $post->id), $filename);
            }
        }
        return $post;
    }

    public function updatePost($request, $id)
    {
        if ($request->undeletedFiles) {
            $images = $this->imageService->getUnDeletedFile($request, $id);
            foreach ($images as $image) {
                Storage::delete($image->path . '/' . $image->name);
                $this->imageService->deleteImageByKey('id',$image->id);
            }
        } else {
            $images = $this->imageService->getImageByPostId($id);
            
            foreach ($images as $image) {
                Storage::delete($image->path . '/' . $image->name);
                $this->imageService->deleteImageByKey('post_id',$id);
            }
        }

        $post = $this->postDao->savePost($request, $id);

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {

                $filename = date('YmdHi') . $file->getClientOriginalName();
                $dir = 'upload/images/' . $post->id;
                $image = $this->imageService->saveImage($post, $filename, $dir);
                $file = $file->move(public_path('upload/images/' . $post->id), $filename);
            }
        }
        return $post;
    }

    public function getSimilarPost($post)
    {
        $post = $this->postDao->getSimilarPost($post);
        return $post;
    }

    public function deletePost($id)
    {
        $post = $this->postDao->deletePost($id);

        if ($post->images()->exists()) {
            Storage::deleteDirectory($post->images[0]->path);
        }
        return $post;
    }

    public function getPostByPurpose($purpose, $id)
    {
      $post = $this->postDao->getPostByPurpose($purpose, $id);
      return $post;
    }

    public function getOtherPostByPurpose($purpose, $id)
    {
      $post = $this->postDao->getOtherPostByPurpose($purpose, $id);
      return $post;
    }
      
}
