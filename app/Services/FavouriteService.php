<?php

namespace App\Services;

use App\Models\Favourite;

class FavouriteService
{
    public function saveFavourite($favourite)
    {
        return Favourite::create($favourite);
    }

    public function deleteFavourite($post_id, $user_id)
    {
        $favourite = Favourite::where('user_id', $user_id)
            ->where('post_id', $post_id);

        $favourite->delete();
        return $favourite;
    }

    public function getFavourite($user_posts)
    {
        $favourite = Favourite::whereIn('post_id', $user_posts)->get();
        return $favourite;
    }
}
