<?php

namespace App\Http\Controllers;

use App\Services\TableService;
use Illuminate\Http\Request;

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
        $dates = $this->tableService->gatDataFromRecords($request->input('date_from'),
        $request->input('date_to'), $perPage)->appends($request->all());
        return view('table', compact('dates',  'perPage'));
    }
}
