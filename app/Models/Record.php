<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['tarif_id', 'price', 'unit_points'];
    public $timestamps = false;
    public function tarif(){
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }
}
