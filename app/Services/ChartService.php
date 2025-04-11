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
        $tarifs = [];;
        foreach($tarifName as $tarif){
            $tarifs[$tarif] = [];
        }
        foreach ($tarifs as $key => $value) {
            for($i = 0; $i < count($dataFromRecord); $i++){
                if($this->gatDateInfo($dataFromRecord[$i]['created_at'], $tarifs[$key])){
                    if($tarifName[$dataFromRecord[$i]['tarif_id']] == $key){
                        $tarifs[$key][] = [$dataFromRecord[$i]['created_at'] => $dataFromRecord[$i]['unit_points']];
                        continue;
                    } else{
                        $tarifs[$key][] = [$dataFromRecord[$i]['created_at'] => null];
                        continue;
                    }
                }
                if($tarifName[$dataFromRecord[$i]['tarif_id']] == $key){
                    $tarifs[$key][] = [$dataFromRecord[$i]['created_at'] => $dataFromRecord[$i]['unit_points']];
                } else {
                    $tarifs[$key][] = [$dataFromRecord[$i]['created_at'] => null];
                }
            }
        }
            $chart->chart = array(
                'renderTo' => 'container',
                'type' => 'line',
                'marginRight' => 130,
                'marginBottom' => 25
            );

            $chart->title = array(
                'text' => 'График тарифов',
                'x' => 10
            );
            foreach ($tarifs as  $ind => $val) {
                $dateArr = [];
                for($i = 0; $i < count($val); $i++){
                    $dateArr[] = implode('', array_keys($val[$i]));
                }
                $chart->xAxis = [
                    'categories' => $dateArr,
                    'labels' => [
                        'style' => [
                            'fontSize' => '10px'
                        ],
                        'step' => 1
                    ],
                    'tickInterval' => 1
                ];
                break;
            }
            $chart->yAxis = array(
                'title' => array(
                    'text' => 'Значение в единицах измерения тарифов'
                ),
                'plotLines' => array(
                    array(
                        'value' => 0,
                        'width' => 1,
                        'color' => '#808080'
                    )
                )
            );
        $chart->plotOptions = [
            'series' => [
                'connectNulls' => true
            ]
        ];
            $chart->legend = array(
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'top',
                'x' => -10,
                'y' => 100,
                'borderWidth' => 0
            );
            foreach ($tarifs as $tarifName => $tarif) {
                $unitPointsArr = [];
                foreach ($tarif as $key => $value) {
                    $unitPointsArr[] = array_values($value);
                }
                $chart->series[] = array(
                    'name' => $tarifName,
                    'data' => $unitPointsArr
                );
            }

        return $chart;
    }


    public function gatDateInfo(string $date, array $arr): bool
    {
        if(count($arr) > 0) {
            $count = 0;
            foreach ($arr as $val) {
                if ($date == implode('', array_keys($val))) {
                    $count++;
                }
            }
        }else {
            return false;
        }
        return $count;
    }
}
