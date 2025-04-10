<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tarif extends Model
{
    public function record(): HasOne
    {
        return $this->hasOne(Record::class, 'tarif_id', 'id');
    }
}
