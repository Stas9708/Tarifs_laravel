<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Tarif;
use App\Services\ChartService;

class ChartController extends Controller
{
    public function __construct(private readonly ChartService $chartService)
    {
        $dataFromRecord = Record::query()->select(['tarif_id', 'price', 'unit_points'])->get()->toArray();
        $tarifName = Tarif::query()->pluck('name', 'id')->toArray();
        $this->chart = $this->chartService->generateChart([
            'dataFromRecord' => $dataFromRecord,
            'tarifName' => $tarifName,
        ]);
    }

    public function showChartPage()
    {
        return view('chart', ['chart' => $this->chart]);
    }
}

