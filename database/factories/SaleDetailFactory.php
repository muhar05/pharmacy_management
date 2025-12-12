<?php

namespace Database\Factories;

use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleDetailFactory extends Factory
{
    protected $model = SaleDetail::class;

    public function definition()
    {
        return [
            'sale_id' => Sale::factory(),
            'medicine_id' => Medicine::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'total_price' => fn(array $attributes) => $attributes['price'] * $attributes['quantity'],
        ];
    }
}