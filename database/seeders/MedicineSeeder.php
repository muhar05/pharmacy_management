<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        // Definisikan kategori sesuai dengan kebutuhan jika belum ada
        $categories = [
            ['name' => 'Obat Keras'],
            ['name' => 'Obat Bebas'],
            ['name' => 'Obat Bebas Terbatas'],
        ];

        // Buat kategori jika belum ada
        foreach ($categories as $categoryData) {
            Category::firstOrCreate(['name' => $categoryData['name']]);
        }

        // Hitung jumlah obat di MedicineFactory
        $medicineCount = count([
            ['name' => 'Sanmol Forte'],
            ['name' => 'Panadol'],
            ['name' => 'Bodrex'],
            ['name' => 'Novaxiven'],
            ['name' => 'Dolofen-F'],
            ['name' => 'Proris'],
            ['name' => 'Mylanta'],
            ['name' => 'Promag'],
            ['name' => 'Lexacrol'],
            ['name' => 'Zecamax'],
            ['name' => 'Aflucaps'],
            ['name' => 'Trifachlor'],
            ['name' => 'Incidal'],
            ['name' => 'Ryvel'],
            ['name' => 'Cetirgi'],
            ['name' => 'Siladex'],
            ['name' => 'Sanadryl DMP'],
            ['name' => 'Dextral'],
            ['name' => 'Amoxsan'],
            ['name' => 'Lapimox'],
            ['name' => 'Amoxicillin Hexapharm'],
            ['name' => 'Xanax'],
            ['name' => 'Alprazolam'],
            ['name' => 'Atarax'],
        ]);

        // Buat data obat sesuai jumlah yang ada di factory
        Medicine::factory($medicineCount)->create();
    }
}
