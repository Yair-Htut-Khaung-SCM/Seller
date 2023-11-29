<?php

namespace App\Dao;

use App\Models\Favourite;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FavouriteDao
{

    public function saveFavourite($favourite)
    {
        return Favourite::create($favourite);
    }

}