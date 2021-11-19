<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithProperties, WithCustomStartCell
{
    public function properties(): array
    {
        return [
            'creator'        => 'Patrick Brouwers',
            'lastModifiedBy' => 'Patrick Brouwers',
            'title'          => 'Invoices Export',
            'description'    => 'Latest Invoices',
            'subject'        => 'Invoices',
            'keywords'       => 'invoices,export,spreadsheet',
            'category'       => 'Invoices',
            'manager'        => 'Patrick Brouwers',
            'company'        => 'Maatwebsite',
        ];
    }
    
    public function headings(): array
    {
        return [
            'name',
            'email',
            'mobile',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('A1')->getFont()->setBold(true);
        // $sheet->getStyle('B1')->getFont()->setBold(true);
        // $sheet->getStyle('C1')->getFont()->setBold(true);

        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
    }

    public function startCell(): string
    {
        return 'B1';
    }

    public function collection()
    {
        $data  = [];
        $users = User::all();
        foreach ($users as $item) {
            $data[] = [
                'name'   => $item->name,
                'email'  => $item->email,
                'mobile' => $item->mobile,
            ];
        }
        return (collect($data));
    }
}
