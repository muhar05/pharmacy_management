<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SaleExport implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
     * Return the collection of data for export.
     */
    public function collection()
    {
        return Sale::with('customer')
            ->get()
            ->map(function ($sale) {
                return [
                    'Customer ID' => $sale->customer_id,
                    'Customer Name' => optional($sale->customer)->name ?? 'No Customer',
                    'Sales Date' => $sale->sale_date,
                    'Total Amount' => 'Rp ' . number_format($sale->total_amount, 0, ',', '.'),
                    'Payment Status' => $sale->payment_status,
                    'Created At' => $sale->created_at->format('Y-m-d H:i:s'),
                    'Updated At' => $sale->updated_at->format('Y-m-d H:i:s'),
                ];
            });
    }

    /**
     * Define the headings for the exported file.
     */
    public function headings(): array
    {
        return [
            'Customer ID',
            'Customer Name',
            'Sales Date',
            'Total Amount',
            'Payment Status',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * Define column widths for the exported file.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 15, // Customer ID
            'B' => 25, // Customer Name
            'C' => 20, // Sales Date
            'D' => 20, // Total Amount
            'E' => 20, // Payment Status
            'F' => 25, // Created At
            'G' => 25, // Updated At
        ];
    }
}