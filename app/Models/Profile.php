<?php

namespace App\Models;

use App\Models\ProfileImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profile_image()
    {
        return $this->hasOne(ProfileImage::class);
    }
}
