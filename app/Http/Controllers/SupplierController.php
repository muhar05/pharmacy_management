<?php

namespace App\Http\Controllers;

use App\Models\Supplier;                    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
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