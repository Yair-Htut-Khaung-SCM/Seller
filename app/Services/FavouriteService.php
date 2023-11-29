<?php

namespace App\Services;

use App\Dao\FavouriteDao;

class FavouriteService
{
    public function __construct(FavouriteDao $favouriteDao)
    {
        $this->favouriteDao = $favouriteDao;
    }

    public function saveFavourite($favourite)
    {
        $result = $this->favouriteDao->saveFavourite($favourite);
        return $result;
    }

    
}
