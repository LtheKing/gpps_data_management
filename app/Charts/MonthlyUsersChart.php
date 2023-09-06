<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;
use Illuminate\Support\Carbon;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $month = DB::table('attendances')->get()->groupBy(function ($val) {
            return Carbon::parse($val->tgl_kehadiran)->format('m');
        });

        $dataPerMonth = DB::table('attendances')
            ->whereYear('tgl_kehadiran', '2023')->select(DB::raw("MONTH(tgl_kehadiran) month"), DB::raw("count('month') as jemaat_count"))
            ->groupby('month')
            ->get();
        $viewDataPerMonth = [];
        $month = [];
        for ($z = 0; $z < count($dataPerMonth); $z++) {
            array_push($month, Carbon::create()->month($dataPerMonth[$z]->month)->format('F'));
            array_push($viewDataPerMonth, $dataPerMonth[$z]->jemaat_count);
        }

        // dd($month);
        return $this->chart->barChart()
            ->setTitle('Absensi GPPS Agape.')
            ->setSubtitle('Absensi tahun 2023.')
            ->addData('aaa', $viewDataPerMonth)
            ->setXAxis($month);
    }
}
