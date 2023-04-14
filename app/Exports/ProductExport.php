<?php

namespace App\Exports;

use App\Models\Product;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select('product_name', 'category_id', 'supplier_id', 'product_code', 'product_garage', 'product_image', 'product_store', 'buying_date', 'expire_date', 'buying_price', 'selling_price')->get();
    }


    public function headings(): array
    {
        return [
            'Name',
            'Category_id',
            'supplier_id',
            'product_code',
            'product_garage',
            'Product Image',
            'product_store',
            'buying_date',
            'expire_date',
            'buying_price',
            'selling_price',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        $headerRange = 'A1:K1'; // The range of cells that contain the header labels
        $sheet->getStyle($headerRange)->getFont()->setBold(true);


        // Set heading row to all caps
        // $sheet->getStyle('1')->applyFromArray([
        //     'font' => [
        //         'bold' => true,
        //         'text-transform' => 'uppercase'
        //     ]
        // ]);
    }


    
}
