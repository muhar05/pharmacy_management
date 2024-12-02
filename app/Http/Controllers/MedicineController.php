<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Restock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();

        foreach ($medicines as $medicine) {
            echo $medicine->name . ' - ' . formatRupiah($medicine->price) . '<br>';
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Mendapatkan input pencarian
        $categories = $request->input('categories'); // Mendapatkan input kategori

        // Query to fetch medicines based on name or category
        $medicines = Medicine::with(['category', 'supplier']) // Eager load category and supplier
            ->when($query, function ($queryBuilder) use ($query) {
                // Search by medicine name
                return $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->when($categories && count($categories) > 0, function ($queryBuilder) use ($categories) {
                // Search by category name
                return $queryBuilder->whereHas('category', function ($query) use ($categories) {
                    $query->whereIn('name', $categories); // Filter by category name
                });
            })
            ->get();

        // Eksekusi query dan format hasilnya
        $results = $medicines->map(function ($medicine) {
            return [
                'id' => $medicine->id,
                'name' => $medicine->name,
                'category' => $medicine->category->name ?? 'N/A', // Menangani jika tidak ada kategori
                'stock' => $medicine->stock,
                'price' => $medicine->price,
                'supplier_name' => $medicine->supplier->name ?? 'N/A', // Menangani jika tidak ada supplier
                'type' => $medicine->type,
                'expiry_date' => $medicine->expiry_date,
                'formatted_expiry_date' => $medicine->expiry_date
                    ? \Carbon\Carbon::parse($medicine->expiry_date)->format('d F Y')
                    : '-', // Pastikan ini tidak memanggil parse jika null
                'description' => $medicine->description
            ];
        });

        // Mengembalikan hasil dalam bentuk JSON
        return response()->json($results);
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|integer',
                'supplier_name' => 'required|string|max:255', // Menggunakan supplier_name sebagai input
                'stock' => 'required|integer',
                'type' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
                'price' => 'required|numeric',
                'minimum_stock' => 'required|integer',
                'dosage' => 'required|string|max:255',
                'instructions' => 'required|string|max:255',
                'expiry_date' => 'required|date',
                'description' => 'required|string|max:255',
            ]);

            // Cek apakah supplier dengan nama yang sama sudah ada
            $supplier = Supplier::where('name', $request->input('supplier_name'))->first();

            // Jika supplier tidak ada, buat supplier baru
            if (!$supplier) {
                $supplier = Supplier::create([
                    'name' => $request->input('supplier_name'),
                    'address' => '',
                    'phone' => '',
                    'email' => '',
                ]);
            }

            if (!$supplier || !$supplier->id) {
                Log::error('Supplier not found or created.');
                return response()->json(['message' => 'Supplier creation failed.'], 500);
            } else {
                Log::info('Supplier ID: ' . $supplier->id);
            }

            $requirePrescription = $request->input('category_id') == 3;
            Log::info('Require Prescription: ' . ($requirePrescription ? 'Yes' : 'No'));

            // Buat record medicine dengan menggunakan supplier_id
            $medicine = Medicine::create([
                'name' => $request->input('name'),
                'category_id' => (int) $request->input('category_id'),
                'supplier_id' => $supplier->id, // Gunakan supplier_id yang sudah ada atau baru
                'stock' => $request->input('stock'),
                'type' => $request->input('type'),
                'price' => $request->input('price'),
                'minimum_stock' => $request->input('minimum_stock'),
                'dosage' => $request->input('dosage'),
                'instructions' => $request->input('instructions'),
                'unit' => $request->input('unit'),
                'expiry_date' => $request->input('expiry_date'),
                'description' => $request->input('description'),
                'require_prescription' => $requirePrescription,
            ]);

            // Buat record restock
            $restock = new Restock([
                'medicine_id' => $medicine->id,
                'quantity' => $request->input('stock'),
                'restock_date' => now(),
            ]);

            $restock->save();

            return Redirect::to('/medicines');
        } catch (\Exception $e) {
            Log::error('Error saving medicine: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving medicine', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'name' => 'required|string|max:255',
                'supplier_name' => 'required|string|max:255',
                'stock' => 'required|integer',
                'minimum_stock' => 'required|integer',
                'type' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
                'expiry_date' => 'required|date',
                'description' => 'required|string|max:255',
                'dosage' => 'required|string|max:255',
                'instructions' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
            ]);

            // Temukan item obat berdasarkan ID
            $medicine = Medicine::findOrFail($id);

            // Cari ID supplier berdasarkan supplier_name
            $supplier = Supplier::where('name', $request->supplier_name)->first();

            // Jika supplier tidak ada, buat supplier baru
            if (!$supplier) {
                $supplier = Supplier::create([
                    'name' => $request->input('supplier_name'),
                    'address' => '',
                    'phone' => '',
                    'email' => '',
                ]);
            }

            // Tentukan apakah memerlukan resep berdasarkan category_id
            $requirePrescription = $request->category_id == 3;

            // Perbarui data obat dengan data yang diterima dari form
            $medicine->update([
                'name' => $request->name,
                'supplier_id' => $supplier->id, // Menggunakan ID supplier yang ditemukan atau baru dibuat
                'stock' => $request->stock,
                'minimum_stock' => $request->minimum_stock,
                'type' => $request->type,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'expiry_date' => $request->expiry_date,
                'description' => $request->description,
                'dosage' => $request->dosage,
                'instructions' => $request->instructions,
                'unit' => $request->unit,
                'require_prescription' => $requirePrescription, // Menyimpan status resep
            ]);

            // Redirect ke halaman medicines setelah update
            return Redirect::to('/medicines')->with('success', 'Medicine updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error saving medicine: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving medicine', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return Redirect::to('/medicines');
    }
}