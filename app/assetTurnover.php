<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetTurnover extends Model
{
    protected $fillable = [
        'par_id',
        'isApproved',
        'turnoverData'
    ];

    public function asset_par()
    {
        return $this->belongsTo(assetPar::class, 'id');
    }

}
