<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;
use Illuminate\Support\Carbon;

class JemaatsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($filter): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // dd($filter);

        //filter values
        $selector = $filter['filter'];
        $yearFrom = $filter['input_year_from'];
        $yearTo = $filter['input_year_to'];
        $yearMonth = $filter['input_year_month'];
        $ibadahKe = $filter['input_ibadah_ke'];

        switch ($selector) {
            case 'tahun':
                $viewData = [];
                $month = [];
                $year = [];

                $dataPerYear = DB::table('attendances')
                    ->whereYear('tgl_kehadiran', '>=', $yearFrom)
                    ->whereYear('tgl_kehadiran', '<=', $yearTo)
                    ->select(DB::raw("YEAR(tgl_kehadiran) year"), DB::raw("count('year') as jemaat_count"))
                    ->groupby('year')
                    ->get();

                for ($z = 0; $z < count($dataPerYear); $z++) {
                    array_push($year, $dataPerYear[$z]->year);
                    array_push($viewData, $dataPerYear[$z]->jemaat_count);
                }

                return $this->chart->barChart()
                    ->setTitle('Absensi GPPS Agape.')
                    ->setSubtitle('Absensi tahun ' . $yearFrom . ' sampai tahun ' . $yearTo)
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis($year);

                break;

            case 'bulan':
                $viewData = [];
                $month = [];
                $year = [];

                $dataPerMonth = DB::table('attendances')
                    ->whereYear('tgl_kehadiran', $yearMonth)->select(DB::raw("MONTH(tgl_kehadiran) month"), DB::raw("count('month') as jemaat_count"))
                    ->groupby('month')
                    ->get();
                for ($z = 0; $z < count($dataPerMonth); $z++) {
                    array_push($month, Carbon::create()->month($dataPerMonth[$z]->month)->format('F'));
                    array_push($viewData, $dataPerMonth[$z]->jemaat_count);
                }

                return $this->chart->barChart()
                    ->setTitle('Absensi GPPS Agape.')
                    ->setSubtitle('Absensi tahun ' . $yearMonth)
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis($month);

                break;

            case 'baptis':
                $data = DB::table('jemaats')->selectRaw('StatusBaptis, count(id) as jumlah')
                    ->groupBy('StatusBaptis')->get();

                $viewData = [
                    $data[0]->jumlah,
                    $data[1]->jumlah,
                ];

                return $this->chart->barChart()
                    ->setTitle('Data Jemaat GPPS Agape.')
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis(['Belum Baptis', 'Sudah Baptis']);

                break;

            case 'jk':
                $data = DB::table('jemaats')->selectRaw('JenisKelamin, count(id) as jumlah')
                    ->groupBy('JenisKelamin')->get();

                $viewData = [
                    $data[0]->jumlah,
                    $data[1]->jumlah,
                ];

                return $this->chart->barChart()
                    ->setTitle('Data Jemaat GPPS Agape.')
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis(['Pria', 'Wanita']);

                break;

            case 'pernikahan':
                $data = DB::table('jemaats')->selectRaw('Status, count(id) as jumlah')
                    ->groupBy('Status')->get();

                $viewData = [
                    $data[0]->jumlah,
                    $data[1]->jumlah,
                ];

                return $this->chart->barChart()
                    ->setTitle('Data Jemaat GPPS Agape.')
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis(['Belum Menikah', 'Menikah']);

                break;

            case 'kematian':
                $data = DB::table('jemaats')->selectRaw('StatusKematian, count(id) as jumlah')
                    ->groupBy('StatusKematian')->get();

                $viewData = [
                    $data[0]->jumlah,
                    $data[1]->jumlah,
                ];

                return $this->chart->barChart()
                    ->setTitle('Data Jemaat GPPS Agape.')
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis(['Hidup', 'Meninggal']);

                break;

            case 'segment':
                $data = DB::table('jemaats')->selectRaw('Segment, count(id) as jumlah')
                    ->groupBy('Segment')->get();

                $viewData = [
                    $data[0]->jumlah,
                    $data[1]->jumlah,
                    $data[2]->jumlah,
                    $data[3]->jumlah,
                ];

                return $this->chart->barChart()
                    ->setTitle('Data Jemaat GPPS Agape.')
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis(['Anak', 'Dewasa', 'Lansia', 'Remaja']);

                break;

            case 'ibadah':
                if ($ibadahKe == null) {
                    # code...
                    $data = DB::table('attendances')->selectRaw('ibadah_ke, count(id) as jumlah')
                        ->groupBy('ibadah_ke')->get();

                    $viewData = [
                        $data[0]->jumlah,
                        $data[1]->jumlah,
                        $data[2]->jumlah,
                    ];

                    return $this->chart->barChart()
                        ->setTitle('Data Jemaat GPPS Agape.')
                        ->addData('Jumlah Jemaat', $viewData)
                        ->setXAxis(['Ibadah 1', 'Ibadah 2', 'Ibadah 3']);
                } else {
                    $data = DB::table('attendances')
                        ->whereYear('tgl_kehadiran', $yearMonth)
                        ->where('ibadah_ke', $ibadahKe)
                        ->get();

                    $viewData = [
                        count($data)
                    ];

                    return $this->chart->barChart()
                        ->setTitle('Data Jemaat GPPS Agape.')
                        ->addData('Jumlah Jemaat Ibadah ' . $ibadahKe . '', $viewData)
                        ->setXAxis(['Ibadah ' . $ibadahKe . '']);
                }

                break;

            case 'komisi':
                $data = DB::table('attendances')
                    ->join('jemaats', 'jemaats.id', '=', 'attendances.jemaat_id')
                    ->whereYear('tgl_kehadiran', $yearMonth)
                    ->where('jemaats.komisi', $selector)
                    ->get();

                $viewData = [
                    count($data)
                ];

                dd($viewData);
                return $this->chart->barChart()
                    ->setTitle('Data Jemaat GPPS Agape.')
                    ->addData('Jumlah Jemaat', $viewData)
                    ->setXAxis(['Komisi ' . $selector . ' Tahun ' . $yearMonth . '']);
                break;

            default:
                # code...
                break;
        }
    }
}
