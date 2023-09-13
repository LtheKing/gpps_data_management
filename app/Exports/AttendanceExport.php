<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Cabang;
use App\Models\Jemaat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;


class AttendanceExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array() : array
    {
        $dataOri = Attendance::all();
        $dataModif = [];
        foreach ($dataOri as $key => $value) {
            $cabang = Cabang::find($value->cabang_id);
            $jemaat = Jemaat::find($value->jemaat_id);

            $object = new \stdClass();

            $object->NamaJemaat = $jemaat->Nama;
            $object->TglKehadiran = $value->tgl_kehadiran;
            $object->Cabang = $cabang->NamaCabang;
            $object->IbadahKe = $value->ibadah_ke;
            
            $dataModif[] = $object;
        }

        return $dataModif;
    }

    public function headings(): array
    {
        // $columns = DB::getSchemaBuilder()->getColumnListing('attendances');
        $columns = [
            'Nama Jemaat',
            'Tanggal Kehadiran',
            'Cabang',
            'Ibadah Ke'
        ];

        return $columns;
    }
}
