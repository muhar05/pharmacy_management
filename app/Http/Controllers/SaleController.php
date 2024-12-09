<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Exception;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        try {
            $userId = Auth::id();

            // Validasi incoming request data
            $request->validate([
                'customer' => 'required|string',
                'customer_phone' => 'required|string',
                'customer_address' => 'required|string',
                'sale_date' => 'required|date',
                'total_amount' => 'required|numeric',
                'payment_status' => 'required|in:Paid,Unpaid',
                'doctor_name' => 'string',
                'doctor_phone' => 'string',
                'medicines' => 'required|array',
                'medicines.*.medicine_id' => 'required|exists:medicines,id',
                'medicines.*.quantity' => 'required|integer|min:1',
                'medicines.*.price' => 'required|numeric',
            ]);

            // Check if the customer exists by name
            $customerName = $request->input('customer');
            $customer = Customer::where('name', $customerName)->first();

            // If the customer does not exist, create a new one
            if (!$customer) {
                $customer = Customer::create([
                    'name' => $customerName,
                    'phone' => $request->input('customer_phone'),
                    'address' => $request->input('customer_address'),
                ]);
            }

            // Create a new sale record
            $sale = Sale::create([
                'customer_id' => $customer->id,
                'user_id' => $userId,
                'sale_date' => $request->input('sale_date'),
                'total_amount' => $request->input('total_amount'),
                'payment_status' => $request->input('payment_status'),
                'doctor_name' => $request->input('doctor_name'),
                'doctor_phone' => $request->input('doctor_phone'),
            ]);

            // Loop through medicines and process each one
            foreach ($request->medicines as $medicine) {
                // Ambil medicine dari database
                $med = Medicine::find($medicine['medicine_id']);

                // Cek apakah medicine ditemukan
                if (!$med) {
                    return response()->json(['error' => 'Medicine not found: ' . $medicine['medicine_id']], 404);
                }

                // Cek apakah stok cukup
                if ($med->stock < $medicine['quantity']) {
                    return response()->json(['error' => 'Not enough stock for medicine: ' . $med->name], 400);
                }

                // Hitung total harga
                $totalPrice = $medicine['quantity'] * $medicine['price'];

                // Simpan detail penjualan
                $sale->saleDetails()->create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $medicine['medicine_id'],
                    'quantity' => $medicine['quantity'],
                    'price' => $medicine['price'],
                    'total_price' => $totalPrice,
                ]);

                // Kurangi stok medicine
                $med->stock -= $medicine['quantity'];
                $med->save(); // Simpan perubahan stok ke database
            }

            return response()->json($sale->load('saleDetails'), 201);
        } catch (\Exception $e) {
            Log::error('Error creating sale: ' . $e->getMessage() . ' on line ' . $e->getLine());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}