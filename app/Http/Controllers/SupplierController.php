<?php

namespace App\Http\Controllers;

use App\Models\Supplier;                    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SupplierExport;       

class SupplierController extends Controller
{

      public function export()
    {
        return Excel::download(new SupplierExport, 'suppliers.xlsx');
    }

    public function exportPdf()
{
    $suppliers = Supplier::select('id', 'name', 'phone', 'email', 'address', 'created_at', 'updated_at')
        ->get()
        ->map(function ($supplier) {
            return [
                'Supplier ID' => (string) $supplier->id,
                'Supplier Name' => (string) $supplier->name,
                'Phone' => (string) $supplier->phone,
                'Email' => (string) $supplier->email,
                'Address' => (string) $supplier->address,
                'Created At' => $supplier->created_at->format('d/m/Y H:i'),
                'Updated At' => $supplier->updated_at->format('d/m/Y H:i'),
            ];
        });

    try {
        $pdf = Pdf::loadView('suppliers.supplier-pdf', compact('suppliers'));
        
        // Set konfigurasi DomPDF
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', false);
        $pdf->getDomPDF()->set_option('defaultFont', 'DejaVu Sans');
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', false);
        
        $pdf->setPaper('A4', 'landscape'); // Landscape untuk tabel yang lebar
        
        return $pdf->download('suppliers-report-' . date('Y-m-d') . '.pdf');
    } catch (\Exception $e) {
        Log::error('PDF Error: ' . $e->getMessage());
        return response('Error: ' . $e->getMessage(), 500);
    }
}
    
    public function update(Request $request, $id) {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'supplier_name' => 'required|string|max:255',
                'phone' => 'required|regex:/^\+62[0-9]{9,13}$/',
                'email' => 'required|email',            
                'address' => 'required|string|max:255',
            ]);

            // Temukan supplier berdasarkan ID
            $supplier = Supplier::findOrFail($id);

            // Update data supplier
            $supplier->update([
                'name' => $request->input('supplier_name'),
                'phone' => $request->input('phone'),    
                'email' => $request->input('email'),                        
                'address' => $request->input('address'),
            ]);

            return Redirect::to('/suppliers')->with('success', 'Supplier updated successfully');            
        } catch (\Exception $e) {
            Log::error('Error saving medicine: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving medicine', 'error' => $e->getMessage()], 500);
        }       
    }

    public function destroy($id) {
      $supplier = Supplier::findOrFail($id);            
      $supplier->delete();          
      return Redirect::to('/suppliers')->with('success', 'Supplier deleted successfully');          
    }

    public function create(Request $request)
{
    try {
        // Validasi data yang diterima dari form
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone' => 'required|regex:/^\+62[0-9]{9,13}$/',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
        ]);

        // Simpan supplier baru
        Supplier::create([
            'name' => $request->input('supplier_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ]);

        return Redirect::to('/suppliers')->with('success', 'Supplier created successfully');
    } catch (\Exception $e) {
        Log::error('Error creating supplier: ' . $e->getMessage());
        return response()->json(['message' => 'Error creating supplier', 'error' => $e->getMessage()], 500);
    }
}
}