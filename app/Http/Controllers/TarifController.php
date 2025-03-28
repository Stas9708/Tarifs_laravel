<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Models\Tarif;


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
                $record = Record::query()->create([
                    'tarif_id' => intval($tarif),
                    'price' => floatval($data['prices'][$index]),
                    'unit_points' => floatval($data['values'][$index]),
                ]);
                $record->save();
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
