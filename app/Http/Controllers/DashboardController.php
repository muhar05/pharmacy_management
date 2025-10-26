<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
public function index(Request $request)
{
    // Ambil periode dari request, default ke 'daily'
    $period = $request->input('period', 'daily');

    // Hitung total amount penjualan berdasarkan periode
    $totalSales = Sale::when($period === 'daily', function ($query) {
        return $query->whereDate('created_at', today());
    })
    ->when($period === 'weekly', function ($query) {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    })
    ->when($period === 'monthly', function ($query) {
        return $query->whereMonth('created_at', now()->month);
    })
    ->sum('total_amount');

    // Hitung jumlah transaksi berdasarkan periode
    $transactionCount = Sale::when($period === 'daily', function ($query) {
        return $query->whereDate('created_at', today());
    })
    ->when($period === 'weekly', function ($query) {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    })
    ->when($period === 'monthly', function ($query) {
        return $query->whereMonth('created_at', now()->month);
    })
    ->count();

    // Menghitung best seller berdasarkan periode
    $bestSeller = SaleDetail::when($period === 'daily', function ($query) {
        return $query->whereHas('sale', function ($query) {
            $query->whereDate('created_at', today());
        });
    })
    ->when($period === 'weekly', function ($query) {
        return $query->whereHas('sale', function ($query) {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        });
    })
    ->when($period === 'monthly', function ($query) {
        return $query->whereHas('sale', function ($query) {
            $query->whereMonth('created_at', now()->month);
        });
    })
    ->select('medicine_id', DB::raw('SUM(quantity) as total_quantity'))
    ->groupBy('medicine_id')
    ->orderBy('total_quantity', 'desc')
    ->first();

    // Jika best seller ditemukan, ambil nama obatnya
    $bestSellerName = $bestSeller ? $this->getMedicineName($bestSeller->medicine_id) : 'N/A';

    // Ambil obat-obat dengan stok rendah (2 terendah)
    $lowStockMedicinesQuery = Medicine::where('stock', '<', DB::raw('minimum_stock'));
    $lowStockCount = (clone $lowStockMedicinesQuery)->count();
    $lowStockMedicines = (clone $lowStockMedicinesQuery)
        ->orderBy('stock', 'asc')
        ->take(2)
        ->get();

    // Ambil obat-obat yang kadaluarsa dalam 30 hari (2 terdekat)
    $expiringMedicinesQuery = Medicine::whereBetween('expiry_date', [now(), now()->addDays(30)]);
    $expiringCount = (clone $expiringMedicinesQuery)->count();
    $expiringMedicines = (clone $expiringMedicinesQuery)
        ->orderBy('expiry_date', 'asc')
        ->take(2)
        ->get();

    // Jika permintaan AJAX, kembalikan data dalam format JSON
    if ($request->ajax()) {
        return response()->json([
            'totalSales' => $totalSales,
            'transactionCount' => $transactionCount,
            'bestSeller' => $bestSellerName,
            'lowStockMedicines' => $lowStockMedicines,
            'expiringMedicines' => $expiringMedicines,
            'lowStockCount' => $lowStockCount,
            'expiringCount' => $expiringCount,
        ]);
    }

    // Kembalikan data ke view
    return view('dashboard', [
        'totalSales' => $totalSales,
        'transactionCount' => $transactionCount,
        'bestSeller' => $bestSellerName,
        'period' => $period,
        'lowStockMedicines' => $lowStockMedicines,
        'expiringMedicines' => $expiringMedicines,
        'lowStockCount' => $lowStockCount,
        'expiringCount' => $expiringCount,
    ]);
}
    // Fungsi untuk mendapatkan nama obat berdasarkan medicine_id
    private function getMedicineName($medicineId)
    {
        // Ganti dengan model yang sesuai untuk mendapatkan nama obat
        $medicine = Medicine::find($medicineId); // Pastikan Anda memiliki model Medicine
        return $medicine ? $medicine->name : 'N/A';
    }
}