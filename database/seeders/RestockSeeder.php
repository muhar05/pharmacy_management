<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Restock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestockSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = Medicine::all();

        foreach ($medicines as $medicine) {
            Restock::factory()->create([
                'medicine_id' => $medicine->id,
                'quantity' => rand(10, 50),
                'restock_date' => now(),
            ]);
        }
    }
}