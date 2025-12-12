<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Medicine;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SaleExport;     

use Exception;

class SaleController extends Controller
{
        public function export()
    {
        return Excel::download(new SaleExport, 'sales.xlsx');
    }

    public function exportPdf()
{
    $sales = Sale::with('customer')
        ->select('id', 'customer_id', 'sale_date', 'total_amount', 'payment_status', 'created_at', 'updated_at')
        ->get()
        ->map(function ($sale) {
            return [
                'Customer ID' => (string) $sale->customer_id,
                'Customer Name' => (string) (optional($sale->customer)->name ?? 'No Customer'),
                'Sales Date' => (string) $sale->sale_date,
                'Total Amount' => (float) $sale->total_amount,
                'Payment Status' => (string) $sale->payment_status,
                'Created At' => $sale->created_at->format('d/m/Y H:i'),
                'Updated At' => $sale->updated_at->format('d/m/Y H:i'),
            ];
        });

    try {
        $pdf = Pdf::loadView('sales.sales-pdf', compact('sales'));
        
        // Set konfigurasi DomPDF
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', false);
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', false);
        
        $pdf->setPaper('A4', 'landscape'); // Landscape untuk tabel yang lebar
        
        return $pdf->download('sales-report-' . date('Y-m-d') . '.pdf');
    } catch (\Exception $e) {
        Log::error('PDF Error: ' . $e->getMessage());
        return response('Error: ' . $e->getMessage(), 500);
    }
}
    public function store(Request $request)
    {
        try {
            $userId = Auth::id();

            // Validasi request
            $request->validate([
                'customer_id' => 'nullable|exists:customers,id',
                'customer_name' => 'required_without:customer_id|string|max:100',
                'customer_phone' => 'required_without:customer_id|string',
                'customer_address' => 'required_without:customer_id|string',
                'sale_date' => 'required|date',
                'total_amount' => 'required|numeric',
                'payment_status' => 'required|in:Paid,Unpaid',
                'doctor_name' => 'string|nullable',
                'doctor_phone' => 'string|nullable',
                'medicines' => 'required|array',
                'medicines.*.medicine_id' => 'required|exists:medicines,id',
                'medicines.*.quantity' => 'required|integer|min:1',
                'medicines.*.price' => 'required|numeric',
            ]);

            // Cek apakah customer terdaftar atau customer baru
            if ($request->customer_id) {
                $customer = Customer::find($request->customer_id);
            } else {
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
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

   public function update(Request $request, $id) {
    try {  
        $sale = Sale::findOrFail($id);

        // Validasi incoming request data
        $request->validate([    
            'payment_status' => 'required|in:Paid,Unpaid',
            'customer_name' => 'required|string|max:100',
            'sale_date' => 'required|date', 
        ]);

        // Periksa apakah customer_name sudah ada di tabel customers
        $customer = Customer::where('name', $request->customer_name)->first();

        if (!$customer) {
            // Jika tidak ada, buat customer baru
            $customer = Customer::create([
                'name' => $request->customer_name,
                'phone' => $request->customer_phone,    
                'address' => $request->customer_address,
            ]);
        }

        // Perbarui data penjualan dengan customer_id dari tabel Customer
        $sale->update([
            'customer_id' => $customer->id,
            'payment_status' => $request->payment_status,
            'sale_date' => $request->sale_date,
        ]);

        return Redirect::to('/sales')->with('success', 'Medicine updated successfully!');
    } catch (Exception $e) {
        Log::error('Error updating sale: ' . $e->getMessage() . ' on line ' . $e->getLine());       
        return response()->json(['error' => $e->getMessage()], 500);    
    }
}
    

    public function destroy($id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->delete();
            return Redirect::to('/sales')->with('success', 'Sale deleted successfully');
        } catch (Exception $e) {
            Log::error('Error deleting sale: ' . $e->getMessage() . ' on line ' . $e->getLine());                   
            return response()->json(['error' => $e->getMessage()], 500);            
        }
    }
}