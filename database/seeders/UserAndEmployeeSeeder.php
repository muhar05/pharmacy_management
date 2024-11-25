<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAndEmployeeSeeder extends Seeder
{
    public function run(): void
    {

        // Membuat user admin
        $adminUser  = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Menggunakan Hash untuk menyimpan password
        ]);

        // Membuat employee untuk admin
        Employee::create([
            'name' => $adminUser->name,
            'position' => 'admin',
            'phone' => '081234567890',
            'email' => $adminUser->email,
            'user_id' => $adminUser->id,
        ]);

        $pharmacistUser  = User::create([
            'name' => 'Pharmacist User',
            'email' => 'pharmacist@example.com',
            'password' => Hash::make('pharmacist123'), // Menggunakan Hash untuk menyimpan password
        ]);

        Employee::create([  
            'name' => $pharmacistUser->name,
            'position' => 'pharmacist',
            'phone' => '081234567890',
            'email' => $pharmacistUser->email,
            'user_id' => $pharmacistUser->id,
        ]);
    }
}