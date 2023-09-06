<?php

namespace App\Http\Controllers;

use App\Models\Yonatan;
use Illuminate\Http\Request;
use App\Charts\MonthlyUsersChart;

class YonatanController extends Controller
{
    public function create(Request $request)
    {
        Yonatan::create($request->all());
        return response('Data Created Successfully', 200);
    }

    public function testChart(MonthlyUsersChart $chart)
    {
        return view('testing.chart_example', ['chart' => $chart->build()]);
    }
}
