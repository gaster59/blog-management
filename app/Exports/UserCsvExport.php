<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserCsvExport implements FromCollection
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        // dd($this->id);
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
