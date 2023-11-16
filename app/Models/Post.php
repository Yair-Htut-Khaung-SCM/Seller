<?php

namespace App\Models;

use App\Models\Image;
use App\Models\BuildType;
use App\Models\Manufacturer;
use App\Models\PlateDivision;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function buildType()
    {
        return $this->belongsTo(BuildType::class);
    }
    public function plateDivision()
    {
        return $this->belongsTo(PlateDivision::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function likedBy($id)
    {
        return $this->favourites->contains('user_id', $id);
    }

    public function favouritePosts()
    {
        return $this->belongsToMany(User::class, 'favourites', 'post_id', 'purpose', 'user_id');
    }

    public function isFavourite()
    {
        return auth('sanctum')->check() && $this->favouritePosts()->where('user_id', auth('sanctum')->user()->id)->exists();
    }
    
    public function comment()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    
    public function prunable()
    {
        return Post::where('created_at', '<=', now()->subMonth());
    }
}
