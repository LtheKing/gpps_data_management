<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Cabang;
use App\Models\Jemaat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($filter) {
        $this->filter = $filter;
    } 

    public function array() : array
    {
        dd($this->filter['input_filter']);

        // if ($this->filter['input_filter'] != null) {
        //     dd($this->filter);
        //     # code...
        // }

        $dataOri = [];

        switch ($this->filter['input_filter']) {
            case 'tahun':
                # code...
                break;

            case 'bulan':
                # code...
                break;

            case 'baptis':
                # code...
                break;
            
            case 'jk':
                # code...
                break;
                
            case 'pernikahan':
                # code...
                break;
            
            case 'kematian':
                # code...
                break;

            case 'segment':
                # code...
                break;  
                
            case 'ibadah1':
                # code...
                break;   
                
            case 'ibadah2':
                # code...
                break;     

            case 'ibadah3':
                # code...
                break;         

            default:
                $dataOri = Attendance::all();
                break;
        }
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

    public function columnWidths(): array
    {
        return [
            'A' => 55,
            'B' => 45,            
            'C' => 55,
            'D' => 25,
        ];
    }

     public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 18]]
        ];
    }
}
