<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
}
