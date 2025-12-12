<?php

namespace App\Exports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicineExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data.
     */
    public function collection()
    {
        return Medicine::select('id', 'name', 'category_id', 'stock', 'price', 'expiry_date')->get();
    }

    /**
     * Add headings to the exported file.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category ID',
            'Stock',
            'Price',
            'Expiry Date',
        ];
    }
}