<?php

namespace App\Services;

use App\Models\Record;

class TableService
{
    public function gatDataFromRecords($dateFrom, $dateTo, $perPage)
    {
        $query = Record::with('tarif')
            ->select(['id', 'tarif_id', 'price', 'unit_points', 'created_at']);
        if($dateTo && $dateFrom) {
            $query = $query
                ->whereBetween('created_at', [$dateFrom, $dateTo]);
        }
        elseif ($dateFrom){
            $query = $query
                ->where('created_at', '>=', $dateFrom);
        }
        elseif ($dateTo){
            $query = $query
                ->where('created_at', '<=', $dateTo);
        }
        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
