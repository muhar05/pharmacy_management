<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();

        foreach ($medicines as $medicine) {
            echo $medicine->name . ' - ' . formatRupiah($medicine->price) . '<br>';
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'supplier_name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'expiry_date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $medicine = Medicine::create([
            'name' => $request->name,
            'supplier_name' => $request->supplier_name,
            'stock' => $request->stock,
            'type' => $request->type,
            'category' => $request->category,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description
        ]);

        return Redirect::to('/medicines');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'supplier_name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'expiry_date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update([
            'name' => $request->name,
            'supplier_name' => $request->supplier_name,
            'stock' => $request->stock,
            'type' => $request->type,
            'category' => $request->category,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description
        ]);

        return Redirect::to('/medicines');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return Redirect::to('/medicines');
    }
}