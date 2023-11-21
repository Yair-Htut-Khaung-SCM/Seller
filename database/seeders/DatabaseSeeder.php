<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    // protected $postCount = 50;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // AdminUser::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'),
        // ]);

        // Profile::create([
        //     'user_id' => User::create([
        //         'name' => 'Zeus',
        //         'email' => 'zeus@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('zeus'),
        //     ])->id,
        //     'status' => 'Normal User',
        // ]);

        // for ($i = 0; $i < 5; $i++) {
        //     Profile::create([
        //         'user_id' => User::factory()->create()->id,              
        //     ]);

        // }
        // for ($j = 1; $j < 7; $j++) {
        // ProfileImage::create([
        //         'profile_id' => $j,
        //         'name' => 'default_avatar.jpeg',
        //         'path' => 'upload/test',
        //         'url' => 'upload/test/default_avatar.jpeg',
        //     ]);
        // }

        $this->call(AdminUsersSeeder::class);
        $this->call(ProfilesSeeder::class);
        $this->call(ProfileImagesSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(BuildTypeSeeder::class);
        $this->call(PlateDivisionSeeder::class);
        $this->call(PostSeeder::class);

        // for ($i = 0; $i < $this->postCount; $i++) {
        //     $post = Post::factory()->create();

        //     for ($j = 0; $j < 5; $j++) {

        //         $filename = 'car_' . rand(1, 8) . '.jpg';
        //         $dir = 'upload/test';

        //         $image = new Image();
        //         $image->post_id = $post->id;
        //         $image->name = $filename;
        //         $image->path = $dir;
        //         $image->url = url($dir . '/' . $filename);
        //         $image->save();
        //     }
        // }
        // for ($i = 0; $i < $this->postCount; $i++) {
        //     $post = Post::factory()->create(['condition' => 'Brand New']);

        //     for ($j = 0; $j < 5; $j++) {

        //         $filename = 'car_' . rand(1, 8) . '.jpg';
        //         $dir = 'upload/test';

        //         $image = new Image();
        //         $image->post_id = $post->id;
        //         $image->name = $filename;
        //         $image->path = $dir;
        //         $image->url = url($dir . '/' . $filename);
        //         $image->save();
        //     }
        // }

        // for ($i = 0; $i < $this->postCount; $i++) {
        //     $post = Post::factory()->create(['purpose' => 'sale']);

        //     for ($j = 0; $j < 5; $j++) {

        //         $filename = 'car_' . rand(1, 8) . '.jpg';
        //         $dir = 'upload/test';

        //         $image = new Image();
        //         $image->post_id = $post->id;
        //         $image->name = $filename;
        //         $image->path = $dir;
        //         $image->url = url($dir . '/' . $filename);
        //         $image->save();
        //     }
        // }
    }
}
