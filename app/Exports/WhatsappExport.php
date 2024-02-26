<?php

namespace App\Exports;

use App\Models\Whatsapp;
use Maatwebsite\Excel\Concerns\FromCollection;

class WhatsappExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Whatsapp::all();
    }
}
