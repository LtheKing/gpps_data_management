<?php

namespace App\Exports;

use App\Imports\MingguKeduaImport;
use App\Imports\MingguPertamaImport;
use App\Models\Attendance;
use App\Models\Jemaat;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IbadaAttendanceExport implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function sheets(): array
    {
        return [
            // 0 => $this->sheet1(),
            // 1 => $this->sheet2(),
            0 => new MingguPertamaImport,
            1 => new MingguKeduaImport,
        ];
    }

    public function sheet1()
    {
        return Jemaat::all();
    }

    public function sheet2()
    {
        return Attendance::all();
    }
}
