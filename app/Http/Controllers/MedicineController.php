<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Restock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MedicineExport;                 

class MedicineController extends Controller
{
    public function export()
    {
        return Excel::download(new MedicineExport, 'medicines.xlsx');
    }

    public function exportPdf()
{
    // Ambil data dari model
    $medicines = Medicine::select('id', 'name', 'category_id', 'stock', 'price', 'expiry_date')->get();

    // Render view dengan data
    $pdf = Pdf::loadView('medicines.medicines-pdf', compact('medicines'));

    // Unduh file PDF
    return $pdf->download('medicines.pdf');
}
    
    public function index()
    {
        $medicines = Medicine::with(['category', 'supplier'])
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('medicines', compact('medicines'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = $request->input('categories');

        $medicines = Medicine::with(['category', 'supplier'])
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->when($categories && count($categories) > 0, function ($queryBuilder) use ($categories) {
                return $queryBuilder->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('name', $categories);
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('medicines.partials.table', compact('medicines'))->render()
            ]);
        }

        return view('medicines', compact('medicines'));
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