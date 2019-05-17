<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetParItem extends Model
{
    protected $fillable = [
        'asset_par_id',
        'asset_turnover_id',
        'description',
        'itemStatus'
    ];

    public function assetPar()
    {
        return $this->belongsTo(assetPar::class);
    }

    public function assetTurnover()
    {
        return $this->hasMany(assetTurnover::class);
    }

}
