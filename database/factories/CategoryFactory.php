<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    private static $categories = [
        'Obat Keras' => 'adalah obat yang hanya boleh dibeli menggunakan resep dokter. Tempat penjualan di Apotek.',
        'Obat Bebas' => 'adalah obat yang dijual bebas di pasaran dan dapat dibeli tanpa resep dokter. Tempat penjualan di Apotek dan Toko Obat Berijin.',
        'Obat Bebas Terbatas' => 'adalah obat yang dapat dibeli secara bebas tanpa menggunakan resep dokter, namun mempunyai peringatan khusus saat menggunakannya. Tempat penjualan di Apotek dan Toko Obat Berijin.',
    ];

    public function definition(): array
    {
        // Mengambil semua nama kategori yang tersedia
        $availableCategories = array_keys(self::$categories);

        // Mengambil kategori berdasarkan indeks saat ini (supaya unik jika menggunakan count terbatas)
        $categoryIndex = $this->faker->unique()->numberBetween(0, count($availableCategories) - 1);

        $categoryName = $availableCategories[$categoryIndex];

        return [
            'name' => $categoryName,
            'description' => self::$categories[$categoryName],
        ];
    }
}