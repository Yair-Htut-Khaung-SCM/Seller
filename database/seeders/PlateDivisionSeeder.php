<?php

namespace Database\Seeders;

use App\Models\PlateDivision;
use Illuminate\Database\Seeder;

class PlateDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plate_divisions = [
            'YGN',
            'MDY',
            'AYY',
            'SGG',
            'BGO',
            'SHN',
            'MGW',
            'RKE',
            'MON',
            'KYN',
            'TNI',
            'KCN',
            'CHN',
            'KYH',
            'NPW',
        ];

        foreach ($plate_divisions as $plate_division) {
            PlateDivision::create([
                'name' => $plate_division,
            ]);
        }
    }
}
