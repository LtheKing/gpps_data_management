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
        $yearFrom = $filter['inputYearFrom'];
        $yearTo = $filter['inputYearTo'];
        $yearMonth = $filter['inputYearMonth'];

        $viewData = [];
        $month = [];
        $year = [];

        if ($selector == 'tahun') {
            $dataPerYear = DB::table('attendances')
                ->whereYear('tgl_kehadiran', '>=', $yearFrom)
                ->whereYear('tgl_kehadiran', '<=', $yearTo)
                ->select(DB::raw("YEAR(tgl_kehadiran) year"), DB::raw("count('year') as jemaat_count"))
                ->groupby('year')
                ->get();
            
            // dd($dataPerYear);

            for ($z = 0; $z < count($dataPerYear); $z++) {
                array_push($year, $dataPerYear[$z]->year);
                array_push($viewData, $dataPerYear[$z]->jemaat_count);
            }

            return $this->chart->barChart()
                ->setTitle('Absensi GPPS Agape.')
                ->setSubtitle('Absensi tahun ' . $yearFrom . ' sampai tahun ' . $yearTo)
                ->addData('Jumlah Jemaat', $viewData)
                ->setXAxis($year);

        } else {
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
                ->setSubtitle('Absensi tahun '. $yearMonth)
                ->addData('Jumlah Jemaat', $viewData)
                ->setXAxis($month);
        }
    }
}
