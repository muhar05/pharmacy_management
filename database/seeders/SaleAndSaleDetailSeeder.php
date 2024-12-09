<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleAndSaleDetailSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $medicines = Medicine::all();

        foreach (range(1, 20) as $index) {
            $sale = Sale::create([
                'customer_id' => $customers->random()->id,
                'user_id' => User::all()->random()->id, 
                'sale_date' => now(),
                'total_amount' => 0, // Akan diperbarui nanti
                'payment_status' => rand(0, 1) ? 'Paid' : 'Unpaid',
            ]);

            $totalAmount = 0;
            foreach ($medicines->random(rand(1, 3)) as $medicine) {
                $quantity = rand(1, 5);
                $price = $medicine->price;

                $saleDetail = SaleDetail::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $medicine->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $quantity * $price,
                ]);

                $totalAmount += $saleDetail->total_price;
            }

            $sale->update(['total_amount' => $totalAmount]);
        }
    }
}