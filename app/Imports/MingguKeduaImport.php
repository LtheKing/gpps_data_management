<?php

namespace App\Imports;
use App\Models\Attendance;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MingguKeduaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return Attendance::all();
    }
}
