<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleteDataSeeder extends Seeder
{
    public function run(): void
    {
        // Menghapus semua data pada tabel 'users'
        DB::table('customers')->delete();
    }
}