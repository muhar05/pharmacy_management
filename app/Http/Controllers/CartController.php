<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $medicine = Medicine::find($request->medicine_id);

        // Cek apakah obat termasuk kategori 3 (obat keras)
        if ($medicine->category_id == 3 && !$request->user()->hasPrescription()) {
            return redirect()->back()->with('error', 'Obat ini memerlukan resep dokter untuk dibeli.');
        }

        // Tambahkan item ke keranjang
        $cart = session()->get('cart', []);

        if (isset($cart[$medicine->id])) {
            $cart[$medicine->id]['quantity'] += $request->quantity;
        } else {
            $cart[$medicine->id] = [
                'name' => $medicine->name,
                'quantity' => $request->quantity,
                'price' => $medicine->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Obat berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}