<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetTurnover extends Model
{
    protected $fillable = [
        'par_id',
        'ics_id',
        'remarks',
        'assignedTo'
    ];

    public function asset_par()
    {
        return $this->belongsTo(assetPar::class);
    }

    public function asset_ics()
    {
        return $this->belongsTo(assetIcslip::class);
    }
}
