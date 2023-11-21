<?php

namespace App\Services\Admin;

use App\Dao\Admin\PostDao;

class PostService
{
    public function __construct(PostDao $postDao)
    {
        $this->postDao = $postDao;
    }

    public function getDetail($purpose)
    {
        $result = $this->postDao->getDetail($purpose);
        return $result;
    }

    public function getCount($purpose)
    {
        return $this->postDao->getCount($purpose);
    }

    public function getAll()
    {
        $result = $this->postDao->getAll();
        return $result;
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

    public function getPostCountByPlateDivisionId($plate_division_id)
    {
        $result = $this->postDao->getPostCountByPlateDivisionId($plate_division_id);
        return $result;
    }

    public function getPostCountLatestYear($manufacturer_id, $latest_year, $before_latest)
    {
        $result = $this->postDao->getPostCountLatestYear($manufacturer_id, $latest_year, $before_latest);
        return $result;
    }

    public function getPostCountLatestMonth($manufacturer_id, $latest_month)
    {
        $result = $this->postDao->getPostCountLatestMonth($manufacturer_id, $latest_month);
        return $result;
    }
      
}
