<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentMethodExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'ID',
            'Title',
            'Method No',
            'Method By',
            'Created At',
            'Updated At'

        ];
    }

    public function collection()
    {
        $query = DB::table('payment_methods')->selectRaw('id, title, method_no, method_by, created_at, updated_at')->get();
        return $query;
    }
}