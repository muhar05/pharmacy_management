<?php

namespace Database\Factories;

use App\Models\Medicine;
use App\Models\Restock;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestockFactory extends Factory
{
    protected $model = Restock::class;

    public function definition()
    {
        return [
            'medicine_id' => Medicine::factory(),
            'quantity' => $this->faker->numberBetween(1, 50),
            'restock_date' => $this->faker->date(),
        ];
    }
}