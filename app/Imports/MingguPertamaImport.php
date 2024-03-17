<?php

namespace App\Imports;
use App\Models\Jemaat;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MingguPertamaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return Jemaat::all();
    }
}
