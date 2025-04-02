<?php

namespace App\Services;
use Ghunti\HighchartsPHP\Highchart;

class ChartService
{
    public function generateChart(array $data): Highchart
    {
        $dataFromRecord = $data['dataFromRecord'];
        $tarifName = $data['tarifName'];
        $chart = new Highchart();
        $data = [];
        for ($i = 0; $i < count($tarifName); $i++) {
            $data[array_values($tarifName)[$i]] = [
                'tarif_id' => [],
                'price' => [],
                'unitPoints' => [],
            ];
            for ($j = 0; $j < count($dataFromRecord); $j++) {
                if (count($data[array_values($tarifName)[$i]]['tarif_id']) < 1)
                    $data[array_values($tarifName)[$i]]['tarif_id'][] = $dataFromRecord[$j]['tarif_id'];
                else {
                    $data[array_values($tarifName)[$i]]['price'][] = $dataFromRecord[$j]['price'];
                    $data[array_values($tarifName)[$i]]['unitPoints'][] = $dataFromRecord[$j]['unit_points'];
                }
            }
        }
        $index = 0;
        foreach ($data as $category => $value)
        {
            $chart->series[$index] = [
                'name' => $category,
                'price' => $value['price'],
                'unit points' => $value['unitPoints']
            ];
            $index++;
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
