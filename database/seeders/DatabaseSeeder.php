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
        
        $this->call(AdminUserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ProfileImageSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(BuildTypeSeeder::class);
        $this->call(PlateDivisionSeeder::class);
        $this->call(PostSeeder::class);
    }
}
