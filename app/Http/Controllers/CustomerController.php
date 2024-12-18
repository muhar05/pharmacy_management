<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CustomerExport;       

class CustomerController extends Controller
{
        public function export()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }

    public function exportPdf()
{
    // Ambil data dari model
    $customers = Customer::select('id', 'name', 'phone', 'address', 'created_at', 'updated_at')->get();

    // Render view dengan data
    $pdf = Pdf::loadView('customers.customer-pdf', compact('customers'));

    // Unduh file PDF
    return $pdf->download('customer.pdf');
}
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^\+62[0-9]{9,13}$/'], // Nomor Indonesia
            'address' => 'required|string|max:255',
        ]);

        Customer::create($validated);

        return response()->json(['message' => 'Customer created successfully']);
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => ['required', 'regex:/^\+62[0-9]{9,13}$/'], // Nomor Indonesia    
            'address' => 'required|string|max:255',     
        ]);

        $customer = Customer::findOrFail($id);      

         // Update data supplier
            $customer->update([
                'name' => $request->input('customer_name'),
                'phone' => $request->input('phone'),                           
                'address' => $request->input('address'),
            ]);
        
        return Redirect::to('/customers')->with('success', 'Customer updated successfully');        
        }
        catch (\Exception $e) {     
            return response()->json(['message' => 'Error saving customer', 'error' => $e->getMessage()], 500);              
        }
    }

    public function destroy($id) {
        try {
         $customer = Customer::findOrFail($id);            
      $customer->delete();          
      return Redirect::to('/customers')->with('success', 'Customer deleted successfully');          
        }
        catch (\Exception $e) {     
            return response()->json(['message' => 'Error deleting customer', 'error' => $e->getMessage()], 500);              
        }
    }
}