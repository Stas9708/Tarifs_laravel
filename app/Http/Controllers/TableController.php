<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function index()
    {
        $datesFromRecord =  DB::select('select created_at as date from records group by date');
        $dates = [];
        foreach ($datesFromRecord as $date) {
            $dates[] = $date->date;
        }
        return view('date', compact('dates'));
    }

    public function store(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $perPage = $request->input('perPage', 10);
        $query = Record::with('tarif')
            ->select(['tarif_id', 'price', 'unit_points', 'created_at']);
        if($dateTo && $dateFrom) {
            $query = $query
                ->where('created_at', [$dateFrom, $dateTo]);
        }
        elseif ($dateFrom){
            $query = $query
                ->where('created_at', '>=', $dateFrom);
        }
        $dates = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('table', compact('dates',  'perPage'));
    }
}
