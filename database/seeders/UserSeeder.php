<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // Membuat user admin
        $adminUser  = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'position' => 'admin',
            'password' => Hash::make('admin123'), // Menggunakan Hash untuk menyimpan password
        ]);

        $pharmacistUser  = User::create([
            'name' => 'Pharmacist User',
            'email' => 'pharmacist@example.com',
            'position' => 'pharmacist',
            'password' => Hash::make('pharmacist123'), // Menggunakan Hash untuk menyimpan password
        ]);

    }
}