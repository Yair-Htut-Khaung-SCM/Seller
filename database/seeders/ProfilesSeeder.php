<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'user_id' => User::create([
                'name' => 'Zeus',
                'email' => 'zeus@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('zeus'),
            ])->id,
            'status' => 'Normal User',
        ]);

        for ($i = 0; $i < 5; $i++) {
            Profile::create([
                'user_id' => User::factory()->create()->id,              
            ]);

        }
    }
}
