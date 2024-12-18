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
    // Ambil data dari model
    $suppliers = Supplier::select('id', 'name', 'phone', 'address', 'email', 'created_at', 'updated_at')->get();

    // Render view dengan data
    $pdf = Pdf::loadView('suppliers.supplier-pdf', compact('suppliers'));

    // Set Orientasi dan Ukuran Halaman
    $pdf->setPaper('A4', 'landscape'); // Set kertas A4 dengan orientasi landscape

    // Unduh file PDF
    return $pdf->download('suppliers.pdf');
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
}