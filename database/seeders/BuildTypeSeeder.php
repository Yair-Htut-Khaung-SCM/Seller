<?php

namespace Database\Seeders;

use App\Models\BuildType;
use Illuminate\Database\Seeder;

class BuildTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $build_types = [
            'SUV',
            'Sedan',
            'Coupe',
            'Convertible',
            'Hatchback',
            'Pickup',
            'Van',
            'Minivan',
            'Wagon'
        ];

        foreach ($build_types as $build_type) {
            BuildType::create([
                'name' => $build_type,
            ]);
        }
    }
}
