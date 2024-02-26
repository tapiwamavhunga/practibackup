<?php

namespace App\Exports;

use App\Models\Url;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmailExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Url::all();
    }
}
