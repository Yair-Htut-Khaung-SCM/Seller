<?php

namespace Database\Seeders;

use App\Models\ProfileImage;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use Illuminate\Support\Facades\Schema;

class ProfileImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $profiles = Profile::all();

        Schema::disableForeignKeyConstraints();
        ProfileImage::truncate();

        foreach($profiles as $profile)
        {
            ProfileImage::create([
                'profile_id' => $profile->id,
                'name' => 'default_avatar.jpeg',
                'path' => 'upload/test',
                'url' => 'upload/test/default_avatar.jpeg',
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
