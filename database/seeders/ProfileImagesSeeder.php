<?php

namespace Database\Seeders;

use App\Models\ProfileImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j = 1; $j < 7; $j++) {
            ProfileImage::create([
                    'profile_id' => $j,
                    'name' => 'default_avatar.jpeg',
                    'path' => 'upload/test',
                    'url' => 'upload/test/default_avatar.jpeg',
                ]);
            }
    }
}
