<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition()
    {
        $categories = [
            'Obat Keras',
            'Obat Bebas',
            'Obat Bebas Terbatas',
            'Obat Wajib Apotek (OWA)',
            'Obat Herbal'
        ];

        $types = [
            'Suntikan',
            'Infus',
            'Injeksi',
            'Obat Tetes',
            'Sirop',
            'Salep',
            'Krim',
            'Gel',
            'Tablet',
            'Kapsul',
            'Serbuk',
            'Suppositoria'
        ];

        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement($categories),
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => mt_rand(10, 500) * 1000,
            'supplier_name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'expiry_date' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'type' => $this->faker->randomElement($types),
        ];
    }
}
