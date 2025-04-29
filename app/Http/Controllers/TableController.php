<?php

namespace App\Http\Controllers;

use App\Services\TableService;
use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{

    public function __construct(private readonly TableService $tableService)
    {
    }

    public function index()
    {
        return view('table');
    }

    public function store(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $dates = $this->tableService->gatDataFromRecords($dateFrom = $request->input('date_from'),
            $dateTo = $request->input('date_to'),  $perPage);
        return view('table', compact('dates',  'perPage'));
    }
}
