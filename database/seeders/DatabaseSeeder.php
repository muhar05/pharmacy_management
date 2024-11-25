<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            UserAndEmployeeSeeder::class,
            MedicineSeeder::class,
            RestockSeeder::class,
            CustomerSeeder::class,
            SaleAndSaleDetailSeeder::class,
        ]);
    }
}