<?php

namespace App\Services;

use App\Dao\ImageDao;

class ImageService
{
    public function __construct(ImageDao $imageDao)
    {
        $this->imageDao = $imageDao;
    }

    public function getAll()
    {
        $result = $this->imageDao->getAll();
        return $result;
    }

    public function saveImage($post, $filename, $dir)
    {
        $result = $this->imageDao->saveImage($post, $filename, $dir);
        return $result;
    }

    public function deleteImageByKey($key, $id)
    {
        $result = $this->imageDao->deleteImage($key, $id);
        return $result;

    }

    public function getUnDeletedFile($request, $id)
    {
        $result = $this->imageDao->getUnDeletedFile($request, $id);
        return $result;
    }

    public function getImageByPostId($id)
    {
        $result = $this->imageDao->getImageByPostId($id);
        return $result;
    }
}