<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'user_id' => User::factory(),
            'sale_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 10, 500),
            'payment_status' => $this->faker->randomElement(['Paid', 'Unpaid']),
        ];
    }
}