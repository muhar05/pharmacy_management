<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition()
    {
        $medicines = [
            ['name' => 'Sanmol Forte', 'description' => 'Pereda nyeri dan demam', 'category' => 'Obat Bebas'],
            ['name' => 'Panadol', 'description' => 'Pereda nyeri dan demam', 'category' => 'Obat Bebas'],
            ['name' => 'Bodrex', 'description' => 'Pereda nyeri dan demam', 'category' => 'Obat Bebas'],
            ['name' => 'Novaxiven', 'description' => 'Pereda nyeri dan peradangan', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Dolofen-F', 'description' => 'Pereda nyeri dan peradangan', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Proris', 'description' => 'Pereda nyeri dan peradangan', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Mylanta', 'description' => 'Asam Lambung', 'category' => 'Obat Bebas'],
            ['name' => 'Promag', 'description' => 'Asam Lambung', 'category' => 'Obat Bebas'],
            ['name' => 'Lexacrol', 'description' => 'Asam Lambung', 'category' => 'Obat Bebas'],
            ['name' => 'Zecamax', 'description' => 'Gejala alergi', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Aflucaps', 'description' => 'Gejala alergi', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Trifachlor', 'description' => 'Gejala alergi', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Incidal', 'description' => 'Gejala alergi dan gatal', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Ryvel', 'description' => 'Gejala alergi dan gatal', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Cetirgi', 'description' => 'Gejala alergi dan gatal', 'category' => 'Obat Bebas Terbatas'],
            ['name' => 'Siladex', 'description' => 'Batuk', 'category' => 'Obat Bebas'],
            ['name' => 'Sanadryl DMP', 'description' => 'Batuk', 'category' => 'Obat Bebas'],
            ['name' => 'Dextral', 'description' => 'Batuk', 'category' => 'Obat Bebas'],
            ['name' => 'Amoxsan', 'description' => 'Antibiotik', 'category' => 'Obat Keras'],
            ['name' => 'Lapimox', 'description' => 'Antibiotik', 'category' => 'Obat Keras'],
            ['name' => 'Amoxicillin Hexapharm', 'description' => 'Antibiotik', 'category' => 'Obat Keras'],
            ['name' => 'Xanax', 'description' => 'Gangguan Kecemasan', 'category' => 'Obat Keras'],
            ['name' => 'Alprazolam', 'description' => 'Gangguan Kecemasan', 'category' => 'Obat Keras'],
            ['name' => 'Atarax', 'description' => 'Gangguan Kecemasan', 'category' => 'Obat Keras'],
        ];

        $medicine = $this->faker->randomElement($medicines);
        $category = Category::where('name', $medicine['category'])->first();

        return [
            'name' => $medicine['name'],
            'category_id' => $category->id,
            'supplier_id' => Supplier::factory()->create()->id,
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => mt_rand(10, 500) * 1000,
            'description' => $medicine['description'],
            'expiry_date' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'unit' => $this->faker->randomElement(['Tablet', 'Kapsul', 'Sirup', 'Salep']),
            'dosage' => $this->faker->sentence(),
            'instructions' => $this->faker->sentence(),
            'require_prescription' => $medicine['category'] === 'Obat Keras',
            'minimum_stock' => $this->faker->numberBetween(0, 100),
            'type' => $this->faker->randomElement(['Suntikan', 'Infus', 'Injeksi', 'Tablet', 'Kapsul']),
        ];
    }
}