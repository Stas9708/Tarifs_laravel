<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Tarif;
use App\Services\ChartService;
use Illuminate\Support\Carbon;

class ChartController extends Controller
{
    public function __construct(private readonly ChartService $chartService)
    {
    }

    public function showChartPage()
    {
        $chart = $this->chartService->generateChart([
            'dataFromRecord' => Record::query()
                ->select(['tarif_id', 'price', 'unit_points'])
                ->whereYear('created_at', Carbon::now()->year)->get()->toArray(),
            'tarifName' => Tarif::query()->pluck('name', 'id')->toArray(),
        ]);
        return view('chart', ['chart' => $chart]);
    }
}

