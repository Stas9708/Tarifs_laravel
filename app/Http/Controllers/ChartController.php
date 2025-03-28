<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Tarif;
use Ghunti\HighchartsPHP\Highchart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function showChart()
    {
        $chart = new Highchart();
//        $unitPoints = Record::query()->pluck('unit_points')->toArray();
//        $prices = Record::query()->pluck('price')->toArray();
//        $tarifName = Tarif::query()->pluck('name')->toArray();
        $chart->series[] = [
            'name' => 'Hello',
            'data' => array(1, 2, 3 , 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14),
        ];
        return view('chart', ['chart' => $chart]);

    }
}
