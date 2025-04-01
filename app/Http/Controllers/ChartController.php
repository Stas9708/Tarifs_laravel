<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Tarif;
use Ghunti\HighchartsPHP\Highchart;



class ChartService
{
      public function generateChart(array $data): Highchart
    {
        $chart = new Highchart();
        $i = 0;
        foreach ($data as $category => $value)
        {

            $chart->series[$i] = [
                'name' => $category,
                'price' => $value['price'],
                'unit points' => $value['unitPoints']
            ];
            $i++;
        }

        $chart->chart = array(
            'renderTo' => 'container',
            'type' => 'line',
            'marginRight' => 130,
            'marginBottom' => 25
        );

        return $chart;
    }
}


class ChartController extends Controller
{
    public function __Construct(private readonly ChartService $chartService)
    {
        $dataFromRecord = Record::query()->select(['tarif_id', 'price', 'unit_points'])->get()->toArray();
        $tarifName = Tarif::query()->pluck('name', 'id')->toArray();
        $data = [];
        for($i = 0; $i < count($tarifName); $i++){
            $data[array_values($tarifName)[$i]] = [
                'tarif_id' => [],
                'price' => [],
                'unitPoints' => [],
            ];
            for($j = 0; $j < count($dataFromRecord); $j++){
                if(count($data[array_values($tarifName)[$i]]['tarif_id']) < 1)
                    $data[array_values($tarifName)[$i]]['tarif_id'][] = $dataFromRecord[$j]['tarif_id'];
                else{
                    $data[array_values($tarifName)[$i]]['price'][] = $dataFromRecord[$j]['price'];
                    $data[array_values($tarifName)[$i]]['unitPoints'][] = $dataFromRecord[$j]['unit_points'];
                }
            }
        }



        return view('chart', ['chart' => $this->chartService->generateChart($data)]);

    }
}

