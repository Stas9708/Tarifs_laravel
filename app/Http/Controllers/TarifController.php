<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Models\Tarif;
use Illuminate\Support\Facades\Log;


class TarifController extends Controller
{
    public function index()
    {
        $errors = [];
        return view('index', ['tarifs' => $this->getTarifs()->toArray(),
            'errors' => $errors,]);
    }

    public function store(Request $request)
    {
        Log::info('Данные из запроса:', $request->all());
        $data = $request->all();
        $errors = [];
        foreach ($data["values"] as $value) {
            if(intval($value) < 0) {
                $errors[] = "Нельзя записывать отрецательные числа!";
            }elseif ($value === null){
                $errors[] = "Поля не должны быть пустыми";
            }
        }
        if(in_array('tarifs', $data)) {
        foreach ($data['tarifs'] as $tarif) {
            if (in_array($tarif, $data['tarifs'])) {
                $errors[] = "Тарифы должны быть уникальны";
                break;
            }
        }
    }
        if (count($errors) == 0) {
            foreach ($data["tarifs"] as $index => $tarif) {
                $record = new Record();
                $record->fill([
                    'tarif_id' => intval($tarif),
                    'price' => floatval($data['prices'][$index]),
                    'unit_point' => floatval($data['values'][$index]),
                ]);
            }
            $errors[] = "Данные отправленно успешно";
        }
        return view('index', ['tarifs' => $this->getTarifs()->toArray(), 'errors' => $errors]);
    }



    public function getTarifs()
    {
        return Tarif::all();
    }
}
