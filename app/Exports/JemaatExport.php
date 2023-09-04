<?php

namespace App\Exports;

use App\Models\Jemaat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class JemaatExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Jemaat::all();
    }

    public function headings(): array
    {
        $columns = DB::getSchemaBuilder()->getColumnListing('jemaats');
        return $columns;
    }
}
