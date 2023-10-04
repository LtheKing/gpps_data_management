<?php

namespace App\Exports;

use App\Models\Jemaat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class JemaatExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
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
        // $columns = DB::getSchemaBuilder()->getColumnListing('jemaats');
        $columns = [
            'ID',
            'Nomor Anggota',
            'Nama Jemaat',
            'Alamat',
            'Nomor Telepon',
            'Status Pernikahan',
            'Nama Ayah',
            'Nama Ibu',
            'Tanggal Baptis',
            'Pelaksana Baptis',
            'Data Dibuat',
            'Data Diupdate',
            'Image Location',
            'Image Name',
            'Segment',
            'Status Kematian',
            'Tanggal Kematian',
            'Status Baptis',
            'Jenis Kelamin',
            'Nama Suami',
            'Nama Istri',
            'Tanggal Pernikahan',
            'Pelaksana Pemberkatan',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Golongan Darah',
            'Cabang ID',
            'Komisi',
        ];

        return $columns;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 40,
            'C' => 40,            
            'D' => 55,
            'E' => 30,
            'F' => 20,
            'G' => 40,
            'H' => 40,
            'I' => 15,
            'J' => 40,
            'K' => 20,
            'L' => 20,
            'M' => 15,
            'N' => 15,
            'O' => 15,
            'P' => 15,
            'Q' => 15,
            'R' => 40,
            'S' => 40,
            'T' => 15,
            'U' => 40,
            'V' => 25,
            'W' => 15,
            'X' => 10,
            'Y' => 10,
            'Z' => 10,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 16]]
        ];
    }
}
