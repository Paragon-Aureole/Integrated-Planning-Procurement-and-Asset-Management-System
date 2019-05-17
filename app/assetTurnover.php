<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetTurnover extends Model
{
    protected $fillable = [
        'asset_par_id',
        'isApproved'
    ];

    public function assetTurnoverItem()
    {
        return $this->hasMany(assetTurnoverItem::class);
    }

    public function assetPar()
    {
        return $this->belongsTo(assetPar::class);
    }

}
