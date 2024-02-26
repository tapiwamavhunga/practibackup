<?php

namespace App\Exports;

use App\Models\SMS;
use Maatwebsite\Excel\Concerns\FromCollection;

class SMSExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SMS::all();
    }
}
