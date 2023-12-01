<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    protected $postCount = 50;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < $this->postCount; $i++) {
            $post = Post::factory()->create();

            for ($j = 0; $j < 5; $j++) {

                $filename = 'car_' . rand(1, 8) . '.jpg';
                $dir = 'upload/test';

                $image = new Image();
                $image->post_id = $post->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);
                $image->save();
            }
        }
        for ($i = 0; $i < $this->postCount; $i++) {
            $post = Post::factory()->create(['condition' => 'Brand New']);

            for ($j = 0; $j < 5; $j++) {

                $filename = 'car_' . rand(1, 8) . '.jpg';
                $dir = 'upload/test';

                $image = new Image();
                $image->post_id = $post->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);
                $image->save();
            }
        }

        for ($i = 0; $i < $this->postCount; $i++) {
            $post = Post::factory()->create(['purpose' => 'sale']);

            for ($j = 0; $j < 5; $j++) {

                $filename = 'car_' . rand(1, 8) . '.jpg';
                $dir = 'upload/test';

                $image = new Image();
                $image->post_id = $post->id;
                $image->name = $filename;
                $image->path = $dir;
                $image->url = url($dir . '/' . $filename);
                $image->save();
            }
        }
    }
}
