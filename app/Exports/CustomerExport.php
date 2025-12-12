<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class CustomerExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * Return the collection of data.
     */
    public function collection()
    {
        return Customer::select('id', 'name', 'phone', 'address', 'created_at', 'updated_at')->get();
    }

    /**
     * Add headings to the exported file.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name', 
            'Phone',
            'Address',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * Auto-size the columns after sheet generation.
     */
    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $sheet = $event->sheet;

                // Auto-size all columns
                foreach (range('A', 'F') as $column) {
                    $sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}