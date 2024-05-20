<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Cabang;
use App\Models\Jemaat;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function array(): array
    {
        // dd($this);
        // dd($this->filter['input_filter']);

        // if ($this->filter['input_filter'] != null) {
        //     dd($this->filter);
        //     # code...
        // }

        $dataOri = [];

        switch ($this->filter['input_filter']) {
            case 'tahun':
                $dataOri = DB::table('attendances')
                    ->whereYear('tgl_kehadiran', '>=', $this->filter['inputYearFrom'])
                    ->whereYear('tgl_kehadiran', '<=', $this->filter['inputYearTo'])
                    ->get();
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
                break;

            case 'bulan':
                $dataOri = DB::table('attendances')
                    ->whereYear('tgl_kehadiran', $this->filter['inputYearMonth'])
                    ->get();
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

                break;

            case 'baptis':
                $dataOri = DB::table('attendances')
                    ->join('jemaats', 'attendances.jemaat_id', '=', 'jemaats.id')
                    ->where('jemaats.StatusBaptis', $this->filter['filter_baptis'])
                    ->get();
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
                break;

            case 'jk':
                $dataOri = DB::table('attendances')
                    ->join('jemaats', 'attendances.jemaat_id', '=', 'jemaats.id')
                    ->where('jemaats.JenisKelamin', $this->filter['filter_jk'])
                    ->get();
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

                break;

            case 'pernikahan':
                $dataOri = DB::table('attendances')
                    ->join('jemaats', 'attendances.jemaat_id', '=', 'jemaats.id')
                    ->where('jemaats.Status', $this->filter['filter_pernikahan'])
                    ->get();
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
                break;

            case 'kematian':
                $dataOri = DB::table('attendances')
                    ->join('jemaats', 'attendances.jemaat_id', '=', 'jemaats.id')
                    ->where('jemaats.StatusKematian', $this->filter['filter_kematian'])
                    ->get();
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
                break;

            case 'segment':
                $dataOri = DB::table('attendances')
                    ->join('jemaats', 'attendances.jemaat_id', '=', 'jemaats.id')
                    ->where('jemaats.Segment', $this->filter['filter_segment'])
                    ->get();
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
                break;

            case 'ibadah':
                $dataOri = Attendance::where('ibadah_ke', $this->filter['filter_ibadah'])
                            ->whereYear('tgl_kehadiran', '=', $this->filter['inputYearMonth'])
                            ->get();
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

                break;

            case 'komisi':
                $dataOri = DB::table('attendances')
                    ->join('jemaats', 'attendances.jemaat_id', '=', 'jemaats.id')
                    ->where('jemaats.komisi', $this->filter['filter_komisi'])
                    ->where('attendances.tgl_kehadiran', $this->filter['inputYearMonth'])
                    ->get();
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
                break;

            default:
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
                break;
        }
    }

    public function headings(): array
    {
        // $columns = DB::getSchemaBuilder()->getColumnListing('attendances');
        $columns = [
            'Nama Jemaat',
            'Tanggal Kehadiran',
            'Cabang',
            'Ibadah Ke',
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
            1 => ['font' => ['bold' => true, 'size' => 18]],
        ];
    }
}
