<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = [
            'Acura',
            'Alfa-Romeo',
            'Aston Martin',
            'Audi',
            'BMW',
            'Bentley',
            'Buick',
            'Cadilac',
            'Chevrolet',
            'Chrysler',
            'Daewoo',
            'Daihatsu',
            'Dodge',
            'Eagle',
            'Ferrari',
            'Fiat',
            'Fisker',
            'Ford',
            'Freighliner',
            'GMC',
            'Genesis',
            'Geo',
            'Honda',
            'Hummer',
            'Hyundai',
            'Infinity',
            'Isuzu',
            'Jaguar',
            'Jeep',
            'Kia',
            'Lamborghini',
            'Land Rover',
            'Lexus',
            'Lincoln',
            'Lotus',
            'Mazda',
            'Maserati',
            'Maybach',
            'McLaren',
            'Mercedez-Benz',
            'Mercury',
            'Mini',
            'Mitsubishi',
            'Nissan',
            'Oldsmobile',
            'Panoz',
            'Plymouth',
            'Polestar',
            'Pontiac',
            'Porsche',
            'Ram',
            'Rivian',
            'Rolls_Royce',
            'Saab',
            'Saturn',
            'Smart',
            'Subaru',
            'Suzuki',
            'Tesla',
            'Toyota',
            'Volkswagen',
            'Volvo',
        ];

        foreach ($manufacturers as $manufacturer) {
            Manufacturer::create([
                'name' => $manufacturer,
            ]);
        }
    }
}
