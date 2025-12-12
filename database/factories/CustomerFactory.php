<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->generateIndonesianPhoneNumber(),
            'address' => $this->faker->address(),
            'disease' => $this->faker->randomElement([
                'Hipertensi', 'Diabetes', 'Asma', 'Demam', 'Flu', 'Covid-19', 'Gastritis', 'Migraine', 'Tidak ada', 'Lainnya'
            ]),
        ];
    }

    private function generateIndonesianPhoneNumber(): string
    {
        // Awali nomor dengan +62
        $prefix = '+62';

        // Generate nomor acak (9-13 digit setelah +62)
        $number = $this->faker->numerify('##########'); // 10 angka acak

        // Gabungkan
        return $prefix . $number;
    }
}
