<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BuildType;
use Illuminate\Support\Str;
use App\Models\Manufacturer;
use App\Models\PlateDivision;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all(['id'])->random(),
            'purpose' => 'buy',
            'condition' =>  'Used',
            'manufacturer_id' => Manufacturer::all(['id'])->random(),
            'car_model' => "Optima",
            'year' => rand(2000, 2022),
            'price' => rand(100, 1500),
            'build_type_id' => BuildType::all(['id'])->random(),
            'trim_name' => 'GLX',
            'engine_power' => rand(1000, 5000),
            'steering_position' => 'Left',
            'transmission' => 'Auto',
            'gear' => '10',
            'fuel_type' => 'Petrol',
            'color' => 'Matellic Gray',
            'vin' => Str::random(16),
            'licence_status' => "With Licence",
            'plate_number' => '99Z-1999',
            'plate_color' => 'Black',
            'plate_division_id' => PlateDivision::all(['id'])->random(),
            'seat' => rand(2, 7),
            'door' => rand(2, 5),
            'mileage' => rand(0, 200000),
            'owner_count' => rand(1, 5),
            'description' => $this->faker->sentence(10),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,

        ];
    }
}
